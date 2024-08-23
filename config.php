<?php


if ( function_exists( 'error_reporting' ) ) {
	error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
}


function cms_autoloader($class){
	require_once __DIR__ . "/src/$class.php";
}

//autoload class from folder classes
spl_autoload_register('cms_autoloader');

/** Database connection */
define( 'DB_NAME', 'aplikacja_do_faktur_klientow' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );

