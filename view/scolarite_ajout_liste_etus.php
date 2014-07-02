<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
        <h2>Ajouter une liste d'étudiants</h2>

		<form class="pure-form" id="form_scolarite_ajout_liste_etus" method="POST" action="index.php?page=scolarite_ajout_liste_etus" enctype="multipart/form-data">
        	<fieldset id="fieldset_scolarite_ajout_liste_etus">
				<legend>Ajouter avec un fichier CSV</legend>
	
				<input type="file" id="liste_etus" name="liste_etus" />
				<input type="submit" value="Ajouter" />
			</fieldset>
		</form>

<?php if(isset($ajout_liste_etus_error)) echo '<p class="error">' . $ajout_liste_etus_error . '</p>'; ?>
	</div>
</div>
</div> <!-- ferme <div id="layout"> dans header.php -->
</body>