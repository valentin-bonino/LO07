$(document).ready(function(){
	$('#drh_delete_all_ec').click(function(){
		var rep = confirm('Êtes-vous sur de vouloir supprimer tous les enseignants chercheurs ?');
		
		if(rep)
			return true;
		else
			return false;
	});
});