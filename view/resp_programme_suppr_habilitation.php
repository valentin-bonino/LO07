<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
        <h2>Suppression de l'habilitation d'un enseignant-chercheur</h2>

        <fieldset id="fieldset_resp_programme_suppr_habilitation">
			<legend>Supprimer l'habilitation d'un enseignant-chercheur</legend>
			
			<form class="pure-form" id="form_resp_programme_suppr_habilitation" method="POST" action="index.php?page=resp_programme_suppr_habilitation">
				<select name="id">
				<?php
				
					foreach($ecs as $ec){
						// Si l'EC est habilité pour le programme
						if($ec->isHabilite($_SESSION['id_programme'])){
							echo '<option value="' . $ec->getId() . '">' . $ec->getNom() . ' ' .$ec->getPrenom() . '</option>';
						}
					}
				
				?>
				</select>
				<input type="submit" value="Supprimer" />
			</form>
		</fieldset>