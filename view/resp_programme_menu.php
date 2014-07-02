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
				<li><a href="index.php?page=resp_programme_accueil">Liste des étudiants en <?php echo $_SESSION['programme']; ?> et de leur<br />conseiller</a></li>
				<li><a href="index.php?page=resp_programme_ajout_habilitation">Habiliter un enseignant-chercheur</a></li>
				<li><a href="index.php?page=resp_programme_ajout_par_poles">Habiliter des enseignants<br />chercheurs par pôles</a></li>
				<li><a href="index.php?page=resp_programme_suppr_habilitation">Supprimer l'habilitation d'un<br />enseignant-chercheur</a></li>
				<li><a href="index.php?page=deconnexion">Déconnexion</a></li>
			</ul>
			</div>
	</div>