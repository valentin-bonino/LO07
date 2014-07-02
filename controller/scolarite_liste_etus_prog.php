<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 

// On inclut le menu scolarite
include_once 'view/scolarite_menu.php';

// On récupère la liste des programmes
include_once 'model/programme.php';

$programmes = Programme::getAll();

// Si un programme a été sélectionné, on le sélectionne dans la liste des programmes du formulaire
$programme;
if(isset($_POST['id'])){
	$programme = new Programme($_POST['id'], null);
	$programme->recupererNom();
}

// On inclut le formulaire pour le choix du programme
include_once 'view/scolarite_form_liste_etus_prog.php';

// Si un programme a été sélectionné, on affiche la liste des étudiants correspondants
if(isset($_POST['id']))
	include_once 'controller/scolarite_liste_etus_prog_ajax.php';
?>