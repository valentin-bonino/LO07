<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
        <h2>Ajouter un étudiant</h2>

        <form class="pure-form pure-form-stacked" id="form_scolarite_ajout_etudiant" method="POST" action="index.php?page=scolarite_ajout_etudiant">
            <fieldset id="fieldset_scolarite_ajout_etudiant">
                <legend>Ajout d'un étudiant</legend>

                <div class="pure-g">
                    <div class="pure-u-1 pure-u-md-1-3">
                        <label for="scolarite_ajout_id_etu">Numéro étudiant</label>
                        <input id="scolarite_ajout_id_etu" type="text" name="id" value="<?php echo (isset($id) ? $id : ""); ?>" required>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-3">
                        <label for="scolarite_ajout_nom_etu">Nom</label>
                        <input id="scolarite_ajout_nom_etu" type="text" name="nom" value="<?php echo (isset($nom) ? $nom : ""); ?>" required>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-3">
                        <label for="scolarite_ajout_prenom_etu">Prénom</label>
                        <input id="scolarite_ajout_prenom_etu" type="text" name="prenom" value="<?php echo (isset($prenom) ? $prenom : ""); ?>" required>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-3">
                        <label for="scolarite_ajout_programme_etu">Programme</label>
                        <input id="scolarite_ajout_programme_etu" type="text" name="programme" value="<?php echo (isset($programme) ? $programme : ""); ?>" required>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-3">
                        <label for="scolarite_ajout_semestre_etu">Semestre</label>
                        <input id="scolarite_ajout_semestre_etu" type="text" name="semestre" value="<?php echo (isset($semestre) ? $semestre : ""); ?>" required>
                    </div>
                </div>

                <button type="submit" class="pure-button pure-button-primary">Ajouter</button>
            </fieldset>
        </form>
	<?php if(isset($ajout_etu_error)) echo '<p class="error">' . $ajout_etu_error . '</p>'; ?>
	</div>
</div>
</div> <!-- ferme <div id="layout"> dans header.php -->
</body>

<p id="error_form_scolarite_ajout_etu" class="js_error"></p>
<script type="text/javascript" src="js/scolarite_ajout_etu.js"></script>