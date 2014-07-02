$(document).ready(function(){
	// Demande confirmation de la suppression de l'étudiant
	$('#form_scolarite_suppr_etudiant').submit(function(){
		var rep = confirm('Êtes-vous sur de vouloir supprimer cet étudiant ?');
		
		if(rep)
			return true;
		else
			return false;
	})
});