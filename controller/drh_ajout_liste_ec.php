<?php

// Redirige vers l'index si l'utilisateur n'est pas drh
if($_SESSION['type'] != 'drh')
	header('Location: index.php'); 

// On inclut le menu du drh
include_once 'view/drh_menu.php';

// Si aucun fichier n'a été transmis, on affiche le formulaire
if(!isset($_FILES['liste_ec'])) {
	include_once 'view/drh_ajout_liste_ec.php';
}
else {
	include_once 'model/ec.php';
	
	// Vérifie s'il y a une erreur d'envoi
	if($_FILES['liste_ec']['error']) {
		$ajout_liste_ec_error = "Erreur d'envoi du fichier.";
		include_once 'view/drh_ajout_liste_ec.php';
	}
	// Vérifie si le fichier est un fichier CSV
	else if(strtolower(pathinfo($_FILES['liste_ec']['name'], PATHINFO_EXTENSION)) != "csv"){
		$ajout_liste_ec_error = "Le fichier doit avoir l'extension CSV.";
		include_once 'view/drh_ajout_liste_ec.php';
	}
	// Vérifie si le fichier est valide
	else if(!EC::valideCSV($_FILES['liste_ec']['tmp_name'], $_FILES['liste_ec']['size'])){
		$ajout_liste_ec_error = "Le contenu du fichier CSV n'est pas valide.";
		include_once 'view/drh_ajout_liste_ec.php';
	}
	else{
		EC::addCSV($_FILES['liste_ec']['tmp_name'], $_FILES['liste_ec']['size']);
		
		header('Location: index.php');
	}
	
}

?>