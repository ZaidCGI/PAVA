import argparse
import asyncio
import json
import logging
import os
import ssl
import uuid

import cv2
import aiohttp_cors
from aiohttp import web
from av import VideoFrame

from aiortc import MediaStreamTrack, RTCPeerConnection, RTCSessionDescription
from aiortc.contrib.media import MediaBlackhole, MediaPlayer, MediaRecorder, MediaRelay
import numpy as np
import argparse
import tensorflow as tf
import cv2

from object_detection.utils import ops as utils_ops
from object_detection.utils import label_map_util
from object_detection.utils import visualization_utils as vis_util

# patch tf1 into `utils.ops`
utils_ops.tf = tf.compat.v1

# Patch the location of gfile
tf.gfile = tf.io.gfile

ROOT = os.path.dirname(__file__)

logger = logging.getLogger("pc")
pcs = set()
relay = MediaRelay()

def load_model(model_path):
    model = tf.saved_model.load(model_path)
    return model


def run_inference_for_single_image(model, image):
    image = np.asarray(image)
    # The input needs to be a tensor, convert it using `tf.convert_to_tensor`.
    input_tensor = tf.convert_to_tensor(image)
    # The model expects a batch of images, so add an axis with `tf.newaxis`.
    input_tensor = input_tensor[tf.newaxis,...]
    
    # Run inference
    output_dict = model(input_tensor)

    # All outputs are batches tensors.
    # Convert to numpy arrays, and take index [0] to remove the batch dimension.
    # We're only interested in the first num_detections.
    num_detections = int(output_dict.pop('num_detections'))
    output_dict = {key: value[0, :num_detections].numpy()
                   for key, value in output_dict.items()}
    output_dict['num_detections'] = num_detections

    # detection_classes should be ints.
    output_dict['detection_classes'] = output_dict['detection_classes'].astype(np.int64)
   
    # Handle models with masks:
    if 'detection_masks' in output_dict:
        # Reframe the the bbox mask to the image size.
        detection_masks_reframed = utils_ops.reframe_box_masks_to_image_masks(
                                    output_dict['detection_masks'], output_dict['detection_boxes'],
                                    image.shape[0], image.shape[1])      
        detection_masks_reframed = tf.cast(detection_masks_reframed > 0.5, tf.uint8)
        output_dict['detection_masks_reframed'] = detection_masks_reframed.numpy()
    
    return output_dict


def run_inference(model, category_index, frame):
    #while True:
        #ret, image_np = cap.read()
        # Actual detection.
    output_dict = run_inference_for_single_image(model, frame)
        # Visualization of the results of a detection.
    vis_util.visualize_boxes_and_labels_on_image_array(
        frame,
        output_dict['detection_boxes'],
        output_dict['detection_classes'],
        output_dict['detection_scores'],
        category_index,
        instance_masks=output_dict.get('detection_masks_reframed', None),
        use_normalized_coordinates=True,
        line_thickness=8)
        
    print("OK!!")
    #return new_frame
        #cv2.imshow('object_detection', cv2.resize(image_np, (800, 600)))
        #if cv2.waitKey(25) & 0xFF == ord('q'):
            #cap.release()
            #cv2.destroyAllWindows()
            #break
    return frame

