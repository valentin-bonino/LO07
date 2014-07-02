<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
    	<h2>Liste des enseignants chercheurs</h2>
				
<?php
if (empty($ecs))
	echo '<p>Il n\'y a pas d\'enseignants-chercheurs dans la base de données.</p>';
else {
?>
	<table class="pure-table">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Bureau</th>
				<th>Pôle</th>
				<th>Supprimer</th>
			</tr>
		</thead>
		
<?php
	foreach($ecs as $ec){
		echo '<tbody><tr>';
			echo '<td>' . $ec->getNom() . '</td>';
			echo '<td>' . $ec->getPrenom() .'</td>';
			echo '<td>' . $ec->getBureau() .'</td>';
			echo '<td>' . $ec->getPole()->getNom() .'</td>';
			echo '<td><form class="form_delete_ec" method="POST" action="index.php?page=drh_delete_ec">' . 
				 '<input type="hidden" name="id" value="' . $ec->getId() . 
				 '" /><input type="submit" value="Supprimer" onclick="return confirm(\'Etes-vous sûr de vouloir supprimer ' . $ec->getNom() . " " . $ec->getPrenom() .'?\');"/></form></td>';
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