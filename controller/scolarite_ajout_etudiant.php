<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 

// On inclut le menu scolarite
include_once 'view/scolarite_menu.php';

// Si aucune données POST n'a été transmise, on affiche le formulaire
if(!isset($_POST['id']) && !isset($_POST['nom']) && !isset($_POST['prenom']) && !isset($_POST['programme']) && !isset($_POST['semestre'])){
	include_once 'view/scolarite_ajout_etudiant.php';
}
// On vérifie que l'utilisateur a entré des données
else if(empty($_POST['id']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['programme']) || empty($_POST['semestre'])){
	
	$id = $_POST['id'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$programme = $_POST['programme'];
	$semestre = $_POST['semestre'];
	
	if(empty($id))
		$ajout_etu_error = "Veuillez entrer un numéro.";
	else if(empty($nom))
		$ajout_etu_error = "Veuillez entrer un nom.";
	else if(empty($prenom))
		$ajout_etu_error = "Veuillez entrer un prenom.";
	else if(empty($programme))
		$ajout_etu_error = "Veuillez entrer un programme.";
	else if(empty($semestre))
		$ajout_etu_error = "Veuillez entrer un semestre.";
		
	include_once 'view/scolarite_ajout_etudiant.php';
}
else{
	include_once 'controller/cleanData.php';
	
	$id = $_POST['id'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$programme = $_POST['programme'];
	$semestre = $_POST['semestre'];

	// On inclut la classe Etudiant et on créé un nouvel objet avec les paramètres récupérés
	include_once 'model/etudiant.php';
	include_once 'model/programme.php';
	
	$etudiant = new Etudiant(cleanData($id), cleanData($nom), cleanData($prenom), null, cleanData($semestre));
	$etudiant->getProgramme()->setNom(cleanData($programme));
	
	// On vérifie que les données sont valides
	if(!$etudiant->valide()){
		$ajout_etu_error = $etudiant->getError("valide");
		include_once 'view/scolarite_ajout_etudiant.php';
	}
	else{
		// On vérifie si l'étudiant existe déjà dans la BDD
		if($etudiant->exists()){
			$ajout_etu_error = "L'étudiant existe déjà.";
			include_once 'view/scolarite_ajout_etudiant.php';
		}
		// Sinon on ajoute l'etudiant dans la BDD
		else{		
			$etudiant->add();
		
			header('Location: index.php?page=scolarite_accueil');
		}
	}
}

?>