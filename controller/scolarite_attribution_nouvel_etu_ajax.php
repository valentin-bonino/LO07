<?php

include_once 'model/etudiant.php';
include_once 'model/programme.php';

// Si aucun programme n'a été choisit
if(!isset($_POST['id_programme']) || empty($_POST['id_programme']))
	$etudiants = Etudiant::getAllOrphelins();
else
	$etudiants = Etudiant::getAllOrphelinsByProgramme($_POST['id_programme']);

include_once 'view/select_scolarite_attribution_nouvel_etu_etu_ajax.php';

?>