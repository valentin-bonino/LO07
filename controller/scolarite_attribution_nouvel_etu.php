<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 

// On inclut le menu scolarite
include_once 'view/scolarite_menu.php';

// Si aucune données POST n'a été transmise, on affiche le formulaire
if( (!isset($_POST['id_programme']) && !isset($_POST['id_etu'])) ||
	(isset($_POST['id_programme']) && isset($_POST['id_etu']) && empty($_POST['id_programme']) && empty($_POST['id_etu']))){
	
	include_once 'model/programme.php';
	include_once 'model/etudiant.php';
	
	$programmes = Programme::getAll();
	$etudiants = Etudiant::getAllOrphelins();
	
	include_once 'view/scolarite_attribution_nouvel_etu.php';
}
// Si l'utilisateur à choisit un programme sans étudiant
else if( (!isset($_POST['id_etu']) || empty($_POST['id_etu'])) && isset($_POST['id_programme']) && !empty($_POST['id_programme'])){
	
	include_once 'model/programme.php';
	include_once 'model/etudiant.php';
	
	$programme = new Programme($_POST['id_programme'], null);
	$programme->recupererNom();
	$programmes = Programme::getAll();
	$etudiants = Etudiant::getAllOrphelinsByProgramme($programme->getId());
	
	include_once 'view/scolarite_attribution_nouvel_etu.php';
}
else{

	include_once 'model/etudiant.php';
	include_once 'model/programme.php';
	
	// Récupère l'étudiant choisit
	$etudiant = Etudiant::get($_POST['id_etu']);
	
	// On cherche à lui attribuer un conseiller	
	$etudiant->add();
	$ec = $etudiant->attribuerConseiller();
	
	if(empty($ec))
		$attribuer = false;
	else 
		$attribuer = true;
	
	$programmes = Programme::getAll();
	$etudiants = Etudiant::getAllOrphelins();

	include_once 'view/scolarite_attribution_nouvel_etu.php';
}

?>