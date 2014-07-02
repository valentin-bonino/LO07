<?php

// Redirige vers l'index si l'utilisateur n'est pas scolarite
if($_SESSION['type'] != 'scolarite')
	header('Location: index.php'); 

// On inclut le menu scolarite
include_once 'view/scolarite_menu.php';

// On récupère tous les étudiants en TC
include_once 'model/etudiant.php';
include_once 'model/programme.php';

$etudiants = Etudiant::getAllByProgramme(Programme::getIdByName('TC'));

// Si aucune données POST n'a été transmise, on affiche le formulaire
if(!isset($_POST['id']) && !isset($_POST['programme'])){
	include_once 'view/scolarite_transfert.php';
}
// On vérifie que l'utilisateur a entré des données
else if(empty($_POST['programme'])){

	$transfert_etu_error = "Veuillez entrer un programme.";

	include_once 'view/scolarite_transfert.php';
}
else{
	include_once 'controller/cleanData.php';
	
	$programme_data = $_POST['programme'];
	$id = $_POST['id'];

	// On inclut la classe Programme et on créé un nouvel objet avec les paramètres récupérés
	include_once 'model/programme.php';

	$programme = new Programme(null, cleanData($programme_data));

	// On vérifie que les données sont valides
	if(!$programme->valide()){
		$transfert_etu_error = $programme->getError("valide");
		include_once 'view/scolarite_transfert.php';
	}
	else{
		
		include_once 'model/etudiant.php';
		
		// On vérifie si le programme existe déjà dans la BDD
		if(!$programme->exists()){
			
			// On ajoute le programme en BDD et récupère son id
			$programme->add();
			
			// On récupère l'étudiant en fonction de l'id reçu
			$etudiant = Etudiant::get($id);
			
			// On lui attribue le programme désiré
			$etudiant->setProgramme($programme);
			
			// On met le semestre à 1
			$etudiant->setSemestre(1);
			
			// On met à jour l'étudiant en BDD
			$etudiant->update();
			
			$result = "Transfert réussi vers " . strtoupper($programme->getNom()) . " sans conseiller.";
			
			include_once 'view/scolarite_transfert.php';
		}
		else{
			
			include_once 'model/ec.php';
			
			// On récupère l'étudiant en fonction de l'id reçu
			$etudiant = Etudiant::get($id);
				
			// On lui attribue le programme désiré
			$etudiant->setProgramme($programme);
				
			// On met le semestre à 1
			$etudiant->setSemestre(1);
				
			// On met à jour l'étudiant en BDD
			$etudiant->update();
			
			// On récupère le conseiller de l'étudiant
			$conseiller = $etudiant->getConseiller();
			
			// Si l'étudiant n'avait pas de conseiller
			if(empty($conseiller)){
				// Lui en attribue un
				$conseiller = $etudiant->attribuerConseiller();
				
				$result = "Transfert réussi vers " . strtoupper($programme->getNom()) . " avec comme conseiller " .
						  $conseiller->getNom() . ' ' . $conseiller->getPrenom() . '.';
			}
			else{
				// On vérifie si le conseiller de l'étudiant est habilité pour le nouveau programme
				if($conseiller->isHabilite($programme->getId())){
					$result = "Transfert réussi vers " . strtoupper($programme->getNom()) . " en gardant " .
						  $conseiller->getNom() . ' ' . $conseiller->getPrenom() . ' comme conseiller.';
				}
				else{
					// Supprime le lien entre l'étudiant et son conseiller
					$etudiant->supprimerConseiller();
					
					// Attribue un nouveau conseiller
					$nouveau_conseiller = $etudiant->attribuerConseiller();
					
					$result = "Transfert réussi vers " . strtoupper($programme->getNom()) . " en changeant de conseiller (" .
							  $conseiller->getNom() . ' ' . $conseiller->getPrenom() . ") par " . 
							  $nouveau_conseiller->getNom() . ' ' . $nouveau_conseiller->getPrenom() . '.';
				}
			}	
				
			include_once 'view/scolarite_transfert.php';
		}
		
	}
}
?>