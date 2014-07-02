<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 

// On inclut le menu scolarite
include_once 'view/scolarite_menu.php';

// On récupère tous les étudiants orphelins
include_once 'model/etudiant.php';
$etudiants = Etudiant::getAllOrphelins();

// On inclut la vue
include_once 'view/scolarite_liste_etus_orphelins.php';
?>