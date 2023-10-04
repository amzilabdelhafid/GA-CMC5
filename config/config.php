<?php

global $configuration;

$configuration['pdoDriver']	= 'mysql';
$configuration['db_encoding'] = 0;
$configuration['db']	= 'gestion_incubateur';
$configuration['host'] 	= 'localhost';
$configuration['user'] 	= 'root';
$configuration['pass']	= '';
$configuration['port']	= '3306';	

$default['controller'] = 'index';
$default['action'] = 'index';

define ('DEVELOPMENT_ENVIRONMENT',true);
define('MAX_FILE_SIZE', '3150000'); //3M
define('BASE_PATH','http://localhost/gestion_incubateur/');

//VARIABLE PAR DEFAUT
$title = "Gestion Incubateur CMC Agadir";
$description = "description";
$societe = "Gestion Incubateur CMC Agadir";

//VARIABLE MAIL
define('USERNAME', 'salma.boukataya@ofppt.ma');
define('FROM', 'salma.boukataya@ofppt.ma');
define('PASSWORD', '8S6nWfV3c5');
define('SMTPHOST', "ssl0.ovh.net");
define('SMTPPORT', 25);
// define('SMTPSECURE','TLS');
define('MAILADMIN', 'salma.boukataya@ofppt.ma');
define('TELADMIN', '02 02 02 02 02');
