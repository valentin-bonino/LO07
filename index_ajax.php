<?php 

//On démarre la session
session_start();
 
//On se connecte à la bdd
include_once 'model/connexion.php'; 

// Si une page a été demandée, on l'inclut
if (!empty($_GET['page']) && is_file('controller/'.$_GET['page'].'.php')){
        include_once 'controller/'.$_GET['page'].'.php';
}
 
//On ferme la connexion à MySQL
$bdd = NULL;

?>