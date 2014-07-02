<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 

// On inclut le menu scolarite
include_once 'view/scolarite_menu.php';

// On récupère tous les étudiants orphelins
include_once 'model/etudiant.php';
$etudiants = Etudiant::getAllConseilles();

// On parcours les étudiants pour récupérer leur conseiller
if(!empty($etudiants)){
	$conseillers = array();
	foreach($etudiants as $i => $etu){
		$conseillers[$i] = $etu->getConseiller();
	}
}

// On inclut la vue
include_once 'view/scolarite_liste_etus_conseilles.php';
?>