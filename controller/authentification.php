<?php
// Si aucune données POST n'a été transmise, on affiche le formulaire
if (!isset($_POST['login']) && !isset($_POST['password'])) {
	include_once 'view/authentification.php';
}
// On vérifie que l'utilisateur a entré des données
/*
else if(empty($_POST['login']) || empty($_POST['password'])){
	
	$login = $_POST['login'];
	$pw = $_POST['password'];

	$auth_error = "Veuillez entrer un login et un mot de passe";
	include_once 'view/authentification.php';
}

le controle des champs vides est fait avec html5 donc inutile 
*/
else {
	include_once 'controller/cleanData.php';
	// On inclut la classe compte et on créé un nouvel objet avec les paramètres récupérés
	include_once 'model/compte.php';
	$compte = new Compte(cleanData($_POST['login']), cleanData($_POST['password']), null, null);
	
	// On vérifie que le compte existe dans la BDD
	if(!$compte->existsBDD()) {
		$auth_error = "Utilisateur inconnu";
		include_once 'view/authentification.php';
	} else {
		$compte->toSession();
		header('Location: index.php');
	}
}

?>