class VideoTransformTrack(MediaStreamTrack):
    """
    A video stream track that transforms frames from an another track.
    """

    kind = "video"

    def __init__(self, track, transform):
        super().__init__()  # don't forget this!
        self.track = track
        self.transform = transform


    async def recv(self):
        frame = await self.track.recv()

        if self.transform == "cartoon":
            img = frame.to_ndarray(format="bgr24")

            # prepare color
            img_color = cv2.pyrDown(cv2.pyrDown(img))
            for _ in range(6):
                img_color = cv2.bilateralFilter(img_color, 9, 9, 7)
            img_color = cv2.pyrUp(cv2.pyrUp(img_color))

            # prepare edges
            img_edges = cv2.cvtColor(img, cv2.COLOR_RGB2GRAY)
            img_edges = cv2.adaptiveThreshold(
                cv2.medianBlur(img_edges, 7),
                255,
                cv2.ADAPTIVE_THRESH_MEAN_C,
                cv2.THRESH_BINARY,
                9,
                2,
            )
            img_edges = cv2.cvtColor(img_edges, cv2.COLOR_GRAY2RGB)

            # combine color and edges
            img = cv2.bitwise_and(img_color, img_edges)

            # rebuild a VideoFrame, preserving timing information
            print("OK!!")
            print (np.fromstring(img.tostring()))
            new_frame = VideoFrame.from_ndarray(img, format="bgr24")
            new_frame.pts = frame.pts
            new_frame.time_base = frame.time_base
            return new_frame
        elif self.transform == "edges":
            # perform edge detection
            img = frame.to_ndarray(format="bgr24")
            img = cv2.cvtColor(cv2.Canny(img, 100, 200), cv2.COLOR_GRAY2BGR)

            # rebuild a VideoFrame, preserving timing information
            new_frame = VideoFrame.from_ndarray(img, format="bgr24")
            new_frame.pts = frame.pts
            new_frame.time_base = frame.time_base
            return new_frame
        elif self.transform == "rotate":
            # rotate image
            img = frame.to_ndarray(format="bgr24")
            rows, cols, _ = img.shape
            M = cv2.getRotationMatrix2D((cols / 2, rows / 2), frame.time * 45, 1)
            img = cv2.warpAffine(img, M, (cols, rows))

            # rebuild a VideoFrame, preserving timing information
            new_frame = VideoFrame.from_ndarray(img, format="bgr24")
            new_frame.pts = frame.pts
            new_frame.time_base = frame.time_base
            return new_frame
        else:
            #return frame
            #Ajout de detection


            
            img = frame.to_ndarray(format="bgr24")
            
            model = detection_model
            category_index = label_map_util.create_category_index_from_labelmap(args.labelmap, use_display_name=True)

            output_dict = run_inference_for_single_image(model, img)
                # Visualization of the results of a detection.
            vis_util.visualize_boxes_and_labels_on_image_array(
                img,
                output_dict['detection_boxes'],
                output_dict['detection_classes'],
                output_dict['detection_scores'],
                category_index,
                instance_masks=output_dict.get('detection_masks_reframed', None),
                use_normalized_coordinates=True,
                line_thickness=8)
            
            
                #img = cv2.cvtColor(cv2.Canny(img, 100, 200), cv2.COLOR_GRAY2BGR)
            new_frame = VideoFrame.from_ndarray(img, format="bgr24")
            new_frame.pts = frame.pts
            new_frame.time_base = frame.time_base
            ImgDebut = 0
            return new_frame
            



async def index(request):
    content = open(os.path.join(ROOT, "index1.html"), "r").read()
    return web.Response(content_type="text/html", text=content)

async def UCLABS(request):
    content = open(os.path.join(ROOT, "UCLabs.html"), "r").read()
    return web.Response(content_type="text/html", text=content)

