<div id="main">
    <div class="header">
        <h1>Interface pour le type <?php echo $_SESSION['type'] ?></h1>
        <h2>Bienvenue "<?php echo $_SESSION['login'] ?>"!</h2>
    </div>

    <div class="content">
        <h2>Habilitation d'un enseignant-chercheur</h2>

    	<fieldset id="fieldset_resp_programme_ajout_habilitation">
			<legend>Habiliter un enseignant-chercheur</legend>
			
			<form class="pure-form" id="form_resp_programme_ajout_habilitation" method="POST" action="index.php?page=resp_programme_ajout_habilitation">
				<select name="id">
				<?php
				
					foreach($ecs as $ec){
						// Si l'EC n'est pas déjà  habilité pour le programme
						if(!$ec->isHabilite($_SESSION['id_programme'])){
							echo '<option value="' . $ec->getId() . '">' . $ec->getNom() . ' ' .$ec->getPrenom() . '</option>';
						}
					}
				
				?>
				</select>
				<input type="submit" value="Habiliter" />
			</form>
		</fieldset>