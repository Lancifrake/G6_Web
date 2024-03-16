<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_données = "commentaires";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_données);

// Vérifier la connexion
if ($connexion->connect_error) {
  die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Requête pour récupérer le nombre de commentaires
$requete = "SELECT COUNT(*) AS total_commentaires FROM comments";
$resultat = $connexion->query($requete);

if ($resultat && $resultat->num_rows > 0) {
  $row = $resultat->fetch_assoc();
  $nombre_commentaires = $row["total_commentaires"];
  echo '<span class="badge bg-light" style="color: black; margin-right: 0px; margin-left: 5px;">' . $nombre_commentaires . '</span>';
} else {
  echo "Erreur lors de la récupération du nombre de commentaires : " . $connexion->error;
}

// Fermer la connexion à la base de données
$connexion->close();