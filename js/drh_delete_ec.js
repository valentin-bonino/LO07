$(document).ready(function(){
	/****************************************************************
	 * Soumission du formulaire de suppression d'un EC
	 ****************************************************************/
	$('.form_delete_ec').submit(function(){
		
		// Récupère la ligne du tableau
		var ligne = $(this).parent().parent();
		
		// Récupère chaques cases de la ligne
		var cases = ligne.children('td');
		
		// Récupère le nom de l'EC
		var nom = cases.eq(0).text();
		
		// Récupère le prénom de l'EC
		var prenom = cases.eq(1).text();
		
		// Demande confirmation à l'utilisateur
		var rep = confirm("Êtes-vous sur de vouloir supprimer " + nom + " " + prenom + " ?");
		
		if(rep)
			return true;
		else
			return false;
	});
});