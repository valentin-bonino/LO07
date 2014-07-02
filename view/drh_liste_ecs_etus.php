<div id="main">
        <div class="header">
            <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
            <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
        </div>

        <div class="content">
        	<h2>Liste des enseignants chercheurs et de leurs étudiants conseillés</h2>
				
<?php

if(empty($ecs))
	echo '<p>Il n\'y a pas d\'enseignants-chercheurs dans la base de données.</p>';
else {
?>
	<table class="pure-table">
		<thead>
			<tr>
				<th>Chercheur</th>
				<th>Etudiants</th>
			</tr>
		</thead>
		
<?php
	foreach($ecs as $i => $ec){
		echo '<tbody><tr>';
			echo '<td>' . $ec->getNom() . ' ' . $ec->getPrenom() . '</td>';
			
			if($etus[$i] == null)
				echo '<td>Aucun</td>';
			else{
				echo '<td>';
				foreach($etus[$i] as $etu){
					echo $etu->getNom() . ' ' . $etu->getPrenom() . '<br/>';
				}
				echo '</td>';
			}
			
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