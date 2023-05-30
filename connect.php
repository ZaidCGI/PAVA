<?php

include ('./modele/modele.bd.php');

function encryptPassword( $password ) {
    $encrypted = "";
    for( $i = strlen($password) - 1; $i >= 0 ; $i-- ) {
        $encrypted .= chr(ord($password[$i]) + 1);
    }
    return $encrypted;

}

function decryptPassword( $password ) {
    $decrypted = "";
    for( $i = strlen($password) - 1; $i >= 0 ; $i-- ) {
        $decrypted .= chr(ord($password[$i]) - 1);

    }
    return $decrypted;


}

if( isset($_COOKIE['autoconnection']) && is_string($_COOKIE['autoconnection']) ) {
   

    $delimiter = "//";
    $split = explode($delimiter, $_COOKIE['autoconnection']);
    $email = isset($split[0]) ? $split[0] : "";
    $password = isset($split[1]) ? decryptPassword($split[1]) : "";
    // ... Tenter de connecter l'utilisateur
    if( session_status() == PHP_SESSION_ACTIVE ) {
        header("Location: index1.php");
        exit;
    }
    else {
        // Suppression du cookie
        setcookie( 'autoconnection', null, time() - 3600 );
    }
}

if(isset($_POST['email'])){
if(!empty($_POST['email'])){
   if(!empty($_POST['password'])){

        $modele = new Modele_bd();

        $req = $modele->conn->prepare("SELECT email, password
        FROM users WHERE email = ? AND password= ?");

       $req->execute(array($_POST['email'], $_POST['password']));

        if ($req->rowCount() != 0) {
            $cookieDuration = 60 * 60 * 24 * 30; // 30 jours

            $ligne = $req->fetch(PDO::FETCH_OBJ);

            session_set_cookie_params($cookieDuration);
            session_start();
            
            $_SESSION['email'] = $_POST['email'];


                   
            if($_POST['remember'])
            {
                $delimiter = "//";
                $cookieString = $_POST['email'] . $delimiter . encryptPassword($_POST['password']);

               
    
                // Définir la durée du cookie de session
                session_set_cookie_params($cookieDuration);
                setcookie( 'autoconnection', $cookieString, time() + $cookieDuration );
            }
            // Définir la durée de la session
            $_SESSION['expire'] = time() + $cookieDuration;
            header("Location: index1.php");
            exit;

        } else {
            header("Location: login.php?error=1");
        }
            
    }
} else {
    echo "Password should not be empty";
} 
}

?>
