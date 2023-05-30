<?php
session_start();
include("dateEnJour.php");
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
   <meta charset='utf-8'>
   <meta http-equiv='X-UA-Compatible' content='IE=edge'>

   <meta name='viewport' content='width=device-width, initial-scale=10'>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="style/ocr.css">
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script src="https://kit.fontawesome.com/4414288e8e.js"></script>
   <script src='js/tesseract.min.js'></script>
   
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
                           <h2>PAVA.OCR</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row column1">
                     <!-- end testimonial -->
                     <!-- progress bar -->
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Veuillez sélectionner une image à traiter avec l'OCR afin qu'il puisse la convertir
                                    en texte.
                                 </h2>
                              </div>
                           </div>
                           <div class=" progress_bar_inner container mt-3 mb-5">
                              <div class="row row d-flex justify-content-center mb-3">
                                 <div class="col-12 col-md-4 mt-3 mt-md-0">
                                    <div class="box mt-3">
                                       <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1"
                                          data-multiple-caption="{count} files selected" multiple />

                                          <div class="row align-items-center ml-2">
                                             <div class="mr-1">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                                     <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                                 </svg>
                                             </div>
                                             <div class="align-items-center">
                                                 <span class="align-middle">Choose a file&hellip;</span>
                                             </div>
                                         </div>                                         
                                    </div>

                                 </div>

                              </div>
                              <hr>



                              <div class="row mb-5">
                                 <div class="col-12 col-md-5">
                                    <div class="image-container">
                                       <img id="selected-image" src="./images/OCR/CGI-Demo-OCR.png"
                                          class="col-12 p-0" />
                                    </div>
                                 </div>
                                 <div class="col-12 col-md-1">
                                    <br><br><br><br><br>
                                    <i id="arrow-right" class="fas fa-arrow-right d-none d-md-block"></i>
                                    <i id="arrow-down" class="fas fa-arrow-down d-block d-md-none"></i>
                                 </div>
                                 <div class="col-12 col-md-5 ">


                                    <div id="log">
                                       <span id="startPre">
                                          <a id="startLink" href="#">Cliquez ici pour reconnaitre le texte de
                                             demonstration</a>
                                          ou choisissez votre propre image
                                       </span>
                                    </div>




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
         <script src="js/tesseract-ocr.js"></script>
         <style>



         </style>

      </div>

   </div>

</body>

</html>