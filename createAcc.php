<?php

$email = filter_input(INPUT_POST,'email');
$password = filter_input(INPUT_POST, 'password');
$full_name = filter_input(INPUT_POST, 'full_name');

if(!empty($email)){
    if(!empty($password) && !empty($full_name) ){

        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "root";
        $dbname = "test";

        // Création de la connexion
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
        if (mysqli_connect_error()) {
            die('Erreur de connexion (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
        } else {
            // Vérifier si l'email est déjà enregistré dans la base de données
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res && $res->num_rows > 0) {
                echo "Cet email est déjà associé à un compte utilisateur.";
                exit;
            } else {
                // Obtention de la date actuelle
                $dateActuelle = date('Y-m-d');

                // Ajout de 30 jours à la date actuelle
                $dateFuture = strtotime('+30 days', strtotime($dateActuelle));

                // Formatage de la nouvelle date dans le format souhaité (par exemple, 'Y-m-d H:i:s')
                $dateFormatee = date('Y-m-d H:i:s', $dateFuture);

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


                $sql = "INSERT INTO users (fullName, email, password, dateExpiration, token) VALUES (?,?,?,?,'')";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss",  $full_name,$email, $hashedPassword, $dateFormatee);

                if ($stmt->execute()) {
                    header("Location: login.php");
                } else {
                    echo "Erreur d'insertion dans la base de données : " . $stmt->error;
                    exit;
                }

                // Fermer la connexion à la base de données
                $stmt->close();
                $conn->close();
            }
        }

    } else{
        echo "Veuillez remplir tous les champs obligatoires.";
    }
} else{
    echo "L'email ne doit pas être vide."; 
} 

?>
