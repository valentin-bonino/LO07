<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 

// On inclut le menu scolarite
include_once 'view/scolarite_menu.php';

// Si aucun fichier n'a été transmis, on affiche le formulaire
if(!isset($_FILES['liste_etus'])){
	include_once 'view/scolarite_ajout_liste_etus.php';
}
else{
	include_once 'model/etudiant.php';
	
	// Vérifie s'il y a une erreur d'envoi
	if($_FILES['liste_etus']['error']){
		$ajout_liste_etus_error = "Erreur d'envoi du fichier.";
		include_once 'view/scolarite_ajout_liste_etus.php';
	}
	// Vérifie si le fichier est un fichier CSV
	else if(strtolower(pathinfo($_FILES['liste_etus']['name'], PATHINFO_EXTENSION)) != "csv"){
		$ajout_liste_etus_error = "Le fichier doit avoir l'extension CSV.";
		include_once 'view/scolarite_ajout_liste_etus.php';
	}
	// Vérifie si le fichier est valide
	else if(!Etudiant::valideCSV($_FILES['liste_etus']['tmp_name'], $_FILES['liste_etus']['size'])){
		$ajout_liste_etus_error = "Le contenu du fichier CSV n'est pas valide.";
		include_once 'view/scolarite_ajout_liste_etus.php';
	}
	else{
		
		/////// Fonction à coder		
		
		Etudiant::addCSV($_FILES['liste_etus']['tmp_name'], $_FILES['liste_etus']['size']);
		
		header('Location: index.php');
	}
	
}

?>