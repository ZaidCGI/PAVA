<?php 
 try {
    if (!isset($_SESSION['email'])) { 
        throw new Exception('Index non défini: email');
    }
} catch (Exception $e) {
    header('Location: login.php');
    exit();
}
?>