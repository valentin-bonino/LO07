/****************************************************************
 * Variables globales
 ****************************************************************/

var regex_nom_prenom = /^[a-zA-Z]+([\-\'\s]?[a-zA-Z]+)*$/;
var regex_bureau = /^[a-zA-Z][0-9]{3}$/;
var regex_id = /^[0-9]+$/;
var regex_semestre = /^[1-9]+$/;
var regex_pole = /^[a-zA-Z]+$/;
var regex_programme = /^[a-zA-Z]+$/;
var regex_semestre = /^[1-9]+$/;

/****************************************************************
 * Classes
 ****************************************************************/

// Classe tab_error qui gère les erreurs rencontrées dans les formulaires
function tab_errors(tab){
	this.tab = tab;
	
	// Ajoute sans doublon au tableau
	this.add = function (val){
		if(this.tab.indexOf(val) == -1)
			this.tab.push(val);
	}
	
	// Supprime la valeur du tableau
	this.remove = function(val){
		var index = this.tab.indexOf(val);
		if(index != -1)
			this.tab.splice(index, 1);
	}
	
	// Retourne la taille du tableau
	this.length = function() { return this.tab.length; }
	
	// Retourne la valeur à l'index demandé
	this.get = function(i) { return this.tab[i]; }
	
	// Affiche le tableau en console
	this.affiche = function () { console.log(tab.join()); }
}

/****************************************************************
 * Fonctions globales
 ****************************************************************/

// Affiche ou non le champ d'erreur et renvoi true ou false en fonction du nombre d'erreur
function afficher_erreurs_form(champ_erreurs, tab_errors){
	// S'il n'y a pas d'erreur, n'affiche rien
	if(tab_errors.length() == 0){
		champ_erreurs.text('').hide();
	}
	// Sinon, parcours les erreurs et les affiche une à une
	else{
		var text = '';
		for(var i = 0; i < tab_errors.length(); i++){
			text += tab_errors.get(i) + " ";
		}
		champ_erreurs.text(text).show();
	}
}

// Gère une erreur rencontrée en fonction du champ et de l'erreur à afficher
function add_error_form(champ, champ_erreurs, tab_errors, error){
	// On ajoute sans doublon l'erreur au tableau d'erreur du formulaire
	tab_errors.add(error);
	// On affiche le champ d'erreurs
	afficher_erreurs_form(champ_erreurs, tab_errors);
	// On change le css
	champ.css("border", "solid 1px red");
}

// Suppression de l'erreur en fonction du champ et de l'erreur à supprimer
function remove_error_form(champ, champ_erreurs, tab_errors, error){
	// On supprime l'erreur éventuellement présente
	tab_errors.remove(error);
	// On affiche le champ d'erreurs
	afficher_erreurs_form(champ_erreurs, tab_errors);
	// On remet la bordure par défaut du champ
	champ.css('border', champ.data('bordure'));
}

// Prépare les champs pour la validation du formulaire
function preparerChamp(champ, error, regex, champ_erreurs, tab_errors){
	// Stocke la bordure par défaut
	champ.data('bordure', champ.css('border'));
	// Lors d'un changement de la valeur du champ nom_ec
	champ.bind("propertychange keyup paste", function(){
		// Si la valeur du champ est incorrecte
		if(!$(this).val().match(regex))
			// On ajoute l'erreur
			add_error_form(champ, champ_erreurs, tab_errors, error);
		else
			// On supprime éventuellement l'erreur déjà rencontrée
			remove_error_form(champ, champ_erreurs, tab_errors, error);	
	});
}

$(document).ready(function(){
		
	/****************************************************************
	 * Objets à cacher
	 ****************************************************************/
	
	$('.js_error').hide();
	
});