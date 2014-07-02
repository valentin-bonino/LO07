    <link rel="stylesheet" href="css/side-menu.css">
</head>
<body>
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
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?page=drh_accueil">Liste des enseignants chercheurs</a></li>
    				<li><a href="index.php?page=drh_liste_ecs_etus">Liste des enseignants chercheurs<br />et de leurs étudiants conseillés</a></li>
    				<li><a href="index.php?page=drh_liste_ecs_nb_etus">Liste des enseignants chercheurs<br />trié par nombre d'étudiants</a></li>
    				<li><a href="index.php?page=drh_ajout_ec">Ajouter un enseignant chercheur</a></li>
    				<li><a id="drh_delete_all_ec" href="index.php?page=drh_delete_all_ec" onclick="return confirm('Etes-vous sûr de vouloir supprimer tous les enseignants-chercheurs?');">Vider la liste d'enseignants<br />chercheurs</a></li>
    				<li><a href="index.php?page=drh_ajout_liste_ec">Ajouter une liste d'enseignants<br />chercheurs</a></li>
    				<li><a href="index.php?page=deconnexion">Déconnexion</a></li>
                </ul>
            </div>
        </div>