<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
    	<h2>Transfert d'un étudiant</h2>

    	<fieldset id="fieldset_scolarite_form_transfert">
			<legend>Transférer un étudiant</legend>
			
			<?php if(empty($etudiants)) {
					echo '<p>Il n\'y a pas d\'étudiants en TC.</p>';
			} else {?>
			
			<form id="form_scolarite_transfert" method="POST" action="index.php?page=scolarite_transfert">
				<select name="id">
					<?php 
						foreach($etudiants as $etu){
							echo '<option value="' . $etu->getId() . '">' . $etu->getNom() . ' ' . $etu->getPrenom() . '</option>';
						}
					?>
				</select>
				<label for="programme">Programme : </label><input type="text" id="programme" name="programme" />
				<input type="submit" value="Transférer" />
			</form>
			
			<?php if(isset($transfert_etu_error)) echo '<p class="error">' . $transfert_etu_error . '</p>'; ?>
			
			<?php }?>
			
		</fieldset>

<?php 
if(isset($result))
	echo '<p>' . $result . '</p>';
?>

        </div>
    </div>
</div> <!-- ferme <div id="layout"> dans header.php -->
</body>