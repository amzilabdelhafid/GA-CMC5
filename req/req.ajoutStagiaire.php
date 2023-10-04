<?php


// session_regenerate_id();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));



require_once (ROOT . DS . 'config' . DS . 'config.php');
require_once (ROOT . DS . 'config' . DS . 'shared.php');



	require_once("../class/class.database.php");
	require_once("../class/class.stagiaire.php");
	require_once("../class/class.groupe.php");
	require_once("../class/class.filiere.php");
	require_once("../class/class.motifs_visite_incubateur.php");
	require_once("../class/class.statut_stagiaire.php"); 
	require_once("../class/class.type_stagiaire.php"); 
	
	$niveau_stag = "";
	$id_filiere = "";
	$id_motif = "";
	$id_groupe = "";
	$id_type ="";
	

	$civilite_stag = $_REQUEST['civilite_stag'];
	$matricule_stag = $_REQUEST['matricule_stag'];
	// $cef_stag = $_REQUEST['cef_stag'];
	$nom_stag = $_REQUEST['nom_stag'];
	$prenom_stag = $_REQUEST['prenom_stag'];
	$cin_stag = $_REQUEST['cin_stag'];
	$date_naissance_stag = $_REQUEST['date_naissance_stag'];
	$tel_stag = $_REQUEST['tel_stag'];
	// $niveau_stag = $_REQUEST['niveau_stag'];
	$date_visite_stag = $_REQUEST['date_visite_stag'];
	// $id_filiere = $_REQUEST['id_filiere'];
	$id_stat = $_REQUEST['id_stat'];
	// $id_type = $_REQUEST['id_type'];
	// $id_motif = $_REQUEST['id_motif'];
	$com_stag = $_REQUEST['com_stag'];
	
	
	if (!isset($matricule_stag) || empty($matricule_stag))
  {
    return print_r(json_encode(['type' => 'error', 'msg' => 'Matricule non spécifié']));
  }
 
	if (!isset($cin_stag) || empty($cin_stag))
  {
    return print_r(json_encode(['type' => 'error', 'msg' => 'CIN non spécifié']));
  }
	
	// if (!isset($cef_stag) || empty($cef_stag))
  // {
    // return print_r(json_encode(['type' => 'error', 'msg' => 'CEF non spécifié']));
  // }
	
	if (!isset($nom_stag) || empty($nom_stag))
  {
    return print_r(json_encode(['type' => 'error', 'msg' => 'Nom non spécifié']));
  }
	
	if (!isset($prenom_stag) || empty($prenom_stag))
  {
    return print_r(json_encode(['type' => 'error', 'msg' => 'Prénom non spécifié']));
  }
	
	
	if (!isset($date_naissance_stag) || empty($date_naissance_stag))
  {
    return print_r(json_encode(['type' => 'error', 'msg' => 'Date de naissance non spécifié']));
  }
	
	if (!isset($tel_stag) || empty($tel_stag))
  {
    return print_r(json_encode(['type' => 'error', 'msg' => 'Téléphone non spécifié']));
  }
	
	
	if (!isset($_REQUEST['niveau_stag']) || empty($_REQUEST['niveau_stag']))
  {
    return print_r(json_encode(['type' => 'error', 'msg' => 'Niveau scolaire non spécifié']));
  }else{
		$niveau_stag = $_REQUEST['niveau_stag'];
	}
	
	if (!isset($_REQUEST['id_type']) || empty($_REQUEST['id_type']))
  {
    return print_r(json_encode(['type' => 'error', 'msg' => 'Type stagiaire non spécifié']));
  }else{
		$id_type = $_REQUEST['id_type'];
	}
	
	if (isset($_REQUEST['id_filiere']) || !empty($_REQUEST['id_filiere']))
  {
    $id_filiere = $_REQUEST['id_filiere'];
		
		if (!isset($_REQUEST['id_groupe']) || empty($_REQUEST['id_groupe'])){
			 return print_r(json_encode(['type' => 'error', 'msg' => 'Groupe stagiaire non spécifié']));
		}else{
			$id_groupe = $_REQUEST['id_groupe'];
		}
		
  }
	
	if (isset($_REQUEST['id_motif']) || !empty($_REQUEST['id_motif']))
  {
    $id_motif = $_REQUEST['id_motif'];
  }
	
	
	if(!isset($_REQUEST['id_stag'])){
	
	$stagiaireMatricule = new stagiaire();
	$stagiaireMatriculeList=$stagiaireMatricule->GetList(array(array('matricule_stag','=',$matricule_stag)),'id_stag',true,0);
	if(count($stagiaireMatriculeList)>0){
		return print_r(json_encode(['type' => 'error', 'msg' => 'Le nunéro matricule existe déjà']));
	}
	$stagiaireCIN = new stagiaire();
	$stagiaireCINList=$stagiaireCIN->GetList(array(array("cin_stag","=",$cin_stag)));
	if(count($stagiaireCINList)>0){
		return print_r(json_encode(['type' => 'error', 'msg' => 'Le nunéro CIN existe déjà']));
	}
	
	// $stagiaireCEF = new stagiaire();
	// $stagiaireCEFList=$stagiaireCEF->GetList(array(array("cef_stag","=",$cef_stag)));
	// if(count($stagiaireCEFList)>0){
		// return print_r(json_encode(['type' => 'error', 'msg' => 'Le nunéro CEF existe déjà']));
	// }
	
	$stagiaire = new stagiaire();
	
	$stagiaire->civilite_stag = $civilite_stag;
	$stagiaire->matricule_stag = $matricule_stag;
	// $stagiaire->cef_stag = $cef_stag;
	$stagiaire->nom_stag = $nom_stag;
	$stagiaire->prenom_stag = $prenom_stag;
	$stagiaire->cin_stag = strtoupper($cin_stag);
	$stagiaire->date_naissance_stag = $date_naissance_stag;
	$stagiaire->tel_stag = $tel_stag;
	$stagiaire->niveau_stag = $niveau_stag;
	$stagiaire->date_visite_stag = $date_visite_stag;
	$stagiaire->id_filiere = $id_filiere;
	$stagiaire->id_groupe = $id_groupe;
	$stagiaire->id_stat = $id_stat;
	$stagiaire->id_type = $id_type;
	$stagiaire->id_motif = $id_motif;
	$stagiaire->com_stag = $com_stag;
	
	
	if($id_stat==2){
		$stagiaire->sensibilise_stag = "1";
	}else if($id_stat==3){
		$stagiaire->visite_incub_stag = "1";
	}else if($id_stat==4){
		$stagiaire->opportunite_stag = "1";
	}
	
	
	// print_r($stagiaire);
	
	// $stagiaire->Save();
	
	
		if($stagiaire->Save())
		{
			
			return print_r(json_encode(['type' => 'success', 'msg' => 'Le stagiaire a bien été ajouté.']));
		}
		else
		{
			print_r(json_encode(['type' => 'error', 'msg' => 'Erreur lors de l\'enregistrement']));
		}
	
	
	}else{
		
		
		
		$stagiaire = new stagiaire();
		$stagiaire->Get($_REQUEST['id_stag']);
		$stagiaire->civilite_stag = $civilite_stag;
		$stagiaire->matricule_stag = $matricule_stag;
		// $stagiaire->cef_stag = $cef_stag;
		$stagiaire->nom_stag = $nom_stag;
		$stagiaire->prenom_stag = $prenom_stag;
		$stagiaire->cin_stag = strtoupper($cin_stag);
		$stagiaire->date_naissance_stag = $date_naissance_stag;
		$stagiaire->tel_stag = $tel_stag;
		$stagiaire->niveau_stag = $niveau_stag;
		$stagiaire->date_visite_stag = $date_visite_stag;
		$stagiaire->id_filiere = $id_filiere;
		$stagiaire->id_groupe = $id_groupe;
		$stagiaire->id_stat = $id_stat;
		$stagiaire->id_type = $id_type;
		$stagiaire->id_motif = $id_motif;
		$stagiaire->com_stag = $com_stag;
		
		if($id_stat==2){
			$stagiaire->sensibilise_stag = "1";
		}else if($id_stat==3){
			$stagiaire->visite_incub_stag = "1";
		}else if($id_stat==4){
			$stagiaire->opportunite_stag = "1";
		}
		
		if($stagiaire->Save())
		{
			
			return print_r(json_encode(['type' => 'success', 'msg' => 'Le stagiaire a bien été enregistré.']));
		}
		else
		{
			print_r(json_encode(['type' => 'error', 'msg' => 'Erreur lors de l\'enregistrement']));
		}	
		
		
	}
	
	
	
	
	

?>
