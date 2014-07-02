<?php

class Pole{

private $id;
private $nom;

static public $regex_nom = "#^[a-zA-Z]+$#";

function __construct($id, $nom){
	$this->setId($id);
	$this->setNom($nom);
}

// Récupère tous les pôles
static function getAll(){
global $bdd;
	
	try {
		$req = "SELECT * FROM pole ORDER BY nom";
		$result = $bdd->query($req);
		
		$row = $result->fetch();
		
		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon, renvoi un tableau de pôle
		else{
			$poles = array();
		
			do{		
				$poles[] = new Pole ($row['id'], $row['nom']);
			}while($row = $result->fetch());
			
			return $poles;
		}
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte : " . $e->getMessage()); }
}

// Récupère le nom du pôle dans la BDD
function recupererNom(){
	global $bdd;
	
	try {
		$req = "SELECT nom FROM pole WHERE id = '" . $this->getId() . "'";
		$result = $bdd->query($req);
		
		$row = $result->fetch();

		if(!empty($row))
			$this->setNom($row['nom']);
			
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Vérifie la validité des attributs
function valide(){
	if(!preg_match(self::$regex_nom, $this->getNom()))
		return false;
		
	return true;
}

// Vérifie si le pole existe dans la BDD
function exists(){
	global $bdd;
	
	try {
		$req = "SELECT * FROM pole WHERE nom = '" . strtoupper($this->getNom()) . "'";
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
function add(){
	global $bdd;
	
	try{	
		$req = "INSERT INTO pole(nom) VALUES('" . strtoupper($this->getNom()) . "')";		
		$bdd->exec($req);
		
		// Récupères l'id du pole dans la BDD
		$req = "SELECT id FROM pole WHERE nom = '" . $this->getNom() . "'";
		$result = $bdd->query($req);
		
		$this->setId($result->fetch()['id']);
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête" . $e->getMessage()); }
}

function setId($id) { $this->id = $id; }
function setNom($nom) { $this->nom = $nom; }

function getId() { return $this->id; }
function getNom() { return $this->nom ;}

}

?>