<?php

// Fichier séparé pour pouvoir être récupéré en AJAX

if(isset($_POST['id']) && !empty($_POST['id'])){

	include_once 'model/etudiant.php';
	include_once 'model/programme.php';
	
	if(!isset($programme)){
		$programme = new Programme($_POST['id'], null);
		$programme->recupererNom();
	}
	
	$etudiants = Etudiant::getAllByProgramme($programme->getId());
	
	include_once 'view/scolarite_liste_etus_prog.php';
}

?>