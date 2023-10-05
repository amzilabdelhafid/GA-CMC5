<?php

/** Autoload any classes that are required **/
	function setReporting() {
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_errors','On');
	} else {
		error_reporting(E_ALL);
		ini_set('display_errors','Off');
		ini_set('log_errors', 'On');
	}
}




function orderPunAsc($a, $b) 
{
		return $b->pun_pro < $a->pun_pro;
}

function orderPunDesc($a, $b) 
{
		return $a->pun_pro < $b->pun_pro;
}

function paginate($array, $pageSize, $page = 1)
{
    $pages = array_chunk($array, $pageSize);
    return $page > sizeof($pages) ? [] : $pages[$page - 1];
}

function filter($chaine)
{
    setlocale(LC_ALL, 'fr_FR');
    $chaine = iconv('UTF8', 'ASCII//TRANSLIT//IGNORE', $chaine);
    $chaine = preg_replace('#[^0-9a-z]+#i', '-', $chaine);
    $chaine = str_replace('--', '-', $chaine);
    $chaine = trim($chaine, '-');
    return strtolower($chaine);
}

function __autoload($className) {
	if (file_exists(ROOT . DS . '../GA-CMC5-adm' . DS . 'class' . DS . 'class.' . strtolower($className) . '.php')) {
		require_once(ROOT . DS . '../GA-CMC5-adm' . DS . 'class' . DS . 'class.' . strtolower($className) . '.php');
	} else {
		/* Error Generation Code Here */
		print_r('Erreur de chargement de la classe');
	}
}

/** Main Call Function **/
function callHook() { 
	global $url;
	global $default;   
	
	$urlArray = array();			
	if (!isset($url)) {
		$controller = $default['controller'];
		$action = $default['action'];
		$urlArray[] = $controller;
		$urlArray[] = $action;		
	}
	else
	{	
		$urlArray = explode("/",$url);	
		if (!file_exists(ROOT . DS . 'php' . DS . strtolower($urlArray[0]) . '.php')) {
			$urlArray = array();
			$controller = $default['controller'];
			$action = $default['action'];
			$urlArray[] = $controller;
			$urlArray[] = $action;		
		}	
			
	}
	return($urlArray);
}

function fr_format($number)
{
  $nombre_format_francais = number_format($number, 2, ',', '');
  return($nombre_format_francais);
}

function calculerTTC($pun_ht, $tva)
{
	$pun_ttc = $pun_ht * (1 + $tva/100);
	return($pun_ttc);
}

function calculerTVAINTRACOM($siret)
{
	$siren = substr($siret,0,9);
	//311008130
	//CleTVA = ( 12 + 3 * ( CodeSIREN modulo 97 ) ) modulo 97
	$cle = ( 12 + 3 * ( $siren % 97 ) ) % 97;
	$num_tva = 'FR'.$cle.$siren;
	return($num_tva);
}

//DATE jj/mm/aaaa 
function fr_timestamp($date)
{
  if(!empty($date))
  {
    list($jour, $mois, $annee) = explode('/', $date);
    $madate_timestamp=mktime(0, 0, 0, $mois, $jour, $annee);
    return($madate_timestamp); 
  }  
}
    
function genererMDP($longueur) {
	$min = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
	$num = '023456789'; 
	$debut = substr(str_shuffle($min), 0, 6);
	$fin = substr(str_shuffle($num), 0, 2);
	return str_shuffle($debut.$fin);
}