<?php

// Redirige vers l'index si l'utilisateur n'est pas responsable de programme
if($_SESSION['type'] != 'resp_programme')
	header('Location: index.php'); 

// On inclut le menu du responsable de programme
include_once 'view/resp_programme_menu.php';

// On récupère tous les étudiants
include_once 'model/etudiant.php';
$etudiants = Etudiant::getAllByProgramme($_SESSION['id_programme']);

// On récupère les EC de chaque étudiant
$conseillers = array();

if(!empty($etudiants)){
	foreach($etudiants as $i => $etudiant){
		$conseillers[$i] = $etudiant->getConseiller();
	}
}

// On inclut la vue
include_once('view/resp_programme_liste_etus.php');

?>