<?php

// Redirige vers l'index si l'utilisateur n'est pas responsable de programme
if($_SESSION['type'] != 'resp_programme')
	header('Location: index.php'); 

// On inclut le menu du responsable de programme
include_once 'view/resp_programme_menu.php';

// Si aucune données POST n'a été transmise, on affiche le formulaire
if(!isset($_POST['id'])){
	
	// Récupère tous les pôles
	include_once 'model/pole.php';
	$poles = Pole::getAll();
	
	// Affiche le formulaire
	include_once 'view/resp_programme_ajout_par_poles.php';
}
else{

	include_once 'model/ec.php';
	include_once 'model/pole.php';
	
	// Récupère tous les pôles
	$poles = Pole::getAll();
	
	// On récupère tous les EC en fonction du pôle souhaité
	$ecs = EC::getAllByPole($_POST['id']);
	
	// On habilite tous les EC récupérés
	foreach($ecs as $ec){
		EC::habilite($ec->getId(), $_SESSION['id_programme']);
	}
	
	$ajout = true;
	
	include_once 'view/resp_programme_ajout_par_poles.php';
}

?>