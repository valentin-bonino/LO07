<h2>Liste des enseignants chercheurs habilités pour <?php echo $_SESSION['programme']; ?></h2>

<?php

if(empty($ecs_habilites))
	echo '<p>Il n\'y a pas d\'enseignants chercheurs habilités.</p>';
else{
?>
	<table class="pure-table">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Bureau</th>
				<th>Pole</th>
			</tr>
		</thead>
		
<?php
	foreach($ecs_habilites as $ec){
		echo '<tbody><tr>';
			echo '<td>' . $ec->getNom() . '</td>';
			echo '<td>' . $ec->getPrenom() . '</td>';
			echo '<td>' . $ec->getBureau() . '</td>';
			echo '<td>' . $ec->getPole()->getNom() . '</td>';
		echo '</tr></tbody>';
	}
?>
	
	</table>
<?php
}
?>

</div> <!-- ferme <div id="content"> dans resp_programme_ajout_habilitation.php -->
</div> <!-- ferme <div id="main"> dans resp_programme_ajout_habilitation.php -->
</div> <!-- ferme <div id="layout"> dans header.php -->
</body>