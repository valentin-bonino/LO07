<?php 

//On démarre la session
session_start();
 
//On se connecte à la bdd
include_once 'model/connexion.php'; 
 
// On inclut le haut de la page
include_once 'view/header.php';

// Si l'utilisateur n'est pas connecté, on affiche la page d'authentification
if(!isset($_SESSION['login'])){
	include_once 'controller/authentification.php';
}
// Si une page a été demandée, on l'inclut
else if (!empty($_GET['page']) && is_file('controller/'.$_GET['page'].'.php')){
        include_once 'controller/'.$_GET['page'].'.php';
}
// Sinon, on inclut la page d'accueil correspondant au profil de l'utilisateur
else{
		// S'il s'agit du DRH
		if($_SESSION['type'] == 'drh')
			include_once 'controller/drh_accueil.php';
		// S'il s'agit du service scolarité
		else if($_SESSION['type'] == 'scolarite')
			include_once 'controller/scolarite_accueil.php';
		// S'il s'agit d'un responsable de branche
		else if($_SESSION['type'] == 'resp_programme')
			include_once 'controller/resp_programme_accueil.php';
}
 
//On inclut le pied de page
include_once 'view/foot.php';
 
//On ferme la connexion à MySQL
$bdd = NULL;

?>