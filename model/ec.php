<?php

include_once 'model/personne.php';
include_once 'model/etudiant.php';
include_once 'model/pole.php';

class EC extends Personne {

private $id;
private $bureau;
private $pole; // Objet Pole
private $errors = array();

static public $regex_nom_prenom = "#^[a-zA-Z]+([\-\'\s]?[a-zA-Z]+)*$#";
static public $regex_bureau = "#^[a-zA-Z][0-9]{3}$#";

function __construct($id, $nom, $prenom, $bureau, $id_pole){
	parent::__construct($id, $nom, $prenom);
	$this->setBureau($bureau);
	$this->setPole(new Pole($id_pole, null));
	
	if(!empty($id_pole))
		$this->getPole()->recupererNom();
}

function __toString(){
	return "EC - id : " . $this->getId() . " - Nom : " . $this->getNom() . " - Prenom : " . $this->getPrenom() .
		   " - Bureau : " . $this->getBureau() . " - Pole : " . $this->getPole()->getNom();
}

// Retourne la liste de tous les ECs
static function getAll(){
	global $bdd;
	
	try {
		$req = "SELECT * FROM ec ORDER BY nom";
		$result = $bdd->query($req);
		
		$row = $result->fetch();
		
		// On renvoie null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon, renvoie un tableau d'EC
		else{
			$ecs = array();
		
			do{		
				$ecs[] = new EC ($row['id'], $row['nom'], $row['prenom'], $row['bureau'], $row['id_pole']);
			}while($row = $result->fetch());
			
			return $ecs;
		}
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte : " . $e->getMessage()); }
}

// Retourne la liste de tous les ECs classé par ordre décroissant
// en fonction d'étudiants qu'ils conseillent
static function getAllByEtudiantConseilles(){
	global $bdd;
	
	try {
		$req = "SELECT E.*, COUNT(C.id_etudiant) as nb " . 
			   "FROM ec E " . 
			   "LEFT JOIN conseille C " .
			   "ON E.id = C.id_ec " . 
			   "GROUP BY E.id " . 
			   "ORDER BY nb DESC";
		$result = $bdd->query($req);
		
		$row = $result->fetch();
		
		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon, renvoi les ECs et leur nombre d'étudiants conseillés
		else{
			$ecs = array();
		
			do{		
				$ecs[] = array (new EC ($row['id'], $row['nom'], $row['prenom'], $row['bureau'], $row['id_pole']), $row['nb']);
			}while($row = $result->fetch());
			
			return $ecs;
		}
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte : " . $e->getMessage()); }
}

// Récupère tous les EC en fonction de l'id du pôle en paramètre
static function getAllByPole($id_pole){
	global $bdd;

	try {
		$req =  "SELECT * FROM ec WHERE id_pole = '" . $id_pole . "'";
		$result = $bdd->query($req);

		$row = $result->fetch();

		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon, renvoi les ECs récupérés
		else{
			$ecs = array();

			do{
				$ecs[] = new EC ($row['id'], $row['nom'], $row['prenom'], $row['bureau'], $row['id_pole']);
			}while($row = $result->fetch());
				
			return $ecs;
		}
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte : " . $e->getMessage()); }
}

// Retourne un EC en fonction de son id
static function get($id){
	global $bdd;
	
	try {
		$req = "SELECT * FROM ec WHERE id = '" . $id . "'";
		$result = $bdd->query($req);
		
		$row = $result->fetch();
		
		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon renvoi l'EC
		else
			return new EC ($row['id'], $row['nom'], $row['prenom'], $row['bureau'], $row['id_pole']);
			
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte : " . $e->getMessage()); }
}

// Supprime tous les ECs de la BDD
static function deleteAll(){
	global $bdd;
	
	try {
		$req = "DELETE FROM habilite";
		$bdd->exec($req);

		$req = "DELETE FROM conseille";
		$bdd->exec($req);

		$req = "DELETE FROM pole";
		$bdd->exec($req);		
	
		$req = "DELETE FROM ec";
		$bdd->exec($req);
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte" . $e->getMessage()); }
}

// Supprime l'EC dont l'id est en paramètre
static function delete($id){
	global $bdd;
	
	try{
	
		// On récupére le pôle de l'EC à supprimer
		$req = "SELECT id_pole FROM ec WHERE id = '" . $id . "'";
		$result = $bdd->query($req);
		$id_pole = $result->fetch()['id_pole'];
	
		$req = "DELETE FROM habilite WHERE id_ec = '" . $id . "'";
		$bdd->exec($req);
		
		$req = "DELETE FROM conseille WHERE id_ec = '" . $id . "'";
		$bdd->exec($req);
	
		$req = "DELETE FROM ec WHERE id = '" . $id . "'";
		$bdd->exec($req);
		
		// On vérifie s'il existe encore quelqu'un de ce pôle
		$req = "SELECT * FROM ec WHERE id_pole = '" . $id_pole . "'";
		$result = $bdd->query($req);
		
		// S'il n'y a plus personne, supprime le pôle
		if(empty($result->fetch())){
			$req = "DELETE FROM pole WHERE id = '" . $id_pole . "'";
			$bdd->exec($req);
		}
		
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte" . $e->getMessage()); }
}

// Ajoute une liste d'EC à partir d'un fichier CSV
static function addCSV($filepath, $filesize){
	// Ouvre le fichier envoyé
	$file = fopen($filepath, "r");
	
	// Récupére la premiére ligne (ligne de titres)
	$ligne = fgetcsv($file, $filesize);
	$titres = explode(";", $ligne[0]);
	
	// Stocke les indices des titres en fonction des valeurs correspondantes
	$tab_indices = array();
	foreach($titres as $indice => $titre){
		switch($titre){
			case "nom":
				$tab_indices['nom'] = $indice;
			break;
			
			case "prenom":
				$tab_indices['prenom'] = $indice;
			break;
			
			case "bureau":
				$tab_indices['bureau'] = $indice;
			break;
			
			case "pole":
				$tab_indices['pole'] = $indice;
			break;
		}
	}
	
	// Parcours le fichier et ajoute les EC un par un
	while($ligne = fgetcsv($file, $filesize)){
		$tab_ligne = explode(";", $ligne[0]);
		
		$ec = new EC(null, ucfirst(strtolower($tab_ligne[$tab_indices['nom']])),
						   ucfirst(strtolower($tab_ligne[$tab_indices['prenom']])),
						   ucfirst($tab_ligne[$tab_indices['bureau']]),
						   null);
						   
	    $ec->getPole()->setNom(strtoupper($tab_ligne[$tab_indices['pole']]));
		
		if($ec->valide() && !$ec->exists())		
			$ec->add();
	}
	
	// Ferme le fichier
	fclose($file);
}

// Vérifie si le fichier CSV est valide pour ajouter les EC dans la BDD
static function valideCSV($filepath, $filesize){
	// Ouvre le fichier
	$file = fopen($filepath, "r");
	
	// Récupére la premiére ligne (ligne de titres)
	$ligne = fgetcsv($file, $filesize);
	$titres = explode(";", $ligne[0]);
	
	// Ferme le fichier
	fclose($file);
	
	// On vérifie qu'on a bien 4 titres
	if(count($titres) != 4)
		return false;

	// Tableau de titres corrects initialisés à 0
	$titresCorrects = array ( "nom" => 0,
							  "prenom" => 0,
							  "bureau" => 0,
							  "pole" => 0 );
	
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

// Récupére tous les étudiants conseillés par l'EC dont l'id est en paramétre
static function getEtudiantsConseilles($id_ec){
	global $bdd;
	
	try {
		$req = "SELECT Etu.* " .
			   "FROM ec EC, etudiant Etu, conseille C " .
			   "WHERE EC.id = C.id_ec " .
			   "AND Etu.id = C.id_etudiant " .
			   "AND EC.id = '" . $id_ec . "'" .
			   "ORDER BY Etu.nom";
		$result = $bdd->query($req);
		
		$row = $result->fetch();
		
		// On renvoi null si on a aucun resultat
		if(empty($row))
			return null;
		// Sinon renvoi un tableau d'étudiants
		else {
			$etudiants = array();
		
			do{
				$etudiants[] = new Etudiant ($row['id'], $row['nom'], $row['prenom'], $row['id_programme'], $row['semestre']);
			}while($row = $result->fetch());
			
			return $etudiants;
		}
			
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte : " . $e->getMessage()); }
}

// Habilite l'EC en paramètre au programme en paramètre
static function habilite($id_ec, $id_programme){
	global $bdd;
	
	try {
		$req = "INSERT INTO habilite(id_ec, id_programme) VALUES('" . $id_ec . "', '" . $id_programme . "')";
		$bdd->exec($req);
			
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte : " . $e->getMessage()); }
}

// Supprime l'habilitation de l'EC en paramètre pour le programme en paramètre
static function suppr_habilitation($id_ec, $id_programme){
	global $bdd;

	try {
		
		// Supprime le lien de conseiller aux étudiants de ce programme
		$req = "DELETE c.* FROM conseille c, etudiant e " .
			   "WHERE c.id_ec = '" . $id_ec . "'" . 
			   "AND c.id_etudiant = e.id  " . 
			   "AND e.id_programme = '" . $id_programme . "'";
		$bdd->exec($req);
		
		// Supprime l'habilitation de l'EC
		$req = "DELETE FROM habilite WHERE id_ec = '" . $id_ec . "' AND id_programme = '" . $id_programme . "'";
		$bdd->exec($req);
			
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte : " . $e->getMessage()); }
}

// Vérifie si les données de l'EC sont valides
function valide(){
	if(!preg_match(self::$regex_nom_prenom, $this->getNom())){
		$this->addError("valide", "Nom incorrect.");
		return false;
	}
	
	if(!preg_match(self::$regex_nom_prenom, $this->getPrenom())){
		$this->addError("valide", "Prenom incorrect.");
		return false;
	}
	
	if(!preg_match(self::$regex_bureau, $this->getBureau())){
		$this->addError("valide", "Bureau incorrect (une lettre et 3 chiffres).");
		return false;
	}
	
	if(!$this->getPole()->valide()){
		$this->addError("valide", "Pôle incorrect.");
		return false;
	}
	
	return true;
}

// Ajoute l'EC en BDD
function add(){
	global $bdd;
	
	try{
		
		// Ajoute le pole dans la BDD
		if(!$this->getPole()->exists())
			$this->getPole()->add();
	
		// Ajoute l'EC
		$req = "INSERT INTO ec(nom, prenom, bureau, id_pole) VALUES('" .
				ucfirst(strtolower($this->getNom())) . "', '" .
				ucfirst(strtolower($this->getPrenom())) . "', '" .
				ucfirst($this->getBureau()) . "', '" .
				$this->getPole()->getId() . "')";
				
		$bdd->exec($req);
		
		// Récupéres l'id de l'ec
		$req = "SELECT id FROM ec WHERE nom = '" . ucfirst(strtolower($this->getNom())) . "' AND prenom = '" . ucfirst(strtolower($this->getPrenom())) . "'";
		$result = $bdd->query($req);
		$id = $result->fetch()['id'];
		
		// Habilite l'EC pour le TC
		$req = "INSERT INTO habilite(id_ec, id_programme) VALUES ('" . $id . "', '" . Programme::getIdByName('TC') . "')";
		$bdd->exec($req);
		
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte" . $e->getMessage()); }
}

// Vérifie s'il existe un ec avec le même nom et prénom dans la BDD
function exists(){
	global $bdd;
	
	try{
		$req = "SELECT * FROM ec WHERE nom = '" .
				ucfirst(strtolower($this->getNom())) . "' AND prenom = '" .
				ucfirst(strtolower($this->getPrenom())) . "'";
		$result = $bdd->query($req);
		$row = $result->fetch();
		
		// Renvoi false si l'ec n'existe pas dans la BDD
		if(empty($row))
			return false;
		// Renvoi true sinon
		else
			return true;
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requéte" . $e->getMessage()); }
}

// Vérifie si l'EC est habilité pour le programme en paramètre
function isHabilite($id_programme){
	global $bdd;
	
	try{
		$req = "SELECT * FROM habilite WHERE id_ec = '" . $this->getId() . "' AND id_programme = '" . $id_programme . "'";
		
		$result = $bdd->query($req);
		$row = $result->fetch();
		
		// Renvoi false s'il n'y a pas de résultat
		if(empty($row))
			return false; 
		// Renvoi true sinon
		else
			return true;
	} catch(PDOException $e) { die ("Erreur lors de l'exécution de la requête" . $e->getMessage()); }
}

function cleanErrors() { $this->errors = array(); }
function addError($name, $error) { $this->errors[$name] = $error; }
function getError($name) { return $this->errors[$name]; }

function setBureau($bureau) { $this->bureau = $bureau; }
function setPole($pole) { $this->pole = $pole;}

function getBureau() { return $this->bureau; }
function getPole() { return $this->pole; }

}

?>