<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
    	<h2>Transfert d'un étudiant</h2>

    	<fieldset id="fieldset_scolarite_suppr_etudiant">
			<legend>Suppression d'un étudiant</legend>
			
			<?php if(empty($etudiants))
					echo "<p>Il n'y a aucun étudiant dans la base de données.</p>";
				  else { ?>
			<form id="form_scolarite_suppr_etudiant" method="POST" action="index.php?page=scolarite_suppr_etudiant">
				<select name="id">
					<?php 
						foreach($etudiants as $etu){
							echo '<option value="' . $etu->getId() . '">' . $etu->getNom() . ' ' . $etu->getPrenom() . '</option>';
						}
					?>
				</select>
				<input type="submit" value="Supprimer" onclick="return confirm('Etes-vous sûr de vouloir supprimer cet étudiant?');"/>
			</form>
			
			<?php } ?>
			
		</fieldset>

<!-- <script type="text/javascript" src="js/scolarite_delete_etu.js"></script> -->

    </div>
</div>
</div> <!-- ferme <div id="layout"> dans header.php -->
</body>