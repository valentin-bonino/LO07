<?php

// Redirige vers l'index si l'utilisateur n'est pas drh
if($_SESSION['type'] != 'drh')
	header('Location: index.php'); 

// On inclut le menu du drh
include_once 'view/drh_menu.php';

// Si aucune données POST n'a été transmise, on affiche le formulaire
if(!isset($_POST['nom']) && !isset($_POST['prenom']) && !isset($_POST['bureau']) && !isset($_POST['pole'])){
	include_once 'view/drh_ajout_ec.php';
}
// On vérifie que l'utilisateur a entré des données
else if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['bureau']) || empty($_POST['pole'])){
	
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$bureau = $_POST['bureau'];
	$pole = $_POST['pole'];
	
	if(empty($nom))
		$ajout_ec_error = "Veuillez entrer un nom.";
	else if(empty($prenom))
		$ajout_ec_error = "Veuillez entrer un prenom.";
	else if(empty($bureau))
		$ajout_ec_error = "Veuillez entrer un bureau.";
	else if(empty($pole))
		$ajout_ec_error = "Veuillez entrer un pole.";
		
	include_once 'view/drh_ajout_ec.php';
}
else{
	include_once 'controller/cleanData.php';
	
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$bureau = $_POST['bureau'];
	$pole = $_POST['pole'];

	// On inclut la classe EC et on créé un nouvel objet avec les paramètres récupérés
	include_once 'model/ec.php';
	include_once 'model/pole.php';
	
	$ec = new EC(null, cleanData($nom), cleanData($prenom), cleanData($bureau), null);
	$ec->getPole()->setNom(cleanData($pole));
	
	// On vérifie que les données sont valides
	if(!$ec->valide()){
		$ajout_ec_error = $ec->getError("valide");
		include_once 'view/drh_ajout_ec.php';
	}
	else{
		// On vérifie si l'ec existe déjà dans la BDD
		if($ec->exists()){
			$ajout_ec_error = "L'enseignant chercheur existe déjà.";
			include_once 'view/drh_ajout_ec.php';
		}
		// Sinon on ajoute l'ec dans la BDD
		else{		
			$ec->add();
		
			header('Location: index.php?page=drh_accueil');
		}
	}
}

?>