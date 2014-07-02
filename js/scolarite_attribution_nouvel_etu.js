$(document).ready(function(){
	
	// Récupère la liste des étudiants en fonction du programme
	$('#select_scolarite_attribution_nouvel_etu_prog').change(function() {
		$.ajax({
			type: "POST",
			data: { id_programme : $(this).val() },
			url: "index_ajax.php?page=scolarite_attribution_nouvel_etu_ajax",
			success: function(result){
				console.log(result);
				$('#select_scolarite_attribution_nouvel_etu_etu').replaceWith(result);
			}
		});
	})
});