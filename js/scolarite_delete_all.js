$(document).ready(function(){
	$('#scolarite_delete_all_etus').click(function(){
		var rep = confirm('Êtes-vous sur de vouloir supprimer tous les étudiants ?');
		
		if(rep)
			return true;
		else
			return false;
	});
});