<div id="scolarite_liste_etus_prog">

	<h1>Liste des étudiants en <?php echo $programme->getNom(); ?></h1>
	
	<?php
	
	if(empty($etudiants))
		echo '<p>Il n\'y a pas d\'étudiants.</p>';
	else{
	?>
	<table class="pure-table">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Semestre</th>
			</tr>
		</thead>
			
	<?php
		foreach($etudiants as $etu){
			echo '<tbody><tr>';
				echo '<td>' . $etu->getNom() . '</td>';
				echo '<td>' . $etu->getPrenom() . '</td>';
				echo '<td>' . $etu->getSemestre() . '</td>';
			echo '</tr></tbody>';
		}
	?>		
		</table>
	<?php
	}
	?>

</div>