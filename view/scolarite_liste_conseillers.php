<div id="main">
        <div class="header">
            <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
            <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
        </div>

        <div class="content">
            <h2>Liste des conseillers et leur nombre d'étudiants conseillés</h2>

<?php

if(empty($ecs))
	echo '<p>Il n\'y a pas de conseillers.</p>';
else{
?>
	<table class="pure-table">
		<thead>
			<tr>
				<th>Conseiller</th>
				<th>Nombre d'étudiants conseillés</th>
			</tr>
		</thead>
		
<?php
	foreach($ecs as $ec){
		echo '<tbody><tr>';
			echo '<td>' . $ec[0]->getNom() . ' ' . $ec[0]->getPrenom() . '</td>';
			echo '<td>' . $ec[1] .'</td>';
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