<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


define('URL', 'http://localhost/TP_PHP/TP4_PHP/');


define('LIBS_PATH', 'application/libs/');
define('CONTROLLER_PATH', 'application/controleur/');
define('MODELS_PATH', 'application/modele/');
define('VIEWS_PATH', 'application/vue/');


// 1209600 seconds = 2 weeks
define('COOKIE_RUNTIME', 1209600);

define('COOKIE_DOMAIN', '.localhost');


define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'jeu');
define('DB_USER', 'root');
define('DB_PASS', 'root');


define('USER_LOGIN', "Vous êtes maintenant conncté");
define('USER_LOGIN_FAILED_PASSWORD', "Couple pseudo, mot de passe invalide.");
define('USER_LOGIN_FAILED_PSEUDO', "Ce pseudo est inconnu, veuillez vous inscrire.");
define('USER_CREATED', "Vous avez créé votre compte, vous pouvez dors et déjà vous connecté.");
define('USER_UPDATE', "Modification effectués");

define('POUVOIR_CREATED','Le nouveau pouvoir vient d\'être créé');
define('RACE_CREATED','La nouvelle race vient d\'être créée');
define('RACE_UPDATE','La race vient d\'être modifiée');
define('POWER_UPDATE','Le pouvoir vient d\'être modifié');

define('REGISTER_FAILED_PASSWORD','Les mots de passes ne correspondent pas');
define('EMPTY_FIELD','Tous les champs sont obligatoires');
define('ALREADY_EXIST','Ce pseudo exsite déjà');

define('RACE_USED','Cette race est utilisée, vous ne pouvez donc pas la supprimer');
define('POWER_USED','Ce pouvoir est utilisé, vous ne pouvez donc pas le supprimer');
define('RACE_ALREADY_USED','Ce pouvoir est déjà utilisé par une autre race');
define('POUVOIR_ALREADY_CREATED','Ce pouvoir a déjà été créé');

define('POWER_DELETE','Pouvoir supprimer');
define('RACE_DELETE','Race supprimer');