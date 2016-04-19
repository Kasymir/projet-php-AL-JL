<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


define('URL', 'http://localhost/projet-php-AL-JL/');


define('LIBS_PATH', 'application/libs/');
define('CONTROLLER_PATH', 'application/controleur/');
define('MODELS_PATH', 'application/modele/');
define('VIEWS_PATH', 'application/vue/');


// 1209600 seconds = 2 weeks
define('COOKIE_RUNTIME', 1209600);

define('COOKIE_DOMAIN', '.localhost');


define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'PHP-AL-JL');
define('DB_USER', 'root');
define('DB_PASS', '');

include('feedback_available.php');


