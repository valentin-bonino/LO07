<select id="select_scolarite_attribution_nouvel_etu_etu" name="id_etu">
	<option value=""></option>
	<?php 
		if(!empty($etudiants))
			foreach($etudiants as $etu)
				echo '<option value="' . $etu->getId() . '">' . 
					$etu->getNom() . ' ' . $etu->getPrenom() . ' (' . $etu->getProgramme()->getNom() . ')</option>';
	?>
</select>