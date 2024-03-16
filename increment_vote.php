<?php

$bdd = new PDO('mysql:host=localhost;dbname=commentaires;charset=utf8', 'root', '');

$sql = 'UPDATE votes SET nombre = nombre + 1 WHERE id = 1';
$stmt = $bdd->query($sql);