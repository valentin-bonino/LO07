<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
        <h2>Ajouter un enseignant-chercheur</h2>

        <form class="pure-form pure-form-stacked" id="form_drh_ajout_ec" method="POST" action="index.php?page=drh_ajout_ec">
            <fieldset id="fieldset_drh_ajout_ec">
                <legend>Ajout d'un enseignant-chercheur</legend>

                <div class="pure-g">
                    <div class="pure-u-1 pure-u-md-1-3">
                        <label for="drh_ajout_nom_ec">Nom</label>
                        <input id="drh_ajout_nom_ec" type="text" name="nom" value="<?php echo (isset($nom) ? $nom : ""); ?>" required>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-3">
                        <label for="drh_ajout_prenom_ec">Prénom</label>
                        <input id="drh_ajout_prenom_ec" type="text" name="prenom" value="<?php echo (isset($prenom) ? $prenom : ""); ?>" required>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-3">
                        <label for="drh_ajout_bureau_ec">Bureau</label>
                        <input id="drh_ajout_bureau_ec" type="text" name="" value="<?php echo (isset($bureau) ? $bureau : ""); ?>" required>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-3">
                        <label for="drh_ajout_pole_ec">Pôle</label>
                        <input id="drh_ajout_pole_ec" type="text" name="" value="<?php echo (isset($pole) ? $pole : ""); ?>" required>
                    </div>
                    <!--
                    <div class="pure-u-1 pure-u-md-1-3">
                        <label for="state">State</label>
                        <select id="state" class="pure-input-1-2">
                            <option>AL</option>
                            <option>CA</option>
                            <option>IL</option>
                        </select>
                    </div> -->
                </div>

                <button type="submit" class="pure-button pure-button-primary">Submit</button>
            </fieldset>
        </form>
        <?php if(isset($ajout_ec_error)) echo '<p class="error">' . $ajout_ec_error . '</p>'; ?>
    </div>
</div>
</div> <!-- ferme <div id="layout"> dans header.php -->
</body>

<p id="error_form_drh_ajout_ec" class="js_error"></p>

<script type="text/javascript" src="js/drh_ajout_ec.js"></script>