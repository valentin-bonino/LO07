<?php

// Redirige vers l'index si l'utilisateur n'est pas drh
if($_SESSION['type'] != 'drh')
	header('Location: index.php'); 

include_once 'model/ec.php';
EC::delete($_POST['id']);

header("Location: index.php");

?>