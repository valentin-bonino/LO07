$(document).ready(function(){
	
	// Récupère la liste des étudiants en fonction du programme
	$("#form_scolarite_liste_etus_prog").submit(function() {
		s = $(this).serialize();
		$.ajax({
			type: "POST",
			data: s,
			url: "index_ajax.php?page=scolarite_liste_etus_prog_ajax",
			success: function(result){
				/* console.log(result); */
				if(!$('#scolarite_liste_etus_prog').length)
					$('#main').children().eq(1).append(result);
				else
					$('#scolarite_liste_etus_prog').replaceWith(result);
			}
		});
		return false;
	});
	
	$('#select_scolarite_liste_etus_prog').change(function() {
		$("#form_scolarite_liste_etus_prog").submit();
	})
});