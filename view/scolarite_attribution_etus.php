<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
        <h2>Liste des étudiants orphelins avec leur nouveau conseiller</h2>

<?php

if(empty($etudiants))
	echo '<p>Il n\'y a pas d\'étudiants orphelins.</p>';
else{
?>
	<table class="pure-table">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Programme</th>
				<th>Semestre</th>
				<th>Conseiller</th>
			</tr>
		</thead>

<?php
	foreach($etudiants as $i => $etu){
		echo '<tbody><tr>';
			echo '<td>' . $etu->getNom() . '</td>';
			echo '<td>' . $etu->getPrenom() . '</td>';
			echo '<td>' . $etu->getProgramme()->getNom() . '</td>';
			echo '<td>' . $etu->getSemestre() . '</td>';
			
			if(empty($conseillers[$i]))
				echo '<td>Aucune attribution (aucun conseiller à attribuer).</td>';
			else
				echo '<td>' . $conseillers[$i]->getNom() . ' ' . $conseillers[$i]->getPrenom() . '</td>';
		echo '</tr></tbody>';
	}
?>
	
	</table>
<?php
}
?>

</div>
</div>
</div> <!-- ferme <div id="layout"> dans header.php -->
</body>