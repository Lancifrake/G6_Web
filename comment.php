<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$db = "commentaires";

$connexion = new mysqli($host, $user, $password, $db);

// Vérifier la connexion
if ($connexion->connect_error) {
  die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pseudo"]) && isset($_POST["commentaire"])) {
  $pseudo = $connexion->real_escape_string($_POST["pseudo"]); // Échapper les caractères spéciaux
  $commentaire = $connexion->real_escape_string($_POST["commentaire"]); // Échapper les caractères spéciaux
  $date = date('Y-m-d H:i:s'); // Récupérer la date et l'heure actuelles au format SQL

  // Requête d'insertion sécurisée
  $requete = $connexion->prepare("INSERT INTO comments (username, comment, date) VALUES (?, ?, ?)");
  $requete->bind_param("sss", $pseudo, $commentaire, $date);

  if ($requete->execute()) {
    $success = true; // Indicateur succès
    $message = "Commentaire inséré avec succès";
    header("Location: events-1.php");
 
  } else {
    $success = false; // Indicateur d'échec
    $message = "Erreur lors de l'insertion du commentaire : " . $connexion->error;
  }

  // Répondre avec JSON
  echo json_encode(array("success" => $success, "message" => $message));
} else {
  // Répondre avec un code d'erreur pour les requêtes incorrectes
  http_response_code(400);
  echo "Requête invalide";
}

// Fermer la connexion à la base de données
$connexion->close();