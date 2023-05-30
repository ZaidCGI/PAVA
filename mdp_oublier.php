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
   <title>Récupération de mot de passe</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- site icon -->
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <!-- site css -->
   <link rel="stylesheet" href="style.css" />
   <!-- responsive css -->
   <link rel="stylesheet" href="css/responsive.css" />
   <!-- color css -->
   <!-- select bootstrap -->
   <link rel="stylesheet" href="css/bootstrap-select.css" />
   <!-- scrollbar css -->
   <link rel="stylesheet" href="css/perfect-scrollbar.css" />
   <!-- custom css -->
   <link rel="stylesheet" href="css/custom.css" />
   <!-- calendar file css -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="inner_page login">
   <div class="full_container">
      <h3 class="center verticle_center pt-5"><u> Réinitialisation du mot de passe.</u> </h3>
         <div class="center verticle_center full_height ">
            <div class="login_section mb-5"> 
               <div class="logo_login">
                  <div class="center">
                     <img width="210" src="images/logo/logo.png" alt="#" />
                  </div>
               </div>
               <div class="login_form">
                  <p > <bold>Veuillez insérer votre mail afin de recevoir un mail et réinitialisé votre mot de passe. </bold></p>
                  <form method="post">              
                     <fieldset>
                        <div class="field">
                           <label class="label_field">Adresse mail</label>
                           <input type="email" name="email" placeholder="Veuillez insérer votre adresse mail" />
                        </div>
                        <div class="field margin_0">
                           <label class="label_field hidden">hidden label</label>
                           <button type="submit" class="main_bt">M'envoyer un mail</button>
                        </div>
                     </fieldset>
                  </form>
               </div>
            </div>
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
   <!-- nice scrollbar -->

</body>
</html>

<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_POST['email']))
{
   $token = uniqid();
   $url = "http://localhost/pluto-1.0.0/mdp_oublier/token?token=$token";

   $message ="Voici votre lien pour la réinitialisation de votre mot de passe : $url";
   $headers = 'From: votre_adresse_email@example.com' . "\r\n";
   $headers .= 'Content-Type: text/plain; charset=utf-8' . "\r\n";

   $mail= new PHPMailer(true);

   $mail->isSMTP();
   $mail->Host='ssl://smtp.gmail.com:465';
   $mail->SMTPAuth=true;
   $mail->Username='pavacgi@gmail.com';
   $mail->Password='mvlhtxwaenihxamt';
   $mail->SMTPSecure="ssl";
   $mail->Port= 465;
   $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
  );
   $mail->SMTPDebug = 2;

   $mail->setFrom('pavacgi@gmail.com');
   
   $mail->addAddress($_POST['email']);
   $mail->isHTML(true);
   $mail->Subject='Mot de passe oublié';
   $mail->Body= $message;

   $mail->send();
  

   /**if($mail->send())
   {
      $modele = new Modele_bd();

      $req = $modele->conn->prepare("UPDATE users SET token=? WHERE email=?");
  
      $req->execute([$token, $_GET['token']]);
   }*/
}


?>