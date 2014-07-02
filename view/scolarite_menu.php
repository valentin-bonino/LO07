    <link rel="stylesheet" href="css/side-menu.css">
</head>
<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu pure-menu-open">
            <a class="pure-menu-heading" href="#">Menu</a>
            <ul>
				<li><a href="index.php?page=scolarite_accueil">Liste des étudiants</a></li>
				<li><a href="index.php?page=scolarite_liste_etus_prog">Liste des étudiants selon<br />un programme</a></li>
				<li><a href="index.php?page=scolarite_liste_etus_orphelins">Liste des étudiants orphelins</a></li>
				<li><a href="index.php?page=scolarite_liste_etus_conseilles">Liste des étudiants conseillés</a></li>
				<li><a href="index.php?page=scolarite_liste_conseillers">Liste des conseillers et leur<br />nombre d'étudiants conseillés</a></li>
				<li><a href="index.php?page=scolarite_ajout_etudiant">Ajouter un étudiant</a></li>
				<li><a href="index.php?page=scolarite_ajout_liste_etus">Ajouter une liste d'étudiants</a></li>
				<li><a href="index.php?page=scolarite_attribution_nouvel_etu">Attribution d'un nouvel étudiant</a></li>
				<li><a href="index.php?page=scolarite_attribution_etus">Attribution de conseiller aux<br />étudiants orphelins</a></li>
				<li><a href="index.php?page=scolarite_transfert">Transfert d'un étudiant</a></li>
				<li><a href="index.php?page=scolarite_suppr_etudiant">Supprimer un étudiant</a></li>
				<li><a id="scolarite_delete_all_etus" href="index.php?page=scolarite_delete_all_etus"  onclick="return confirm('Etes-vous sûr de vouloir supprimer tous les étudiants?');">Vider la liste d'étudiants</a></li>
				<li><a href="index.php?page=deconnexion">Déconnexion</a></li>
			</ul>
		</div>
	</div>

<!-- inutile avec html5 <script type="text/javascript" src="js/scolarite_delete_all.js"></script> -->