$(document).ready(function(){
	// Vérifie la validité des champs
	$('#form_authentification').submit(function(){
		var children = $(this).children('input');
		
		if(children.eq(0).val() == '' || children.eq(1).val() == ''){
			alert('Veuillez remplir tous les champs.');
			return false;
		}
		else
			return true;
		
	});
});