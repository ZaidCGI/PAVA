<?php
session_start();
include('checkConnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>PAVA-IA</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <link rel="icon" href="images/fevicon.png" type="image/png" />
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <!-- site css -->
   <link rel="stylesheet" href="style.css" />
   <!-- responsive css -->
   <link rel="stylesheet" href="css/responsive.css" />
   <!-- color css -->
   <link rel="stylesheet" href="css/colors.css" />
   <!-- select bootstrap -->
   <link rel="stylesheet" href="css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="css/perfect-scrollbar.css" />
   <!-- custom css -->
   <link rel="stylesheet" href="css/custom.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-WJ0q8+tkm0SfSgGv1zbW9Xchj0M+4M4dKPvJbWt29fJGIMfgNt+yoHJgs0mdCxt8/TEgaz72+IOydbdpk7wLg=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="style/ocr.css">
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script src="https://kit.fontawesome.com/4414288e8e.js"></script>
</head>

<body class="dashboard dashboard_1">

<?php
      if($indice==1){
      ?>

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myModalLabel">Votre clé PAVA a expiré</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>Vous n'avez plus accès aux modules PAVA.</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="window.location.href='logout.php'">  Se déconnecter  </button>
            </div>
            </div>
         </div>
      </div>

  <!-- Script pour ouvrir le modal automatiquement -->
  <script>
    $(window).on('load', function() {
      $('#myModal').modal('show');
    });
  </script>
 
  <?php
      }
  ?>


   <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1"
      xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <defs>
         <symbol id="icon-volume_on" viewBox="0 0 24 24">
            <path
               d="M14.016 3.234q3.047 0.656 5.016 3.117t1.969 5.648-1.969 5.648-5.016 3.117v-2.063q2.203-0.656 3.586-2.484t1.383-4.219-1.383-4.219-3.586-2.484v-2.063zM16.5 12q0 2.813-2.484 4.031v-8.063q1.031 0.516 1.758 1.688t0.727 2.344zM3 9h3.984l5.016-5.016v16.031l-5.016-5.016h-3.984v-6z">
            </path>
         </symbol>
         <symbol id="icon-volume_off" viewBox="0 0 24 24">
            <path
               d="M12 3.984v4.219l-2.109-2.109zM4.266 3l16.734 16.734-1.266 1.266-2.063-2.063q-1.547 1.313-3.656 1.828v-2.063q1.172-0.328 2.25-1.172l-4.266-4.266v6.75l-5.016-5.016h-3.984v-6h4.734l-4.734-4.734zM18.984 12q0-2.391-1.383-4.219t-3.586-2.484v-2.063q3.047 0.656 5.016 3.117t1.969 5.648q0 2.203-1.031 4.172l-1.5-1.547q0.516-1.266 0.516-2.625zM16.5 12q0 0.422-0.047 0.609l-2.438-2.438v-2.203q1.031 0.516 1.758 1.688t0.727 2.344z">
            </path>
         </symbol>
         <symbol id="icon-mic-unmute" viewBox="0 0 24 24">
            <path
               d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z" />
            <path d="M10 8a2 2 0 1 1-4 0V3a2 2 0 1 1 4 0v5zM8 0a3 3 0 0 0-3 3v5a3 3 0 0 0 6 0V3a3 3 0 0 0-3-3z" />
         </symbol>


      </defs>
   </svg>
   <div class="full_container">
      <div class="inner_container">
         <!-- Sidebar  -->
         <nav id="sidebar">
            <div class="sidebar_blog_1">
               <div class="sidebar-header">
                  <div class="logo_section">
                     <!--<a href="index1.html"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png" alt="#" /></a>-->
                  </div>
               </div>
               <div class="sidebar_user_info">
                  <div class="icon_setting"></div>
                  <div class="user_profle_side">
                     <div class="user_img"><img class="img-responsive" src="images/layout_img/user_img.jpg" alt="#" />
                     </div>
                     <div class="user_info">
                        <h6><?php echo $_SESSION['email']?></h6>
                        <p><span class="online_animation"></span> Online</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="sidebar_blog_2">
               <h4>Navigation</h4>
               <ul class="list-unstyled components">
                  <!--<li class="active">-->
                     <li><a href="https://pava-ia.fr/index1.html"><i class="fa fa-tasks orange_color"></i><span>Dashboard</span></a></li>
               <li>
                     <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-eye red_color"></i> <span>PAVA.eye</span></a>
                     <ul class="collapse list-unstyled" id="element">
                        <li><a href="https://pava-ia.fr/PAVA-EYE-HANDS.html">> <span>Detection de mains</span></a></li>
                  <li><a href="https://pava-ia.fr/PAVA-EYE-FACE.html">> <span>Detection du visage</span></a></li>
                        <li><a href="https://pava-ia.fr/PAVA-EYE-OBJECTS.html">> <span>Detection d'objets</span></a></li>
                  <li><a href="https://pava-ia.fr/PAVA-EYE-OBJECTS-V2.html">> <span>Detection d'objets V2</span></a></li>                           
                     </ul>
                  </li>
               <li><a href="https://pava-ia.fr/PAVAAR.html"><i class="fa fa-cube blue_color"></i><span>PAVA.AR</span></a></li>
               <li><a href="https://pava-ia.fr/PAVACALL.html"><i class="fa fa-comment-o yellow_color"></i><span>PAVA.Call</span></a></li>
               <li><a href="https://pava-ia.fr/PAVAOCR.html"><i class="fa fa-file-photo-o green_color"></i><span>PAVA.OCR</span></a></li>
               <li><a href="https://pava-ia.fr/PAVADQ.html"><i class="fa fa-graduation-cap orange_color"></i><span>PAVA.DQ</span></a></li>
               <li><a href="https://pava-ia.fr/glpi/"><i class="fa fa-regular fa-ticket"></i><span>PAVA.TICKETS</span></a></li>


               </ul>
            </div>
         </nav>
         <!-- end sidebar -->
         <!-- right content -->
         <div id="content">
            <!-- topbar -->
            <div class="topbar ">
               <nav class="navbar navbar-expand-lg navbar-light ">
                  <div class="full ">
                     <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                     <div class="logo_section">
                        <a href="index.html"><img class="img-responsive" src="images/logo/logo.png" alt="#" /></a>
                     </div>
                     <div class="right_topbar ">
                        <div class="icon_info">
                           <ul class="user_profile_dd">
                              <li>
                                 <a class="dropdown-toggle" data-toggle="dropdown">
                                    <img class="img-responsive rounded-circle" src="images/layout_img/user_img.jpg" alt="#" />
                                    <span class="name_user"><?php echo $_SESSION['email']?></span>
                                 </a>
                                 <div class="dropdown-menu">
                                    <a class="dropdown-item" href="PAVA_profil.php">My Profile</a>
                                    <a class="dropdown-item" href="logout.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </nav>
            </div>

            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>PAVA.Call</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row column1">
                     <div class="col-md-12">

                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head ">
                              <p > 
                                 <bold>Veuillez informer le chatbot de votre problème.</bold>
                              </p>

                           </div>
                           <div class="progress_bar_inner">

                              <div class="row">

                                 <div class="d-flex justify-content-center mt-3">
                                    <div class="col-12 col-md-9 mt-3 mt-md-0">

                                       <div class="message-form-container mt-2 mb-4">
                                          <div id="messages"></div>
                                          <form id="form">

                                             <input id="message-input" autocomplete="off" autofocus />
                                             <button id="SendButton" class="button"><img
                                                   src="images/logo/sendlogo.png"></button>
                                             <button id="icon-volume-off" style="display: none"
                                                class="button voice-icon"> <img src="images/logo/unmuted.png">
                                                <use xlink:href="#icon-volume_off"></use>
                                             </button>
                                             <button id="icon-volume-on" class="button voice-icon"> <img
                                                   src="images/logo/muted.png">
                                                <use xlink:href="#icon-volume_on"></use>
                                             </button>

                                             <button id="EcouterPava" onclick="recognition.start()"
                                                class=" button voice-icon">
                                                <i class="fa fa-microphone text-black"></i> </button>
                                             <button id="stopEcouterPava" onclick="recognition.stop()"
                                                class="button voice-icon "><i
                                                   class="fa fa-microphone-slash text-black"></i></button>

                                          </form>
                                          <div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <p>Si PAVA ne vous répond pas, merci d'autoriser le certificat depuis ce lien :
                           <a href="https://38.242.194.54:5005/socket.io/" target="_blank" rel="noopener noreferrer"
                              style="text-decoration:underline;">
                              https://38.242.194.54:5005/socket.io/
                           </a>
                        </p>
                     </div>
                  </div>
                  <div class="container-fluid">
                     <div class="footer">
                        <p>Copyright © 2023 Designed by PAVA. All rights reserved.<br><br>
                           <!--Distributed By: <a href="https://themewagon.com/">ThemeWagon</a>-->
                        </p>
                     </div>
                  </div>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.3/socket.io.js"
         integrity="sha512-PU5S6BA03fRv1Q5fpwXjg5nlRrgdoguZ74urFInkbABMCENyx5oP3hrDzYMMPh3qdLdknIvrGj3yqZ4JuU7Nag=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script>
         // Connect to RASA server
         const socket = io('https://38.242.194.54:5005');

         const messages = document.getElementById('messages');
         const form = document.getElementById('form');
         const messageInput = document.getElementById('message-input');

         let voiceEnabled = true;
         const iconVolumeOn = document.getElementById('icon-volume-on');
         const iconVolumeOff = document.getElementById('icon-volume-off');


         function toggleVoice() {
            if (voiceEnabled) {
               voiceEnabled = false;
               iconVolumeOn.style.display = 'none';
               iconVolumeOff.style.display = 'block';
            } else {
               if ('speechSynthesis' in window) {
                  voiceEnabled = true;
                  iconVolumeOn.style.display = 'block';
                  iconVolumeOff.style.display = 'none';
               } else {
                  alert('Sorry, your browser doesn\'t support text to speech.');
               }
            }
         }

         iconVolumeOn.addEventListener('click', toggleVoice);
         iconVolumeOff.addEventListener('click', toggleVoice);




         function scrollToBottom() {
            window.scrollTo(0, document.body.scrollHeight);
         }

         function getSessionId() {
            const storage = localStorage;
            const storageKey = 'RASA_SESSION_ID';
            const savedId = storage.getItem(storageKey);
            if (savedId) {
               return savedId;
            }
            const newId = socket.id;
            storage.setItem(storageKey, newId);
            return newId;
         }

         function utter(msg) {
            socket.emit('user_uttered', {
               'message': msg,
               'session_id': getSessionId(),
            });
         }

         function appendMessage(msg, type) {
            const item = document.createElement('div');
            item.textContent = msg;
            item.classList.add('message');
            item.classList.add(`message_${type}`);
            messages.appendChild(item);
            scrollToBottom();
            console.log('[CHAT] : ', msg);
            if (voiceEnabled && type === 'received') {
               const voiceMsg = new SpeechSynthesisUtterance();
               voiceMsg.text = msg;
               window.speechSynthesis.speak(voiceMsg);
            }
         }

         function appendImage(src, type) {
            const item = document.createElement('div');
            item.classList.add('message');
            item.classList.add(`message_${type}`);
            const img = document.createElement('img');
            img.src = src;
            img.onload = scrollToBottom;
            item.appendChild(img);
            messages.appendChild(item);
         }

         function pause() {
            console.log("Pause, attente");

            document.getElementById("StopEcouterPava").style.display = "block";
            document.getElementById("EcouterPava").style.display = "none";
            document.getElementById("EcouterPava").click();
            console.log('Start ecoute');
         }

         function appendQuickReplies(quickReplies) {
            const quickRepliesNode = document.createElement('div');
            quickRepliesNode.classList.add('quick-replies');
            quickReplies.forEach(quickReply => {
               const quickReplyDiv = document.createElement('button');
               quickReplyDiv.innerHTML = quickReply.title;
               quickReplyDiv.classList.add('button');
               quickReplyDiv.addEventListener('click', () => {
                  messages.removeChild(quickRepliesNode);
                  appendMessage(quickReply.title, 'sent');
                  utter(quickReply.payload);
               });
               quickRepliesNode.appendChild(quickReplyDiv);
            });
            messages.appendChild(quickRepliesNode);
            scrollToBottom();
         }

         form.addEventListener('submit', function (e) {
            e.preventDefault();
            const msg = messageInput.value;
            if (msg) {
               utter(msg);
               messageInput.value = '';

               appendMessage(msg, 'sent');
            }
         });

         socket.on('connect', function () {
            console.log('Connected to Socket.io server.');
            socket.emit('session_request', {
               'session_id': getSessionId(),
            });
            console.log(`Session ID: ${getSessionId()}`);
         });

         socket.on('connect_error', (error) => {
            // Write any connection errors to the console 
            console.error(error);
         });

         socket.on('bot_uttered', function (response) {
            console.log('Bot uttered:', response);
            if (response.text) {
               appendMessage(response.text, 'received');

               document.getElementById("StopEcouterPava").style.display = "block";
               document.getElementById("EcouterPava").style.display = "block";
               document.getElementById("StopEcouterPava").click();
               console.log('Stop ecoute');
               //setTimeout(pause,5000);

            }
            if (response.attachment) {
               appendImage(response.attachment.payload.src, 'received');

            }
            if (response.quick_replies) {
               appendQuickReplies(response.quick_replies);

            }
         });
      </script>
      <script>


         /* La zone texte */
         textArea = document.getElementById("message-input");

         /* Initialise la reconnaissance vocale */
         var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition
         var recognition = new SpeechRecognition();

         /* Français de France */
         recognition.lang = 'fr-FR';

         /* Lorsque une voix est détectée */
         recognition.onresult = function (event) {
            /* récupère le mot ou la phrase */
            var sentence = event.results[0][0].transcript;
            console.log('Resultat : ' + sentence + '.');
            console.log('Indice de confiance : ' + event.results[0][0].confidence);
            /* Ajoute la phrase à la zone texte en ajoutant une majuscule et un point */
            textArea.value += sentence[0].toUpperCase() + sentence.slice(1) + ". ";
            document.getElementById("SendButton").click();
         }

         recognition.onerror = function (event) {
            console.log('Erreur : ' + event.error);
            document.getElementById("StopEcouterPava").style.display = "none";
            document.getElementById("EcouterPava").style.display = "block";
            document.getElementById("StopEcouterPava").click();
            console.log('Stop ecoute');
         }


      </script>

      <style>
         body {
            --white-color: #f3f4fb;
            --black-color: black;
            --blue-color: #5a18ee;
            --light-purple-color: #7f7afc;
            --light-violet-color: #8c54f4;
            --darker-violet-color: #713dc3;
            --dark-violet-color: #5d2db0;
            font-family: Roboto, sans-serif;
            background-color: var(--blue-color);
         }

         #form {
            padding: 0.25rem;

            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            height: 4rem;
            box-sizing: border-box;
            background-color: var(--white-color);
         }

         .message-form-container {
            background-color: beige;
            margin: 0 auto;
            max-width: 90%;
            padding: 20px;
            margin-bottom: 2.5px;
            border-radius: 10px;
         }

         .message-form-container form {
            margin-top: 20px;
         }

         #message-input {
            flex-grow: 1;

            background-color: var(--white-color);
         }

         #message-input:focus {
            outline: none;
         }

         .button {
            background: var(--white-color);
            border: none;
            padding: 0 1rem;
            margin: 0.25rem;
            margin-top: 0.25rem;
            border-radius: 3px;
            outline: none;
            font: inherit;
         }

         .button:hover {
            background: var(--white-color);
         }

         .button:active {
            background: var(--white-color);
         }

         .mic {
            color: black;
         }

         #messages {
            display: flex;
            flex-direction: column;
            padding: 10px 10px 60px 10px;
         }

         .message {
            padding: 0.5rem 1rem;
            border-radius: 10px;
            word-wrap: break-word;

            margin-bottom: 10px;
         }

         .message_received {
            background: var(--white-color);
            color: var(--black-color);
            border-bottom-left-radius: 0;
            align-self: flex-start;
         }

         .message_sent {
            color: var(--white-color);
            background: var(--light-purple-color);
            border-bottom-right-radius: 0;
            align-self: flex-end;
         }

         .header {
            background-color: var(--white-color);
            color: var(--white-color);
            text-align: center;
            padding: 12px;
         }

         .title {
            font-size: 23px;
         }

         .quick-replies {
            display: flex;
            border-radius: 3px;
            height: 2.5rem;
            box-sizing: border-box;
         }

         .voice-icon {
            fill: currentColor;
            font-size: 22px;
            width: 3em;
            margin-top: center;
         }

         .btn-microphone {
            border: none;
            background-color: transparent;
            font-size: 20px;
            transition: font-size 0.2s;
            cursor: pointer;
         }
      </style>

      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script>
      <!-- chart js -->
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <script src="js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <script src="js/chart_custom_style1.js"></script>
      <script src="client.js"></script>
</body>

</html>