$(document).ready(function() {
	
	// Stocke toutes les erreurs des champs du formulaire
	var errors_ajout_nouvel_ec = new tab_errors(new Array());
	
	preparerChamp($('#drh_ajout_nom_ec'), "Nom incorrect.", regex_nom_prenom, 
			$('#error_form_drh_ajout_ec'), errors_ajout_nouvel_ec);
	preparerChamp($('#drh_ajout_prenom_ec'), "Prénom incorrect.", regex_nom_prenom, 
			$('#error_form_drh_ajout_ec'), errors_ajout_nouvel_ec);
	preparerChamp($('#drh_ajout_bureau_ec'), "Bureau incorrect.", regex_bureau, 
			$('#error_form_drh_ajout_ec'), errors_ajout_nouvel_ec);
	preparerChamp($('#drh_ajout_pole_ec'), "Pole incorrect.", regex_pole, 
			$('#error_form_drh_ajout_ec'), errors_ajout_nouvel_ec);
	
	// Vérification lors de la soumission du formulaire
	$('#form_drh_ajout_ec').submit(function() {
		if(errors_ajout_nouvel_ec.length() == 0)
			return true;
		else{
			alert('Certains champs sont invalides.');
			return false;
		}
	});
});