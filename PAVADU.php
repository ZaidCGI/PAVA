<?php
session_start();
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
               <button type="button" class="btn btn-primary" href="logout.php">Se déconnecter</button>
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
                  <li><a href="https://pava-ia.fr"><i class="fa fa-tasks orange_color"></i><span>Dashboard</span></a>
                  </li>
                  <li><a href="https://pava-ia.fr/PAVA-Eye"><i class="fa fa-eye red_color"></i><span>PAVA.Eye</span></a>
                  </li>
                  <li><a href="https://pava-ia.fr/PAVAAR"><i class="fa fa-cube blue_color"></i><span>PAVA.AR</span></a>
                  </li>
                  <li><a href="https://pava-ia.fr/PAVACALL"><i
                           class="fa fa-comment-o yellow_color"></i><span>PAVA.Call</span></a></li>
                  <li>
                     <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                           class="fa fa-diamond purple_color"></i> <span>Elements</span></a>
                     <ul class="collapse list-unstyled" id="element">
                        <li><a href="general_elements.html">> <span>General Elements</span></a></li>
                        <li><a href="media_gallery.html">> <span>Media Gallery</span></a></li>
                        <li><a href="icons.html">> <span>Icons</span></a></li>
                        <li><a href="invoice.html">> <span>Invoice</span></a></li>
                     </ul>
                  </li>
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
                     <button type="button" id="sidebarCollapse" class="sidebar_toggle"><img
                           src="images/logo/Menu-Logo.png" /></button>
                     <div class="logo_section">
                        <a href="index1.html"><img class="img-responsive" src="images/logo/logo.png" alt="#" /></a>
                     </div>
                     <div class="right_topbar">
                        <div class="icon_info">
                           <ul>
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
                           <h2>PAVA.DU</h2>
                        </div>
                     </div>
                  </div>
                  <div class="row column1">
                  
                     <div class="col-md-12">
                        <div class="white_shd full margin_bottom_30">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>PAVA.Eye</h2>
                              </div>
                           </div>
                           <div class="full progress_bar_inner">
                              <div class="row">
                                 <div class="col-md-12 mt-5 ml-2">
                                    <form onsubmit="mindeeSubmit(event)">
                                       <input type="file" id="my-file-input" name="file" />
                                       <input type="submit" />

                                    </form>
                                    <p>
                                       Resultat: <span id="Texttest"></span>
                                    </p>

                                    <script type="text/javascript">
                                       const mindeeSubmit = (evt) => {
                                          evt.preventDefault()
                                          let myFileInput = document.getElementById('my-file-input');
                                          let myFile = myFileInput.files[0]
                                          if (!myFile) { return }
                                          let data = new FormData();
                                          data.append("document", myFile, myFile.name);

                                          let xhr = new XMLHttpRequest();

                                          xhr.addEventListener("readystatechange", function () {
                                             if (this.readyState === 4) {
                                                console.log(this.responseText);

                                                document.getElementById("Texttest").textContent = this.responseText;
                                             }
                                          });

                                          xhr.open("POST", "https://api.mindee.net/v1/products/Pava/pava/v1/predict");
                                          xhr.setRequestHeader("Authorization", "Token 13f16754351e6a0097185da03dacb235");
                                          xhr.send(data);
                                       }
                                    </script>
                                 </div>
                              </div>
                           </div>
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