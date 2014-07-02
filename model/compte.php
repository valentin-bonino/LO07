<?php

include_once 'model/programme.php';

class Compte {

private $login;
private $password;
private $type;
private $id_programme;

function __construct($login, $password, $type, $id_programme){
	$this->setLogin($login);
	$this->setPassword($password);
	$this->setType($type);
	$this->setId_programme($id_programme);
}

// Vérifie l'existence du compte dans la BDD en fonction du login et du password
function existsBDD(){
	global $bdd;
	
	try{
		$req = "SELECT * FROM compte WHERE login = '" . $this->getLogin() .
				"' AND password = '" . $this->getPassword() . "'";
		$result = $bdd->query($req);
		$row = $result->fetch();
		
		// Retourne faux si le compte n'existe pas en BDD
		if(empty($row))
			return false;
		// Sinon, retourne vrai et ajoute le type à l'objet compte
		else {
			$this->setType($row['type']);
			$this->setId_programme($row['id_programme']);
			return true;
		}
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête" . $e->getMessage()); }
}

// Ajoute le compte dans des variables de session
function toSession(){
	$_SESSION['login'] = $this->getLogin();
	$_SESSION['password'] = $this->getPassword();
	$_SESSION['type'] = $this->getType();

	if($this->getId_programme() != null) {

		$_SESSION['id_programme'] = $this->getId_programme();
		$p = new Programme($_SESSION['id_programme'], null);
		$p->recupererNom();
		$_SESSION['programme'] = $p->getNom();
	}
	
	$_SESSION['compte'] = serialize($this);
	var_dump($_SESSION);
}

function setLogin($login){ $this->login = $login; }
function setPassword($password){ $this->password = $password; }
function setType($type){ $this->type = $type; }
function setId_programme($id_programme) { $this->id_programme = $id_programme; }

function getLogin(){ return $this->login; }
function getPassword(){ return $this->password; }
function getType(){ return $this->type; }
function getId_programme() { return $this->id_programme; }

}

?>