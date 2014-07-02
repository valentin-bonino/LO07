<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
        <h2>Habilitation du programme <?php echo $_SESSION['programme']; ?> par pôle</h2>
	        <fieldset id="fieldset_resp_programme_ajout_par_pole">
				<legend>Habiliter les enseignants chercheurs en <?php echo $_SESSION['programme']; ?> par pôle </legend>
				
				<?php if(empty($poles))
						echo "<p>Il n'y a aucun pôle.</p>";
					  else { ?>
				<form class="pure-form" id="form_resp_programme_ajout_par_pole" method="POST" action="index.php?page=resp_programme_ajout_par_poles">
					<select name="id">
						<?php 
							foreach($poles as $pole){
								echo '<option value="' . $pole->getId() . '">' . $pole->getNom() . '</option>';
							}
						?>
					</select>
					<input type="submit" value="Habiliter" />
				</form>
				
				<?php } ?>
				
			</fieldset>

<?php 

if(isset($ajout) && $ajout){
	if(empty($ecs))
		echo '<p>Aucun enseignant-chercheur ajouté.</p>';
	else{ ?>
		<h2>Liste des enseignants chercheurs habilités</h2>
		<table class="pure-table">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Bureau</th>
				</tr>
			</thead>
			
			<?php 
				foreach($ecs as $ec) {
					echo '<tbody><tr>';
						echo '<td>' . $ec->getNom() . '</td>';
						echo '<td>' . $ec->getPrenom() . '</td>';
						echo '<td>' . $ec->getBureau() . '</td>';
					echo '</tr></tbody>';
				}
			?>
		</table>
	<?php 
	}
}

?>

</div>
</div>
</div> <!-- ferme <div id="layout"> dans header.php -->
</body>