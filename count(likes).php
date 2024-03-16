<?php

$bdd = new PDO('mysql:host=localhost;dbname=commentaires;charset=utf8', 'root', '');

$sql = 'SELECT nombre FROM likes WHERE id = 1';
$stmt = $bdd->query($sql);
$like = $stmt->fetchColumn();

echo $like;