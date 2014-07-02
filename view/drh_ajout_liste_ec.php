<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
        <h2>Ajouter une liste d'enseignants-chercheurs</h2>

		<form class="pure-form" id="form_drh_ajout_liste_ec" method="POST" action="index.php?page=drh_ajout_liste_ec" enctype="multipart/form-data">
            <fieldset id="fieldset_drh_ajout_liste_ec">
				<legend>Ajouter avec un fichier CSV</legend>

				<input type="file" id="liste_ec" name="liste_ec" />
				<input type="submit" value="Ajouter" />
			</fieldset>
		</form>
		<?php if(isset($ajout_liste_ec_error)) echo '<p class="error">' . $ajout_liste_ec_error . '</p>'; ?>
	</div>
</div>
</div> <!-- ferme <div id="layout"> dans header.php -->
</body>