<?php

class Programme {

private $id;
private $nom;
private $errors = array();

static public $regex_nom = "#^[a-zA-Z]+$#";

function __construct($id, $nom){
	$this->setId($id);
	$this->setNom($nom);
}

// Récupère l'id en fonction du nom
static function getIdByName($name){
	global $bdd;
	
	try {
		$req = "SELECT id FROM programme WHERE nom = '" . $name . "'";
		$result = $bdd->query($req);
	
		$row = $result->fetch();
	
		return $row['id'];
			
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Récupère tous les programme dans la BDD
static function getAll(){
	global $bdd;

	try {
		$req = "SELECT * FROM programme ORDER BY nom";
		$result = $bdd->query($req);

		$row = $result->fetch();

		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon, renvoi les programmes dans un tableau
		else{
			$programmes = array();

			do{
				$programmes[] = new Programme ($row['id'], $row['nom']);
			}while($row = $result->fetch());
				
			return $programmes;
		}
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Récupère le nom du programme dans la BDD
function recupererNom(){
	global $bdd;
	
	try {
		$req = "SELECT nom FROM programme WHERE id = '" . $this->getId() . "'";
		$result = $bdd->query($req);
		
		$row = $result->fetch();

		if(!empty($row))
			$this->setNom($row['nom']);
			
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Vérifie la validité des attributs
function valide(){
	if(!preg_match(self::$regex_nom, $this->getNom())){
		$this->addError("valide", "Nom invalide.");
		return false;
	}

	return true;
}

// Vérifie si le programme existe dans la BDD
function exists(){
	global $bdd;

	try {
		$req = "SELECT * FROM programme WHERE nom = '" . strtoupper($this->getNom()) . "'";
		$result = $bdd->query($req);

		$row = $result->fetch();

		// On renvoi null si on a aucun resultat
		if(empty($row))
			return false;
		else{
			$this->setId($row['id']);
			return true;
		}
			
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Ajoute le pole à la BDD
function add() {
	global $bdd;

	try{
		$req = "INSERT INTO programme(nom) VALUES('" . strtoupper($this->getNom()) . "')";
		$bdd->exec($req);

		// Récupères l'id du programme dans la BDD
		$req = "SELECT id FROM programme WHERE nom = '" . strtoupper($this->getNom()) . "'";
		$result = $bdd->query($req);

		$this->setId($result->fetch()['id']);
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête" . $e->getMessage()); }
}

function cleanErrors() { $this->errors = array(); }
function addError($name, $error) { $this->errors[$name] = $error; }
function getError($name) { return $this->errors[$name]; }

function setId($id) { $this->id = $id; }
function setNom($nom) { $this->nom = $nom; }

function getId() { return $this->id; }
function getNom() { return $this->nom ;}

}

?>