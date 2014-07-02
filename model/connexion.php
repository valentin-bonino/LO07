<?php

$user = 'root';
$pw = '';
$dataSourceName = 'mysql:host=localhost;dbname=lo07';

try {
	$bdd = new PDO($dataSourceName, $user, $pw);
} catch(PDOException $e) { die ("Erreur lors de la connexion à la base de données" . $e->getMessage()); }

?>