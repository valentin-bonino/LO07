$(document).ready(function() {
	
	// Stocke toutes les erreurs des champs du formulaire
	var errors_ajout_nouvel_etu = new tab_errors(new Array());
	
	preparerChamp($('#scolarite_ajout_id_etu'), "Numéro incorrect.", regex_id, 
			$('#error_form_scolarite_ajout_etu'), errors_ajout_nouvel_etu);
	preparerChamp($('#scolarite_ajout_nom_etu'), "Nom incorrect.", regex_nom_prenom, 
			$('#error_form_scolarite_ajout_etu'), errors_ajout_nouvel_etu);
	preparerChamp($('#scolarite_ajout_prenom_etu'), "Prénom incorrect.", regex_nom_prenom, 
			$('#error_form_scolarite_ajout_etu'), errors_ajout_nouvel_etu);
	preparerChamp($('#scolarite_ajout_programme_etu'), "Programme incorrect.", regex_programme, 
			$('#error_form_scolarite_ajout_etu'), errors_ajout_nouvel_etu);
	preparerChamp($('#scolarite_ajout_semestre_etu'), "Semestre incorrect.", regex_semestre, 
			$('#error_form_scolarite_ajout_etu'), errors_ajout_nouvel_etu);
	
	// Vérification lors de la soumission du formulaire
	$('#form_scolarite_ajout_etudiant').submit(function(){
		if(errors_ajout_nouvel_etu.length() == 0)
			return true;
		else{
			alert('Certains champs sont invalides.');
			return false;
		}
	});
});