async def PAVAEyeHands(request):
    content = open(os.path.join(ROOT, "PAVA-Eye-Hands.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
async def PAVAEyeObjects(request):
    content = open(os.path.join(ROOT, "PAVA-Eye-Objects.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
async def PAVAEyeObjectsV2(request):
    content = open(os.path.join(ROOT, "PAVA-Eye-Objects-V2.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
async def PAVAEyeFace(request):
    content = open(os.path.join(ROOT, "PAVA-Eye-Face.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
    
async def PAVAAR(request):
    content = open(os.path.join(ROOT, "PAVAAR.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
async def ARCORE(request):
    content = open(os.path.join(ROOT, "ARCORE.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
async def TESTAR(request):
    content = open(os.path.join(ROOT, "TESTAR.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
async def ARGPS(request):
    content = open(os.path.join(ROOT, "ARGPS.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
async def PAVACALL(request):
    content = open(os.path.join(ROOT, "PAVACALL.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
async def PAVADU(request):
    content = open(os.path.join(ROOT, "PAVADU.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
async def PAVAOCR(request):
    content = open(os.path.join(ROOT, "PAVAOCR.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
async def PAVACALL2(request):
    content = open(os.path.join(ROOT, "PAVACALL2.html"), "r").read()
    return web.Response(content_type="text/html", text=content)
async def PAVADQ(request):
    content = open(os.path.join(ROOT, "PAVADQ.html"), "r").read()
    return web.Response(content_type="text/html", text=content)



async def css(request):
    content = open(os.path.join(ROOT, "style.css"), "r").read()
    return web.Response(content_type="text/css", text=content)
async def cssstyle2(request):
    content = open(os.path.join(ROOT, "style2.css"), "r").read()
    return web.Response(content_type="text/css", text=content)
async def css2(request):
    content = open(os.path.join(ROOT, "css/bootstrap.min.css"), "r").read()
    return web.Response(content_type="text/css", text=content)
async def css3(request):
    content = open(os.path.join(ROOT, "css/responsive.css"), "r").read()
    return web.Response(content_type="text/css", text=content)
#async def css4(request):
#    content = open(os.path.join(ROOT, "css/colors.css"), "r").read()
#    return web.Response(content_type="text/css", text=content)
async def css5(request):
    content = open(os.path.join(ROOT, "css/bootstrap-select.css"), "r").read()
    return web.Response(content_type="text/css", text=content)
async def css6(request):
    content = open(os.path.join(ROOT, "css/perfect-scrollbar.css"), "r").read()
    return web.Response(content_type="text/css", text=content)
async def css7(request):
    content = open(os.path.join(ROOT, "css/custom.css"), "r").read()
    return web.Response(content_type="text/css", text=content)
    

    
   


    
async def javascript(request):
    content = open(os.path.join(ROOT, "client.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
    
async def javascript1(request):
    content = open(os.path.join(ROOT, "js/jquery.min.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)

async def javascript2(request):
    content = open(os.path.join(ROOT, "js/popper.min.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)

async def javascript3(request):
    content = open(os.path.join(ROOT, "js/bootstrap.min.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def javascript4(request):
    content = open(os.path.join(ROOT, "js/animate.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def javascript5(request):
    content = open(os.path.join(ROOT, "js/bootstrap-select.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def javascript6(request):
    content = open(os.path.join(ROOT, "js/owl.carousel.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def javascript7(request):
    content = open(os.path.join(ROOT, "js/Chart.min.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def javascript8(request):
    content = open(os.path.join(ROOT, "js/Chart.bundle.min.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def javascript9(request):
    content = open(os.path.join(ROOT, "js/utils.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def javascript10(request):
    content = open(os.path.join(ROOT, "js/analyser.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def javascript11(request):
    content = open(os.path.join(ROOT, "js/perfect-scrollbar.min.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def javascript12(request):
    content = open(os.path.join(ROOT, "js/custom.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def javascript13(request):
    content = open(os.path.join(ROOT, "js/chart_custom_style1.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def AR1(request):
    content = open(os.path.join(ROOT, "js/AR1.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def AR(request):
    content = open(os.path.join(ROOT, "js/AR.js"), "r").read()
    return web.Response(content_type="application/javascript", text=content)
async def RASA(request):
    content = open(os.path.join(ROOT, "js/RASA.js"), "r", encoding='UTF-8').read()
    return web.Response(content_type="application/javascript", text=content)  
async def TESSERACTOCR(request):
    content = open(os.path.join(ROOT, "js/tesseract-ocr.js"), "r", encoding='UTF-8').read()
    return web.Response(content_type="application/javascript", text=content)  
async def TESSERACTMIN(request):
    content = open(os.path.join(ROOT, "js/tesseract.min.js"), "r", encoding='UTF-8').read()
    return web.Response(content_type="application/javascript", text=content)  
async def TESSERACTCORE(request):
    content = open(os.path.join(ROOT, "js/tesseract-core.asm.js"), "r", encoding='UTF-8').read()
    return web.Response(content_type="application/javascript", text=content)  
async def TESSERACTCOREWASM(request):
    content = open(os.path.join(ROOT, "js/tesseract-core.wasm.js"), "r", encoding='UTF-8').read()
    return web.Response(content_type="application/javascript", text=content)  
async def ObjectV2(request):
    content = open(os.path.join(ROOT, "script.js"), "r", encoding='UTF-8').read()
    return web.Response(content_type="application/javascript", text=content)  

async def SCREW(request):
    content = open(os.path.join(ROOT, "3DMODELS/scene.gltf"), "r", encoding='UTF-8').read()
    return web.Response(content_type="model/gltf.binary", text=content)    
async def CGI(request):
    content = open(os.path.join(ROOT, "3DMODELS/CGI.gltf"), "r", encoding='UTF-8').read()
    return web.Response(content_type="model/gltf.binary", text=content) 
async def ARMARKER(request):
    content = open(os.path.join(ROOT, "3DMODELS/ARMARKER.patt"), "r", encoding='UTF-8').read()
    return web.Response(content_type="text/plain", text=content) 

async def user(request):
    return web.FileResponse("images/layout_img/user_img.jpg")
async def LogoPava(request):
    return web.FileResponse("images/logo/logo.png")
async def LogoMenu(request):
    return web.FileResponse("images/logo/Menu-Logo.png")
async def CGIOCRDEMO(request):
    return web.FileResponse("images/OCR/CGI-Demo-OCR.png")
    
async def MUTED(request):
    return web.FileResponse("images/logo/muted.png")
async def UNMUTED(request):
    return web.FileResponse("images/logo/unmuted.png")
async def SENDLOGO(request):
    return web.FileResponse("images/logo/sendlogo.png")
    


    


async def offer(request):
    params = await request.json()
    offer = RTCSessionDescription(sdp=params["sdp"], type=params["type"])

    pc = RTCPeerConnection()
    pc_id = "PeerConnection(%s)" % uuid.uuid4()
    pcs.add(pc)

    def log_info(msg, *args):
        logger.info(pc_id + " " + msg, *args)

    log_info("Created for %s", request.remote)

    # prepare local media
    player = MediaPlayer(os.path.join(ROOT, "demo-instruct.wav"))
    if args.record_to:
        recorder = MediaRecorder(args.record_to)
    else:
        recorder = MediaBlackhole()

    @pc.on("datachannel")
    def on_datachannel(channel):
        @channel.on("message")
        def on_message(message):
            if isinstance(message, str) and message.startswith("ping"):
                channel.send("pong" + message[4:])

    @pc.on("connectionstatechange")
    async def on_connectionstatechange():
        log_info("Connection state is %s", pc.connectionState)
        if pc.connectionState == "failed":
            await pc.close()
            pcs.discard(pc)

    @pc.on("track")
    def on_track(track):
        log_info("Track %s received", track.kind)

        if track.kind == "audio":
            pc.addTrack(player.audio)
            recorder.addTrack(track)
        elif track.kind == "video":
            pc.addTrack(
                VideoTransformTrack(
                    relay.subscribe(track), transform=params["video_transform"]
                )
            )
            if args.record_to:
                recorder.addTrack(relay.subscribe(track))

        @track.on("ended")
        async def on_ended():
            log_info("Track %s ended", track.kind)
            await recorder.stop()

    # handle offer
    await pc.setRemoteDescription(offer)
    await recorder.start()

    # send answer
    answer = await pc.createAnswer()
    await pc.setLocalDescription(answer)

    return web.Response(
        content_type="application/json",
        text=json.dumps(
            {"sdp": pc.localDescription.sdp, "type": pc.localDescription.type}
        ),
    )


async def on_shutdown(app):
    # close peer connections
    log_info("Deconnexion effectuee")
    coros = [pc.close() for pc in pcs]
    await asyncio.gather(*coros)
    pcs.clear()


if __name__ == "__main__":
    parser = argparse.ArgumentParser(
        description="WebRTC audio / video / data-channels demo"
    )
    parser.add_argument("--cert-file", help="SSL certificate file (for HTTPS)")
    parser.add_argument("--key-file", help="SSL key file (for HTTPS)")
    parser.add_argument(
        "--host", default="0.0.0.0", help="Host for HTTP server (default: 0.0.0.0)"
    )
    parser.add_argument(
        "--port", type=int, default=443, help="Port for HTTP server (default: 8080)"
    )
    parser.add_argument("--record-to", help="Write received media to a file."),
    parser.add_argument("--verbose", "-v", action="count")
    parser.add_argument('-m', '--model', type=str, required=False, help='Model Path', default="C:/Users/Administrator/Desktop/IA heberg/EYE/Model/models-master/models-master/research/object_detection/packages/tf2/data/models/ssd_mobilenet_v2_320x320_coco17_tpu-8/saved_model")
    parser.add_argument('-l', '--labelmap', type=str, required=False, help='Path to Labelmap', default="C:/Users/Administrator/Desktop/IA heberg/EYE/Model/models-master/models-master/research/object_detection/packages/tf2/data/models/ssd_mobilenet_v2_320x320_coco17_tpu-8/mscoco_label_map.pbtxt")
    args = parser.parse_args()
    detection_model = load_model(args.model)

    if args.verbose:
        logging.basicConfig(level=logging.DEBUG)
    else:
        logging.basicConfig(level=logging.INFO)

    if args.cert_file:
        ssl_context = ssl.SSLContext()
        ssl_context.load_cert_chain(args.cert_file, args.key_file)
    else:
        ssl_context = None

    app = web.Application()
    routes = web.RouteTableDef()
    app.add_routes(routes)
    

    
        
    app.on_shutdown.append(on_shutdown)
    app.router.add_get("/", index)
    app.router.add_get("/client.js", javascript)
    app.router.add_post("/offer", offer)
    

    #--Chargement Bootstrap
    app.router.add_get("/PAVA-EYE-HANDS", PAVAEyeHands)
    app.router.add_get("/PAVA-EYE-OBJECTS", PAVAEyeObjects)
    app.router.add_get("/PAVA-EYE-OBJECTS-V2", PAVAEyeObjectsV2)
    app.router.add_get("/PAVA-EYE-FACE", PAVAEyeFace)
    app.router.add_get("/js/jquery.min.js", javascript1)
    app.router.add_get("/js/popper.min.js", javascript2)
    app.router.add_get("/js/bootstrap.min.js", javascript3)
    app.router.add_get("/js/animate.js", javascript4)
    app.router.add_get("/js/bootstrap-select.js", javascript5)
    app.router.add_get("/js/owl.carousel.js", javascript6) 
    app.router.add_get("/js/Chart.min.js", javascript7)
    app.router.add_get("/js/Chart.bundle.min.js", javascript8)
    app.router.add_get("/js/utils.js", javascript9)
    app.router.add_get("/js/analyser.js", javascript10)
    app.router.add_get("/js/perfect-scrollbar.min.js", javascript11)
    app.router.add_get("/js/custom.js", javascript12)
    app.router.add_get("/js/chart_custom_style1.js", javascript13)
    app.router.add_get("/js/AR1.js", AR1)
    app.router.add_get("/js/AR.js", AR)
    app.router.add_get("/js/RASA.js", RASA)
    app.router.add_get("/style.css", css)
    app.router.add_get("/style2.css", cssstyle2)
    app.router.add_get("/css/bootstrap.min.css", css2)
    app.router.add_get("/css/responsive.css", css3)
    #app.router.add_get("/css/colors.css", css4)
    app.router.add_get("/css/bootstrap-select.css", css5)
    app.router.add_get("/css/perfect-scrollbar.css", css6)
    app.router.add_get("/css/custom.css", css7)
    app.router.add_get("/images/layout_img/user_img.jpg", user)
    app.router.add_get("/images/logo/logo.png", LogoPava)
    app.router.add_get("/images/logo/Menu-Logo.png", LogoMenu)
    app.router.add_get("/PAVAAR", PAVAAR)
    app.router.add_get("/ARCORE", ARCORE)
    app.router.add_get("/SCREW", SCREW)
    app.router.add_get("/CGI", CGI)
    app.router.add_get("/TESTAR", TESTAR)
    app.router.add_get("/ARMARKER", ARMARKER)
    app.router.add_get("/ARGPS", ARGPS)
    app.router.add_get("/PAVACALL", PAVACALL)
    app.router.add_get("/MUTED", MUTED)
    app.router.add_get("/UNMUTED", UNMUTED)
    app.router.add_get("/SENDLOGO", SENDLOGO)
    app.router.add_get("/PAVADU", PAVADU)
    app.router.add_get("/PAVAOCR", PAVAOCR)
    app.router.add_get("/js/tesseract-ocr.js", TESSERACTOCR)
    app.router.add_get("/js/tesseract-core.asm.js", TESSERACTCORE)
    app.router.add_get("/js/tesseract.min.js", TESSERACTMIN)
    app.router.add_get("/js/tesseract-core.wasm.js", TESSERACTCOREWASM)
    app.router.add_get("/CGI-Demo-OCR", CGIOCRDEMO)
    app.router.add_get("/script.js", ObjectV2)
    app.router.add_get("/PAVACALL2", PAVACALL2)
    app.router.add_get("/UCLABS", UCLABS)
    app.router.add_get("/PAVADQ", PAVADQ)





    

    
    
    
            
    #
    web.run_app(
        app, access_log=None, host=args.host, port=args.port, ssl_context=ssl_context
    )
