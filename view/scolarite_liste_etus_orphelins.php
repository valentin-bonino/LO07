<div id="main">
        <div class="header">
            <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
            <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
        </div>

        <div class="content">
            <h2>Liste des étudiants orphelins</h2>

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
			</tr>
		</thead>
		
<?php
	foreach($etudiants as $etu){
		echo '<tbody><tr>';
			echo '<td>' . $etu->getNom() . '</td>';
			echo '<td>' . $etu->getPrenom() . '</td>';
			echo '<td>' . $etu->getProgramme()->getNom() . '</td>';
			echo '<td>' . $etu->getSemestre() . '</td>';
		echo '</tr></tbody>';
	}
?>
	
	</table>
<?php
}
?>

        </div>
    </div>
</div>
</body>