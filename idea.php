<?php
// Connection to the database (replace with your credentials)
$host = "localhost";
$user = "root";
$password = "";
$db = "commentaires";

$connexion = new mysqli($host, $user, $password, $db);

// Check connection
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Check if POST request and username/description are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["description"])) {

    // Escape special characters for security
    $description = $connexion->real_escape_string($_POST["description"]); // Assuming UTF-8 encoding

    // Get current date and time in SQL format
    $date = date('Y-m-d H:i:s');

    // Username should also be escaped if necessary (check encoding)
    $username = $connexion->real_escape_string($_POST["username"]);

    // Corrected prepared statement (consider changing `description` type if needed)
    $requete = $connexion->prepare("INSERT INTO ideas (username, description, date) VALUES (?, ?, ?)");

    // Bind parameters (data types should match table's)
    $requete->bind_param("sss", $username, $description, $date);

    if ($requete->execute()) {
        $success = true;
        $message = "Commentaire inséré avec succès";
    } else {
        $success = false;
        $message = "Erreur lors de l'insertion du commentaire : " . $connexion->error . " (" . mysqli_error($connexion) . ")";
    }

    // Respond with JSON (consider error handling for invalid JSON)
    echo json_encode(array("success" => $success, "message" => $message));
} else {
    // Respond with a 400 error code for invalid requests
    http_response_code(400);
    echo "Requête invalide";
}

// Close connection
$connexion->close();