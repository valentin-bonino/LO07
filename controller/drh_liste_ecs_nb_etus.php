<?php

// Redirige vers l'index si l'utilisateur n'est pas drh
if($_SESSION['type'] != 'drh')
	header('Location: index.php'); 

// On inclut le menu du drh
include_once 'view/drh_menu.php';

// On récupère la liste des EC
include_once 'model/ec.php';
$ecs = EC::getAllByEtudiantConseilles();

include_once 'view/drh_liste_ecs_nb_etus.php';

?>