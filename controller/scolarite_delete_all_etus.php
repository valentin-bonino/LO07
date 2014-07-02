<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 
	
include_once 'model/etudiant.php';
Etudiant::deleteAll();

header("Location: index.php");

?>