<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 

// On inclut le menu scolarite
include_once 'view/scolarite_menu.php';

// Si aucune données POST n'a été transmise, on affiche le formulaire
if(!isset($_POST['id'])){
	
	// Récupére tous les étudiants
	include_once 'model/etudiant.php';
	$etudiants = Etudiant::getAll();
	
	// Affiche le formulaire de suppression
	include_once 'view/scolarite_suppr_etudiant.php';
}
else{

	include_once 'model/etudiant.php';
	
	Etudiant::delete($_POST['id']);
	
	header('Location: index.php?page=scolarite_suppr_etudiant');
}

?>