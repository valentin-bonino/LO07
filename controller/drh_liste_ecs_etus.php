<?php

// Redirige vers l'index si l'utilisateur n'est pas drh
if($_SESSION['type'] != 'drh')
	header('Location: index.php'); 

// On inclut le menu du drh
include_once 'view/drh_menu.php';

// On récupère la liste des EC
include_once 'model/ec.php';
$ecs = EC::getAll();

// Parcours les EC, récupère les étudiants qu'ils conseillent et
// les place au même indice dans un seconde tableau
if(!empty($ecs)){
	$etus = array();
	foreach($ecs as $i => $ec){
		$etus[$i] = EC::getEtudiantsConseilles($ec->getId());
	}
}

include_once 'view/drh_liste_ecs_etus.php';

?>