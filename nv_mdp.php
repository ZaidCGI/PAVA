<?php

include ('./modele/modele.bd.php');

if(isset($_GET['token']) && $_GET['token']!= '')
{
    $modele = new Modele_bd();

    $req = $modele->conn->prepare("SELECT email FROM users WHERE token=?");

    $req->execute([$_GET['token']]);
    $email = $stmt->fetchColumn();

    if($email)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Création d'un nouveau mot de passe</title>
        </head>
        <body>
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
                                <form method="post"   name="loginForm">
                                    <fieldset>
                                        <div class="field">
                                            <label for="newPassword" class="label_field">Nouveau mot de passe</label>
                                            <input type="password" name="newPassword" placeholder="Veuillez insérer votre nouveau mot de passe" />
                                        </div>
                                        <div class="field margin_0">
                                            <label class="label_field hidden">hidden label</label>
                                            <input type="submit" value="Confirmer"/>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php 
    }
}
if(isset($_POST['newPassword']))
{
    $newPassword=$_POST['newPassword'];
    $mod = new Modele_bd();
    $req = $mod->conn->prepare("UPDATE users SET password=? WHERE email=?");
    $req->execute([$newPassword, $_POST['email']]);
    echo "Mdp modifié avec succèes";
}
?>