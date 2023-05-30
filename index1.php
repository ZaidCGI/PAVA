<?php
session_start();
require("dateEnJour.php");
include('checkConnection.php');

?>
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
                        <div class="user_img"><a href="index1.php"><img class="img-responsive" src="images/layout_img/user_img.jpg" alt="#" /></a></div>
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
                              <h2>Dashboard</h2>
                           </div>
                        </div>
                     </div>
                     <div class="row column1">
                       
                        
                     </div>
                     <div class="list_cont">
                        <p>Bienvenue dans PAVA(Personnal Assistant for Virtual), votre assistant personnel d'automatisation !  </p>
                        </br> </br> 
                     </div>
                     <div class="row column4 graph">
                        <div class="col-md-6 margin_bottom_30">
                           <div class="dash_blog ">
                              <div class="dash_blog_inner">
                                 <div class="dash_head">
                                    <h3><span><i class="fa fa-eye red_color"></i> PAVA.eye</span></h3>
                                 </div>
                                 <div class="list_cont">
                                    <p>Pava.eye est un système qui détecte en temps réel divers éléments et peut être utilisé dans différents contextes.<br>
                                        Il est capable de reconnaître des objets nécessitant une commande ou une réparation, d'effectuer une reconnaissance faciale et un pointage automatique. <br><br>
                                        De plus, Pava.eye permet également de vérifier les gestes et les postures et facilite la communication en utilisant le langage des signes. <br><br><br>
                                        En résumé, Pava.eye est un outil polyvalent qui peut améliorer la précision et l'efficacité dans plusieurs applications distinctes.
                                    </p>
                                 </div>
                                 <div class="task_list_main">
                                    <ul class="task_list">
                                       <li><a href="https://pava-ia.fr/PAVA-EYE-HANDS.php" style="margin-left :50px"><strong>Détection de mains </strong></a></li>
                                       <li  ><a href="https://pava-ia.fr/PAVA-EYE-FACE.php" style="margin-left :50px"><strong>Détection du visage </strong></a></li>
                                       <li ><a href="https://pava-ia.fr/PAVA-EYE-OBJECTS.php" style="margin-left :50px"> <strong>Détection d'objets </strong></a></li>
                                       <li ><a href="https://pava-ia.fr/PAVA-EYE-OBJECTS-V2.php" style="margin-left :50px"><strong>Détection d'objets V2 </strong></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="dash_blog">
                              <div class="dash_blog_inner">
                                 <div class="dash_head">
                                    <h3><span><i class="fa fa-cube blue_color"></i> PAVA.AR</span></h3>
                                 </div>
                                 <div class="list_cont">
                                    <p>PAVA.AR est une solution de réalité augmentée qui peut être utilisée pour améliorer les maintenances techniques. <br>
                                       En fournissant une assistance en temps réel, PAVA.AR permet aux techniciens de résoudre rapidement 
                                             les problèmes techniques complexes et de réduire les temps d'arrêt coûteux.<br><br>

                                       De plus, PAVA.AR peut être utilisé comme un guide visuel pour aider les techniciens à identifier les pièces de rechange nécessaires pour une réparation.
                                        En utilisant des instructions visuelles claires et précises, cette solution améliore la précision des réparations et réduit les erreurs humaines.<br><br>
                                       
                                       En utilisant PAVA.AR, les techniciens peuvent accéder à un guide visuel en temps réel pour les aider à effectuer les réparations plus rapidement et en toute sécurité. 
                                       En résumé les maintenances techniques sont plus efficaces et les coûts de réparation sont réduits.</p>
                                 </div>
                                 
                                 <div class="read_more">
                                    <div class="center"><a class="main_bt read_bt" href="https://pava-ia.fr/PAVAAR.php">En savoir plus</a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="row column4 graph">
                        <div class="col-md-6 margin_bottom_30">
                           <div class="dash_blog">
                              <div class="dash_blog_inner">
                                 <div class="dash_head">
                                    <h3><span><i class="fa fa-comments-o orange_color"></i> PAVA.CALL</span></h3>
                                 </div>
                                 <div class="list_cont">
                                    <p>La fonction PAVA.Call est un chatbot développer pour aider le client de différentes manière. <br>
                                       PAVA.Call est polyvalente et peut être utilisée de diverses manières, notamment en passant par une requête API ou en l'intégrant sur un site Web. <br><br>
                                       De plus, elle offre la possibilité de communiquer à l'écrit ou à l'oral. <br><br>
                                       Sa principale utilité est d'aider le client à détecter le problème et de contacter des techniciens.<br>
                                       Il est aussi possible que PAVA.Call démarre l'impression de pièces.
                                 
                                    </p>
                                 </div>                                
                                 <div class="read_more">
                                    <div class="center"><a class="main_bt read_bt" href="https://pava-ia.fr/PAVACALL.php">En savoir plus</a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="dash_blog">
                              <div class="dash_blog_inner">
                                 <div class="dash_head">
                                    <h3><span><i class="fa fa-file-photo-o green_color"></i> PAVA.OCR</span></h3>
                                 </div>
                                 <div class="list_cont">
                                    <p> PAVA.OCR (Optical Character Recognition) est une technologie de reconnaissance optique de caractères qui permet de numériser automatiquement du texte imprimé ou manuscrit afin de le convertir en texte électronique modifiable.<br><br>
                                        Elle permet de scanner des documents papier et de les convertir en fichiers numériques éditables, tels que des fichiers Word ou PDF. <br><br>
                                        Cette technologie est basée sur l'analyse de l'image numérisée d'un texte et utilise des algorithmes pour reconnaître les caractères et les convertir en texte électronique.<br><br>
                                         Les applications courantes de la technologie OCR comprennent la numérisation de documents papier, la reconnaissance de codes-barres, la lecture de formulaires et la reconnaissance de caractères pour les applications de reconnaissance de voix.</p>
                                 </div>
                                 
                                 <div class="read_more">
                                    <div class="center"><a class="main_bt read_bt" href="https://pava-ia.fr/PAVAOCR.php">En savoir plus</a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="row column4 graph">
                        <div class="col-md-6 margin_bottom_30">
                           <div class="dash_blog">
                              <div class="dash_blog_inner">
                                 <div class="dash_head">
                                    <h3><span><i class="fa fa-graduation-cap orange_color"></i> PAVA.DQ</span></h3>
                                 </div>
                                 <div class="list_cont">
                                    <p>

                                       Le document questioning est une méthode d'interrogatoire ou d'entrevue qui consiste à poser une série de questions structurées pour recueillir des informations précises et pertinentes sur un sujet donné.<br> Cette méthode est souvent utilisée dans les enquêtes criminelles ou dans les processus d'évaluation de candidats lors d'un recrutement.<br> <br> 

                                       Le document questioning est conçu pour être utilisé de manière systématique et rigoureuse afin de minimiser les biais et les erreurs d'interprétation des informations.<br>  Les questions posées sont généralement préparées à l'avance et suivent un ordre logique pour permettre une analyse cohérente des réponses. Les questions sont également formulées de manière à minimiser les ambiguïtés et à obtenir des réponses claires et concises.<br> <br> 
                                       
                                       Le document questioning peut être utilisé seul ou en combinaison avec d'autres méthodes d'interrogatoire ou d'évaluation, telles que l'observation, l'analyse de documents, ou les tests psychométriques. Cette méthode permet de recueillir des informations de manière méthodique et structurée, ce qui facilite l'analyse et la prise de décision.
                                    </p>
                                 </div>                       
                                 <div class="read_more">
                                    <div class="center"><a class="main_bt read_bt" href="https://pava-ia.fr/PAVADQ.php">En savoir plus</a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="dash_blog">
                              <div class="dash_blog_inner">
                                 <div class="dash_head">
                                    <h3><span><i class="fa fa-regular fa-ticket"></i> PAVA.TICKETS</span></h3>
                                 </div>
                                 <div class="list_cont">
                                    <p> PAVA.TICKETS est une solution de ticketing type GLPI (Gestionnaire Libre de Parc Informatique). <br><br>
                                       Elle offre une gestion de tickets avancée pour suivre les demandes des utilisateurs et les problèmes rencontrés. <br>
                                       Les utilisateurs peuvent soumettre des demandes de support technique ou des demandes de service via un portail en libre-service. Les tickets sont ensuite automatiquement assignés à un technicien ou à une équipe pour le traitement. <br><br>
                                       Les tickets peuvent être organisés selon plusieurs critères tels que le niveau de priorité, l'état d'avancement, le temps écoulé depuis leur création, ou encore par catégorie de problèmes. Les utilisateurs peuvent également suivre l'état de leurs demandes via le portail en libre-service et recevoir des mises à jour régulières sur leur progression.</p>
                                 </div>
                                 
                                 <div class="read_more">
                                    <div class="center"><a class="main_bt read_bt" href="https://pava-ia.fr/glpi/">En savoir plus</a></div>
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
	  <div id="rasa-chat-widget" data-websocket-url="https://38.242.194.54:5005" ></div>
	  <script src="js/RASA.js" type="application/javascript"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.3/socket.io.js"
            integrity="sha512-PU5S6BA03fRv1Q5fpwXjg5nlRrgdoguZ74urFInkbABMCENyx5oP3hrDzYMMPh3qdLdknIvrGj3yqZ4JuU7Nag=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </script>
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
   </body>
</head>