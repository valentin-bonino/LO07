<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
        <h2>Attribution d'un étudiant</h2>

	<form id="form_scolarite_attribution_nouvel_etu" method="POST" action="index.php?page=scolarite_attribution_nouvel_etu">
		<fieldset id="fieldset_scolarite_attribution_nouvel_etu">
		<legend>Attribution d'un étudiant</legend>
	
			<select id="select_scolarite_attribution_nouvel_etu_prog" name="id_programme">
				<option value=""></option>
				<?php 
					foreach($programmes as $p){
						if(isset($programme) && $p->getId() == $programme->getId())
							echo '<option value="' . $p->getId() . '" selected="selected">' . $p->getNom() . '</option>';
						else
							echo '<option value="' . $p->getId() . '">' . $p->getNom() . '</option>';
					}
				?>
			</select>
		
			<select id="select_scolarite_attribution_nouvel_etu_etu" name="id_etu">
				<option value=""></option>
				<?php 
					foreach($etudiants as $etu)
							echo '<option value="' . $etu->getId() . '">' . 
								$etu->getNom() . ' ' . $etu->getPrenom() . ' (' . $etu->getProgramme()->getNom() . ')</option>';
				?>
			</select>
			<input type="submit" value="Attribuer" />
		</fieldset>
	</form>
	
	<?php if(isset($attribution_etu_error)) echo '<p class="error">' . $attribution_etu_error . '</p>'; ?>

<?php 
	
		if(isset($attribuer)){
			if(!$attribuer)
				echo '<p>Aucun conseiller à attribuer.</p>';
			else
				echo '<p>Etudiant attribué à ' . $ec->getNom() . ' ' . $ec->getPrenom() . '.</p>';
		}
?>

</div>
</div>
</div> <!-- ferme <div id="layout"> dans header.php -->
</body>
<script type="text/javascript" src="js/scolarite_attribution_nouvel_etu.js"></script>