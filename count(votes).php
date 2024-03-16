<?php

$bdd = new PDO('mysql:host=localhost;dbname=commentaires;charset=utf8', 'root', '');

$sql = 'SELECT nombre FROM votes WHERE id = 1';
$stmt = $bdd->query($sql);
$vote = $stmt->fetchColumn();

echo $vote;