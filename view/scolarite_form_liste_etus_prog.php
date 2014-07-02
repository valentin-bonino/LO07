	<div id="main">
        <div class="header">
            <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
            <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
        </div>

        <div class="content">
        	<h2>Liste des étudiants par programme</h2>

			<form class="pure-form" id="form_scolarite_liste_etus_prog" method="POST" action="index.php?page=scolarite_liste_etus_prog">
        		<fieldset id="fieldset_scolarite_form_liste_etus_prog">
					<legend>Sélection du programme</legend>
	
					<select id="select_scolarite_liste_etus_prog" name="id">
					<option value=""></option>
					<?php 
						foreach($programmes as $p) {
							if(isset($programme) && $p->getId() == $programme->getId())
								echo '<option value="' . $p->getId() . '" selected="selected">' . $p->getNom() . '</option>';
							else
								echo '<option value="' . $p->getId() . '">' . $p->getNom() . '</option>';
						}
					?>
					</select>
					<input type="submit" value="Sélectionner" />	
				</fieldset>
			</form>
		</div>
	</div>
</div> <!-- ferme <div id="layout"> dans header.php -->
</body>

<script type="text/javascript" src="js/scolarite_liste_etus_prog.js"></script>