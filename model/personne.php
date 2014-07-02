<?php

abstract class Personne {

private $id;
private $nom;
private $prenom;

function __construct($id, $nom, $prenom){
	$this->setId($id);
	$this->setNom($nom);
	$this->setPrenom($prenom);
}

function setId($id) { $this->id = $id; }
function setNom($nom) { $this->nom = $nom; }
function setPrenom($prenom) { $this->prenom = $prenom; }

function getId() { return $this->id; }
function getNom() { return $this->nom; }
function getPrenom() { return $this->prenom; }

}

?>