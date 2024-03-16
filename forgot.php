<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupérer les valeurs des champs email et nouveau mot de passe
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];

    // Connexion à la base de données 
    $servername = "localhost";
    $username = "votre_nom_utilisateur";
    $password = "votre_mot_de_passe";
    $dbname = "nom_de_votre_base_de_données";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Préparer et exécuter la requête pour mettre à jour le mot de passe
    $sql = "UPDATE users SET Password = '$newPassword' WHERE Email = '$email'";

    if ($conn->query($sql) === TRUE) {
        echo "Your password has been successfully reset!";
    } else {
        echo "Error updating password : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>

