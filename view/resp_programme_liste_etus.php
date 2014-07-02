<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
        <h2>Liste des étudiants en <?php echo $_SESSION['programme']; ?></h2>

<?php

if(empty($etudiants))
	echo '<p>Il n\'y a pas d\'étudiants.</p>';
else{
?>
	<table class="pure-table">
		<thead>
			<tr>
				<th>Etudiant</th>
				<th>Conseiller</th>
			</tr>
		</thead>

<?php
	foreach($etudiants as $i => $etudiant){
		echo '<tbody><tr>';
			echo '<td>' . $etudiant->getNom() . ' ' . $etudiant->getPrenom() . '</td>';
			echo '<td>' . (!empty($conseillers[$i]) ? $conseillers[$i]->getNom() . ' ' . $conseillers[$i]->getPrenom() : 'Aucun') .'</td>';
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