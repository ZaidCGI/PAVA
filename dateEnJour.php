<?php
include ('./modele/modele.bd.php');

$modele = new Modele_bd();

$req = $modele->conn->prepare("SELECT dateExpiration FROM users WHERE email = ?");

$req->execute(array($_SESSION['email']));
$indice =0;
if ($req->rowCount() != 0) {
    $row = $req->fetch(PDO::FETCH_OBJ);
    $date = $row->dateExpiration;

    // Vérifier si la date est antérieure à aujourd'hui
    $today = date("Y-m-d");
    if ($date < $today) {
       $indice =1;

    }
}

// Fermer la connexion à la base de données
$modele->conn=null;
?>
