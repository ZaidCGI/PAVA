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
                        <h6>PAVA.</h6>
                        <p><span class="online_animation"></span> Online</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="sidebar_blog_2">
                  <h4>Navigation</h4>
                  <ul class="list-unstyled components">
                     <!--<li class="active">-->
                        <li><a href="https://pava-ia.fr/index1.php"><i class="fa fa-tasks orange_color"></i><span>Dashboard</span></a></li>
                  <li>
                        <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-eye red_color"></i> <span>PAVA.eye</span></a>
                        <ul class="collapse list-unstyled" id="element">
                           <li><a href="https://pava-ia.fr/PAVA-EYE-HANDS.php">> <span>Detection de mains</span></a></li>
                     <li><a href="https://pava-ia.fr/PAVA-EYE-FACE.php">> <span>Detection du visage</span></a></li>
                           <li><a href="https://pava-ia.fr/PAVA-EYE-OBJECTS.php">> <span>Detection d'objets</span></a></li>
                     <li><a href="https://pava-ia.fr/PAVA-EYE-OBJECTS-V2.php">> <span>Detection d'objets V2</span></a></li>                           
                        </ul>
                     </li>
                  <li><a href="https://pava-ia.fr/PAVAAR.php"><i class="fa fa-cube blue_color"></i><span>PAVA.AR</span></a></li>
                  <li><a href="https://pava-ia.fr/PAVACALL.php"><i class="fa fa-comment-o yellow_color"></i><span>PAVA.Call</span></a></li>
                  <li><a href="https://pava-ia.fr/PAVAOCR.php"><i class="fa fa-file-photo-o green_color"></i><span>PAVA.OCR</span></a></li>
                  <li><a href="https://pava-ia.fr/PAVADQ.php"><i class="fa fa-graduation-cap orange_color"></i><span>PAVA.DQ</span></a></li>
                  <li><a href="https://pava-ia.fr/glpi/"><i class="fa fa-regular fa-ticket"></i><span>PAVA.TICKETS</span></a></li>
                  </ul>
               </div>
         </nav>
         <!-- end sidebar -->
         <!-- right content -->
         <div id="content">
            <!-- topbar -->
            <div class="topbar">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        <div class="logo_section">
                           <a href="https://pava-ia.fr/index.php"><img class="img-responsive" src="images/logo/logo.png" alt="#" /></a>
                        </div>
                        <div class="right_topbar">
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
            <!-- end topbar -->
            <!-- dashboard inner -->
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>PAVA.Eye</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row column1">
                   
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>PAVA.Eye Objects</h2>
                              </div>
                           </div>
                           <div class="full progress_bar_inner">
                              <div class="row">
                                 <div class="col-md-12 ml-4 mt-2">
                                    <h2 class=" alert alert-primary mr-5">Options</h2>
                                    <div class="ml-3">
                                       <div class="option ">
                                          <p><input id="use-datachannel" type="checkbox" />
                                             <label for="use-datachannel">Afficher les datas</label>
                                             <select id="datachannel-parameters">
                                                <option value='{"ordered": true}'>Ordonne</option>
                                                <option value='{"ordered": false, "maxRetransmits": 0}'>Desordonne
                                                </option>
                                                <option value='{"ordered": false, "maxPacketLifetime": 500}'>Desordonne
                                                   (500ms de duree)</option>
                                             </select>
                                          </p>
                                       </div>
                                       <div class="option" style="display: none">
                                          <p><input id="use-audio" type="checkbox" />
                                             <label for="use-audio">Use audio</label>
                                             <select id="audio-codec">
                                                <option value="default" selected>Default codecs</option>
                                                <option value="opus/48000/2">Opus</option>
                                                <option value="PCMU/8000">PCMU</option>
                                                <option value="PCMA/8000">PCMA</option>
                                             </select>
                                          </p>
                                       </div>
                                       <div class="option">
                                          <p><input id="use-video" type="checkbox" checked="checked"
                                                style="display: none" />
                                             <label for="use-video">Parametres de la camera</label>
                                             <select id="video-resolution">
                                                <option value="" selected>Resolution par defaut</option>
                                                <option value="80x60">80x60</option>
                                                <option value="160x120">160x120</option>
                                                <option value="320x240">320x240 (conseille)</option>
                                                <option value="640x480">640x480</option>
                                                <option value="960x540">960x540</option>
                                                <option value="1280x720">1280x720</option>
                                             </select>
                                             <select id="video-transform" style="display: none">
                                                <option value="none" selected>No transform</option>
                                                <option value="edges">Edge detection</option>
                                                <option value="cartoon">Cartoon effect</option>
                                                <option value="rotate">Rotate</option>
                                             </select>
                                             <select id="video-codec" style="display: none">
                                                <option value="default" selected>Default codecs</option>
                                                <option value="VP8/90000">VP8</option>
                                                <option value="H264/90000">H264</option>
                                             </select>
                                          </p>
                                       </div>
                                       <div class="option">
                                          <p><input id="use-stun" type="checkbox" />
                                             <label for="use-stun">Utiliser le serveur Turn de PAVA (Si jamais la
                                                connexion
                                                de fonctionne pas)</label>
                                          </p>
                                       </div>

                                       <p><button id="start" onclick="start()" class="btn btn-success">Lancer</button></p>
                                       <p><button id="stop" style="display: none" onclick="stop()" class="btn btn-danger">Stop</button></p>

                                    </div>
                                    <h2 class="alert alert-warning mr-5">Etat</h2>

                                    <div class="ml-3">
                                       <p>
                                          Etat ICE gathering: <span id="ice-gathering-state" style="font-weight: bold;"> </span>
                                       </p>
                                       <p>
                                          Etat ICE connection: <span id="ice-connection-state" style="font-weight: bold;"></span>
                                       </p>
                                       <p>
                                          Etat du signal: <span id="signaling-state" style="font-weight: bold;"></span>
                                       </p>
                                    </div>
                                       <p>
                                       <div id="media" style="display: none">
                                          
                                          <h2 class="alert alert-info mr-5">Media</h2>
                                          <div class="mr-3">
                                          <audio id="audio" autoplay="true"></audio>
                                          <video id="video" autoplay="true" playsinline="true"></video>
                                       </div>
                                       </div>
                                       </p>

                                   
                                    <p>
                                       <h2 class="alert alert-secondary mr-5">Datas</h2>
                                       <div class="ml-3">
                                          <pre id="data-channel" style="height: 200px;"></pre>
                                       </div>
                                    </p>

                                    <!--<p><h2>SDP</h2></p>-->

                                    <!--<p><h3>Offre</h3>-->
                                    <pre id="offer-sdp" style="display: none"></pre>
                                    </p>

                                    <!--<p><h3>Reponse</h3>-->
                                    <pre id="answer-sdp" style="display: none"></pre>
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                  <!-- footer -->
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