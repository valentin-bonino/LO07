<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 

// On inclut le menu scolarite
include_once 'view/scolarite_menu.php';

// On affiche les étudiants en TC
include_once 'model/etudiant.php';

$etudiants = Etudiant::getAll();

include_once 'view/scolarite_liste_etus.php';

?>