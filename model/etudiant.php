<?php

include_once 'model/personne.php';
include_once 'model/programme.php';
include_once 'model/ec.php';

class Etudiant extends Personne {

private $id;
private $programme; // Objet Programme
private $semestre;
private $errors = array();

static public $regex_nom_prenom = "#^[a-zA-Z]+([\-\'\s]?[a-zA-Z]+)*$#";
static public $regex_id = "#^[0-9]+$#";
static public $regex_semestre = "#^[1-9]+$#";

function __construct($id, $nom, $prenom, $id_programme, $semestre){
	parent::__construct($id, $nom, $prenom);
	$this->setProgramme(new Programme($id_programme, null));
	$this->setSemestre($semestre);
	
	if(!empty($id_programme))
		$this->getProgramme()->recupererNom();
}

function __toString(){
	return "Etudiant - id : " . $this->getId() . " - Nom : " . $this->getNom() . " - Prenom : " . $this->getPrenom() .
		   " - Programme : " . $this->getProgramme()->getNom() . " - Semestre : " . $this->getSemestre();
}

// Retourne un étudiant en fonction de son id
static function get($id){
	global $bdd;

	try {
		$req = "SELECT * FROM etudiant WHERE id = '" . $id . "'";
		$result = $bdd->query($req);

		$row = $result->fetch();

		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon renvoi l'étudiant
		else
			return new Etudiant ($row['id'], $row['nom'], $row['prenom'], $row['id_programme'], $row['semestre']);
			
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte : " . $e->getMessage()); }
}

// Récupère tous les étudiants dans la BDD
static function getAll(){
	global $bdd;
	
	try {
		$req = "SELECT * FROM etudiant ORDER BY nom";
		$result = $bdd->query($req);
		
		$row = $result->fetch();
		
		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon, renvoi les étudiants dans un tableau
		else{
			$etudiants = array();
		
			do{		
				$etudiants[] = new Etudiant ($row['id'], $row['nom'], $row['prenom'], $row['id_programme'], $row['semestre']);
			}while($row = $result->fetch());
			
			return $etudiants;
		}
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Récupère tous les étudiants en fonction du programme en paramètre
static function getAllByProgramme($id_programme){
	global $bdd;
	
	try {
		$req = "SELECT * FROM etudiant WHERE id_programme = '" . $id_programme . "' ORDER BY nom";
		$result = $bdd->query($req);
		
		$row = $result->fetch();
		
		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon, renvoi un les étudiants
		else{
			$etudiants = array();
		
			do{		
				$etudiants[] = new Etudiant ($row['id'], $row['nom'], $row['prenom'], $row['id_programme'], $row['semestre']);
			}while($row = $result->fetch());
			
			return $etudiants;
		}
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Récupère tous les étudiants orphelins
static function getAllOrphelins(){
	global $bdd;
	
	try {
		$req = "SELECT * FROM etudiant WHERE id NOT IN (SELECT id_etudiant FROM conseille) ORDER BY nom";
		$result = $bdd->query($req);
	
		$row = $result->fetch();
	
		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon, renvoi les étudiants dans un tableau
		else{
			$etudiants = array();
	
			do{
				$etudiants[] = new Etudiant ($row['id'], $row['nom'], $row['prenom'], $row['id_programme'], $row['semestre']);
			}while($row = $result->fetch());
				
			return $etudiants;
		}
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Récupère tous les étudiants orphelins en fonction du programme en paramètre
static function getAllOrphelinsByProgramme($id_programme){
	global $bdd;
	
	try {
		$req = "SELECT e.* FROM etudiant e, programme p " .
			   "WHERE e.id NOT IN (SELECT id_etudiant FROM conseille) " .
			   "AND e.id_programme = p.id " .
			   "AND p.id = '" . $id_programme . "' ORDER BY e.nom";
		$result = $bdd->query($req);
	
		$row = $result->fetch();
	
		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon, renvoi les étudiants dans un tableau
		else{
			$etudiants = array();
	
			do{
				$etudiants[] = new Etudiant ($row['id'], $row['nom'], $row['prenom'], $row['id_programme'], $row['semestre']);
			}while($row = $result->fetch());
	
			return $etudiants;
		}
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Récupère tous les étudiants conseillés
static function getAllConseilles(){
	global $bdd;
	
	try {
		$req = "SELECT * FROM etudiant WHERE id IN (SELECT id_etudiant FROM conseille) ORDER BY nom";
		$result = $bdd->query($req);
	
		$row = $result->fetch();
	
		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon, renvoi les étudiants dans un tableau
		else{
			$etudiants = array();
	
			do{
				$etudiants[] = new Etudiant ($row['id'], $row['nom'], $row['prenom'], $row['id_programme'], $row['semestre']);
			}while($row = $result->fetch());
	
			return $etudiants;
		}
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Supprime tous les étudiants de la BDD
static function deleteAll(){
	global $bdd;

	try {
		$req = "DELETE FROM conseille";
		$bdd->exec($req);

		$req = "DELETE FROM etudiant";
		$bdd->exec($req);
		
		// Supprime les programmes inutiles
		$req = "SELECT P.id " .
			   "FROM programme P " .
			   "WHERE P.id NOT IN (SELECT H.id_programme FROM habilite H) " .
			   "AND P.id NOT IN (SELECT C.id_programme FROM compte C WHERE C.id_programme IS NOT NULL)";
		$result = $bdd->query($req);
		
		$req = "DELETE FROM programme WHERE id = :id";
		$statement = $bdd->prepare($req);
		while($row = $result->fetch()){
			$statement->bindParam(":id", $row['id']);
			$statement->execute();
		}
		
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte" . $e->getMessage()); }
}

// Supprime l'étudiant possedant l'id en paramètre
static function delete($id){
global $bdd;
	
	try{
	
		// On récupére le programme de l'étudiant à supprimer
		$req = "SELECT id_programme FROM etudiant WHERE id = '" . $id . "'";
		$result = $bdd->query($req);
		$id_programme = $result->fetch()['id_programme'];
		
		$req = "DELETE FROM conseille WHERE id_etudiant = '" . $id . "'";
		$bdd->exec($req);
	
		$req = "DELETE FROM etudiant WHERE id = '" . $id . "'";
		$bdd->exec($req);
		
		// On vérifie si le programme est encore utile
		$req = "SELECT * FROM etudiant e, compte c, habilite h " .
			   "WHERE e.id_programme = '" . $id_programme . "' " .
			   "OR c.id_programme = '" . $id_programme . "' " . 
			   "OR h.id_programme = '" . $id_programme . "'";
		$result = $bdd->query($req);
		
		// S'il n'y a aucun résultat, supprime le programme
		if(empty($result->fetch())){
			$req = "DELETE FROM programme WHERE id = '" . $id_programme . "'";
			$bdd->exec($req);
		}
		
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte" . $e->getMessage()); }
}

// Vérifie si le fichier CSV est valide pour ajouter les étudiants dans la BDD
static function valideCSV($filepath, $filesize){
	// Ouvre le fichier
	$file = fopen($filepath, "r");

	// Récupére la première ligne (ligne de titres)
	$ligne = fgetcsv($file, $filesize);
	$titres = explode(";", $ligne[0]);

	// Ferme le fichier
	fclose($file);

	// On vérifie qu'on a bien 5 titres
	if(count($titres) != 5)
		return false;

	// Tableau de titres corrects initialisés à 0
	$titresCorrects = array ( "numéro" => 0,
			"nom" => 0,
			"prénom" => 0,
			"programme" => 0,
			"semestre" => 0 );

	// Parcours les titres du fichier, si un titre est dans le tableau de titres corrects,
	// incrémente le compteur du titre correspondant
	foreach($titres as $titre){
		if(array_key_exists($titre, $titresCorrects))
			$titresCorrects[$titre]++;
	}

	// Vérifie si tous les titres corrects sont à 1, renvoi false sinon
	foreach($titresCorrects as $titre){
		if($titre != 1)
			return false;
	}

	return true;
}

// Ajoute une liste d'étudiants à partir d'un fichier CSV
static function addCSV($filepath, $filesize){
	// Ouvre le fichier envoyé
	$file = fopen($filepath, "r");

	// Récupére la première ligne (ligne de titres)
	$ligne = fgetcsv($file, $filesize);
	$titres = explode(";", $ligne[0]);

	// Stocke les indices des titres en fonction des valeurs correspondantes
	$tab_indices = array();
	foreach($titres as $indice => $titre){
		switch($titre){
			case "numéro":
				$tab_indices['id'] = $indice;
				break;
				
			case "nom":
				$tab_indices['nom'] = $indice;
				break;
					
			case "prénom":
				$tab_indices['prenom'] = $indice;
				break;
					
			case "programme":
				$tab_indices['programme'] = $indice;
				break;
					
			case "semestre":
				$tab_indices['semestre'] = $indice;
				break;
		}
	}

	// Parcours le fichier et ajoute les EC un par un
	while($ligne = fgetcsv($file, $filesize)){
		$tab_ligne = explode(";", $ligne[0]);

		$etu = new Etudiant($tab_ligne[$tab_indices['id']], ucfirst(strtolower($tab_ligne[$tab_indices['nom']])),
				ucfirst(strtolower($tab_ligne[$tab_indices['prenom']])),
				null,
				$tab_ligne[$tab_indices['semestre']]);
			
		$etu->getProgramme()->setNom(strtoupper($tab_ligne[$tab_indices['programme']]));

		if($etu->valide() && !$etu->exists())
			$etu->add();
	}

	// Ferme le fichier
	fclose($file);
}

// Récupère le conseiller de l'étudiant
function getConseiller(){
	global $bdd;
	
	try {
		$req = "SELECT EC.* " .
			   "FROM etudiant Etu, conseille C, ec EC " .
			   "WHERE etu.id = '" . $this->getId() . "' " .
			   "AND C.id_etudiant = etu.id " . 
			   "AND C.id_ec = EC.id";
		$result = $bdd->query($req);
		
		$row = $result->fetch();
		
		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon, l'EC
		else
			return new EC($row['id'], $row['nom'], $row['prenom'], $row['bureau'], $row['id_pole']);
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Vérifie la validité des attributs
function valide(){
	
	if(!empty($this->getId()) && !preg_match(self::$regex_id, $this->getId())){
		$this->addError("valide", "Numéro incorrect.");
		return false;
	}
	
	if(!preg_match(self::$regex_nom_prenom, $this->getNom())){
		$this->addError("valide", "Nom incorrect.");
		return false;
	}

	if(!preg_match(self::$regex_nom_prenom, $this->getPrenom())){
		$this->addError("valide", "Prenom incorrect.");
		return false;
	}
	
	if(!$this->getProgramme()->valide()){
		$this->addError("valide", "Programme incorrect.");
		return false;
	}

	if(!preg_match(self::$regex_semestre, $this->getSemestre())){
		$this->addError("valide", "Semestre incorrect.");
		return false;
	}

	return true;
}

// Vérifie s'il existe un étudiant avec le même id
function existsId(){
	global $bdd;

	try{
		$req = "SELECT * FROM etudiant WHERE id = '" . $this->getId() . "'";
		$result = $bdd->query($req);
		$row = $result->fetch();

		// Renvoi false si l'etudiant n'existe pas dans la BDD
		if(empty($row))
			return false;
		// Renvoi true sinon
		else
			return true;
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte" . $e->getMessage()); }
}

// Vérifie s'il existe un étudiant avec le même id, le même nom et prénom dans la BDD
function exists(){
	global $bdd;

	try{
		$req = "SELECT * FROM etudiant WHERE id = '" . $this->getId() . 
				"' AND nom = '" . ucfirst(strtolower($this->getNom())) . 
				"' AND prenom = '" . ucfirst(strtolower($this->getPrenom())) . "'";
		$result = $bdd->query($req);
		$row = $result->fetch();

		// Renvoi false si l'etudiant n'existe pas dans la BDD
		if(empty($row))
			return false;
		// Renvoi true sinon
		else
			return true;
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte" . $e->getMessage()); }
}

// Ajoute l'étudiant dans la BDD
function add(){
	global $bdd;

	try{

		// Ajoute le programme dans la BDD
		if(!$this->getProgramme()->exists())
			$this->getProgramme()->add();
		
		// Si l'étudiant n'a pas de numéro
		if(empty($this->getId()))
			$req = "INSERT INTO etudiant(nom, prenom, id_programme, semestre) VALUES('" .
					ucfirst(strtolower($this->getNom())) . "', '" .
					ucfirst(strtolower($this->getPrenom())) . "', '" .
					$this->getProgramme()->getId() . "', '" .
					$this->getSemestre() . "')";
		else
		// Si l'étudiant a un numéro
			$req = "INSERT INTO etudiant(id, nom, prenom, id_programme, semestre) VALUES('" .
					$this->getId() . "', '" .
					ucfirst(strtolower($this->getNom())) . "', '" .
					ucfirst(strtolower($this->getPrenom())) . "', '" .
					$this->getProgramme()->getId() . "', '" .
					$this->getSemestre() . "')";

		$bdd->exec($req);
		
		// On récupère l'id de l'étudiant
		if(empty($this->getId())){
			$req = "SELECT id FROM etudiant " .
				   "WHERE nom = '" . ucfirst(strtolower($this->getNom())) . "' " .
				   "AND prenom = '" . ucfirst(strtolower($this->getPrenom())) . "' " .
				   "AND id_programme = '" . $this->getProgramme()->getId() . "'";
			$result = $bdd->query($req);
			$this->setId($result->fetch()['id']);
		}

	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte" . $e->getMessage()); }
}

// Attribue un conseiller à l'étudiant
function attribuerConseiller(){
	global $bdd;
	
	try {
		$req =  "SELECT COUNT(c.id_etudiant) as nb, e.* ".
				"FROM ec e " .
				"LEFT JOIN conseille c " .
				"ON e.id = c.id_ec " .
				"INNER JOIN habilite h " .
				"ON h.id_ec = e.id " .
				"INNER JOIN programme p " .
				"ON h.id_programme = p.id " .
				"WHERE p.id = '" . $this->getProgramme()->getId() . "' " .
				"GROUP BY e.id " .
				"ORDER BY nb ASC";
		
		$result = $bdd->query($req);
		$row = $result->fetch();
	
		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon on récupère l'EC
		else
			$ec = new EC($row['id'], $row['nom'], $row['prenom'], $row['bureau'], $row['id_pole']);
		
		// Assigne l'EC à l'étudiant
		$req = "INSERT INTO conseille(id_ec, id_etudiant) VALUES('" . $ec->getId() . "', '" . $this->getId() . "')";
		$bdd->exec($req);
		
		return $ec;
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête : " . $e->getMessage()); }
}

// Met à jour l'étudiant en BDD
function update(){
	global $bdd;
	
	try{
		$req = "UPDATE etudiant SET nom = '" . ucfirst(strtolower($this->getNom())) . "'" . 
			   ", prenom = '" . ucfirst(strtolower($this->getPrenom())) . "'" . 
			   ", id_programme = '" . $this->getProgramme()->getId() . "'" . 
			   ", semestre = '" . $this->getSemestre() . "'" . 
			   " WHERE id = '" . $this->getId() . "'";
		$bdd->exec($req);
	
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte" . $e->getMessage()); }
}

// Supprime le lien entre l'étudiant et son conseiller dans la BDD
function supprimerConseiller(){
	global $bdd;
	
	try{
		$req = "DELETE FROM conseille " .
			   "WHERE id_etudiant = '" . $this->getId() . "'";
		$bdd->exec($req);
	
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte" . $e->getMessage()); }
}

function cleanErrors() { $this->errors = array(); }
function addError($name, $error) { $this->errors[$name] = $error; }
function getError($name) { return $this->errors[$name]; }

function setProgramme($programme) { $this->programme = $programme; }
function setSemestre($semestre) { if($semestre > 0) $this->semestre = $semestre; }

function getProgramme() { return $this->programme; }
function getSemestre() { return $this->semestre; }
}

?>