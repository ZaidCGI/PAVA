<?php
include('connect.php');

// Démarrer la session
if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
}

// Détruire la session

// Effacer le cookie de session
if (isset($_COOKIE['autoconnection'])) {
    $cookieString = $_POST['email'] . $delimiter . encryptPassword($_POST['password']);

    setcookie('autoconnection', $cookieString, time()-42000, '/');


}
    
setcookie('PHPSESSID', '', time() - 3600, '/');
unset($_COOKIE['PHPSESSID']);
// Rediriger l'utilisateur vers la page de login
header('Location: login.php');
exit();
?>