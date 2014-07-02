<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 

// On inclut le menu scolarite
include_once 'view/scolarite_menu.php';

// On récupère tous les étudiants orphelins
include_once 'model/etudiant.php';
$etudiants = Etudiant::getAllOrphelins();

if(!empty($etudiants)){
	// Tableau de conseillers
	$conseillers = array();
	
	// On attribut un conseiller à chaque orphelins et stocke le conseiller dans le tableau
	foreach($etudiants as $i => $etu){
		$ec = $etu->attribuerConseiller();
		$conseillers[$i] = $ec;
	}
}

// On inclut la vue
include_once 'view/scolarite_attribution_etus.php';
?>