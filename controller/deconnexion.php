<?php 

unset($_SESSION['login']);
unset($_SESSION['password']);
unset($_SESSION['type']);
unset($_SESSION['id_programme']);
unset($_SESSION['programme']);
unset($_SESSION['compte']);

header('Location: index.php');

?>