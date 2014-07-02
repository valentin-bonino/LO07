<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 

// On inclut le menu scolarite
include_once 'view/scolarite_menu.php';

// On récupère tous les conseillers et leur nombre d'étudiants
include_once 'model/ec.php';
$ecs = EC::getAllByEtudiantConseilles();

include_once 'view/scolarite_liste_conseillers.php';
?>