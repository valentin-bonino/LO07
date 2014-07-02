     <link rel="stylesheet" href="css/marketing.css">
</head>
<body>

<div class="splash-container">
    <div class="splash">
        <h1 class="splash-head">Service d'affectation de conseillers aux UTTétiens</h1>
        <p class="splash-subhead">
            Gestion des enseignants-chercheurs conseillers et des étudiants
        </p>
    </div>
</div>

<div class="content-wrapper">
    <div class="content">
        <h2 class="content-head is-center">Connexion</h2>
        <div class="pure-g">
            <div class="l-box-lrg pure-u-1 pure-u-md-2-5">
                <div class="pure-form pure-form-stacked">
                    <fieldset id="fieldset_authentification">
                    <legend>Veuillez vous authentifier</legend>

                    <form id="form_authentification" method="POST" action="index.php?page=authentification">
                        <label for="login_auth">Login : </label>
                        <input type="text" id="login_auth" name="login" value="<?php echo (isset($login) ? $login : ""); ?>" placeholder="Login" required />
                        <label for="pw_auth">Mot de passe : </label> 
                        <input type="password" id="pw_auth" name="password" placeholder="Mot de passe" required />
                        <input type="submit" class="pure-button" value="S'authentifier" />
                    </form>
                    
                    <?php if(isset($auth_error)) echo '<p class="error">' . $auth_error . '</p>'; ?>
                    
                    </fieldset>
                </div>
            </div>

            <div class="l-box-lrg pure-u-1 pure-u-md-3-5">
                <h4>Catégories d'utilisateurs</h4>
                <p>
                	<ul>
                		<li>Administration du site</li>
                		<li>Direction des ressources humaines</li>
                		<li>Directeurs de programmes</li>
                		<li>Scolarité</li>
                	</ul>
                </p>
            </div>
        </div>
    </div>

    <div class="ribbon l-box-lrg pure-g">
        <div class="l-box-lrg is-center pure-u-1 pure-u-md-1-2 pure-u-lg-2-5">
            <img class="pure-img-responsive" alt="Logo UTT" width="80%" height="80%" src="img/logo.png">
        </div>
        <div class="pure-u-1 pure-u-md-1-2 pure-u-lg-3-5">

            <h2 class="content-head content-head-ribbon">A propos</h2>
            <p>
                Ce site a été conçu dans le cadre de l'UV LO07 - Technologies du web dans le programme TCBR d'ISI de l'UTT.
            </p>
        </div>
    </div>

    <div class="footer l-box is-center">
        Merci à <a href="http://purecss.io/layouts/">Pure</a> pour ce layout.
    </div>
</div>
<script type="text/javascript" src="js/authentification.js"></script>