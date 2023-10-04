<?php


// session_regenerate_id();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));



require_once (ROOT . DS . 'config' . DS . 'config.php');
require_once (ROOT . DS . 'config' . DS . 'shared.php');

	require_once("../class/class.database.php");
	require_once("../class/class.stagiaire.php");
	require_once("../class/class.porteur_projet.php");
	require_once("../class/class.projet.php");
	require_once("../class/class.secteur_activite.php");
	 
	if (!isset($_REQUEST['id_stag']) || empty($_REQUEST['id_stag']))
	{
		return print_r(json_encode(['type' => 'error', 'msg' => 'id_stag manquant.'])); 
	}
	
	$id_stag = $_REQUEST['id_stag'];
	
	$stagiaire = new stagiaire();
	$porteur_projet = new porteur_projet();
	
	$stagiaire->Get($id_stag);
	
	if ($stagiaire === null)
	{
		return print_r(json_encode(['type' => 'error', 'msg' => 'le stagiaire spécifié n\'existe pas.'])); 
	}
	
  $porteur_projetList = $porteur_projet->GetList(array(array('id_stag','=',$id_stag)),'id_stag',true,0);
	if(count($porteur_projetList)>0){
		return print_r(json_encode(['type' => 'error', 'msg' => 'impossible de supprimer le stagiaire car il apparaît dans un ou plusieurs projet(s)'])); 
	}
	
	$stagiaire->Delete();
	print_r(json_encode(['type' => 'success', 'msg' => 'Stagiaire supprimé avec succès']));
	

?>
