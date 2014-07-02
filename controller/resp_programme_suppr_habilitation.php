<?php

// Redirige vers l'index si l'utilisateur n'est pas responsable de programme
if($_SESSION['type'] != 'resp_programme')
	header('Location: index.php'); 

// On inclut le menu du responsable de programme
include_once 'view/resp_programme_menu.php';

// Si aucune données POST n'a été transmise, on affiche le formulaire
if(!isset($_POST['id'])){
	
	// Récupére tous les EC
	include_once 'model/ec.php';
	$ecs = EC::getAll();
	
	// Créé un tableau contenant les ECs habilités pour le programme
	$ecs_habilites = array();
	foreach($ecs as $ec){
		if($ec->isHabilite($_SESSION['id_programme']))
			$ecs_habilites[] = $ec;
	}
	
	// Affiche le formulaire
	include_once 'view/resp_programme_suppr_habilitation.php';
	
	// Affiche les EC habilités pour le programme du responsable de programme
	include_once 'view/resp_programme_liste_ecs_habilites.php';
}
else{

	include_once 'model/ec.php';
	
	EC::suppr_habilitation($_POST['id'], $_SESSION['id_programme']);
	
	header('Location: index.php?page=resp_programme_suppr_habilitation');
}

?>