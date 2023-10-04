<?php
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
	
	$connection = Database::Connect();

  $filiere = new filiere();
	$groupe = new groupe();
	$statut_stagiaire = new statut_stagiaire();
	
	$recher_cin = $_REQUEST["recher_cin"];
	$recher_nom = $_REQUEST["recher_nom"];
	$recher_prenom = $_REQUEST["recher_prenom"];
	$id_filiere = $_REQUEST["id_filiere"];
	$id_groupe = $_REQUEST["id_groupe"];
	$sensibilise_stag = $_REQUEST["sensibilise_stag"];
	$visite_incub_stag = $_REQUEST["visite_incub_stag"];
	$opportunite_stag = $_REQUEST["opportunite_stag"];
	
	$tab_id_stat = array();
	if($sensibilise_stag!=0){
		$tab_id_stat[]=$sensibilise_stag;
	}
	if($visite_incub_stag!=0){
		$tab_id_stat[]=$visite_incub_stag;
	}
	if($opportunite_stag!=0){
		$tab_id_stat[]=$opportunite_stag;
	}

  
    $stagiaire = new stagiaire();
    $tabType = [];
    // foreach ($stagiaire->getAttributes() as $champ => $data)
    // {
      // $tabType[$champ] = $data[0];
      // $tabType["stagiaire.".$champ] = $data[0];
    // }

    
      // $id_stag = $_REQUEST['id'];

      $sql = "SELECT count(*) AS total FROM stagiaire";

      $query = $connection->prepare($sql);
      $query->execute();
      $data = $query->fetch();
      $iTotalRecords = $data["total"];

      $iDisplayLength = intval($_REQUEST['length']);
      $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
      $iDisplayStart = intval($_REQUEST['start']);
      $sEcho = intval($_REQUEST['draw']);
      $records = [];
      $records["data"] = [];
      $end = $iDisplayStart + $iDisplayLength;
      $end = $end > $iTotalRecords ? $iTotalRecords : $end;

      $index = $_REQUEST["order"][0]['column'];
      $tri = $_REQUEST["order"][0]['dir'];
      $order = $_REQUEST["columns"][$index]["name"]; 

      $having = '';
			
      foreach ($_REQUEST["columns"] as $index => $data)
      {
				
        if (!isset($data["search"]["value"]))
        {
          $champ = $data["name"];

          $value = $data["search"]["value"];
          $value = strtolower(trim($value));
          $value = addslashes($value);
					
					

          switch ($champ)
          {
            case 'matricule_stag':
              $having .= " and LOWER(s.matricule_stag) like LOWER('%$value%')";
              break;
            case 'cin_stag':
              
                $having .= " and LOWER(s.cin_stag) like LOWER('%$value%')";
              
              break;
            case 'nom_stag':
              $having .= " and LOWER(s.nom_stag) like LOWER('%$value%')";
              break;
            case 'prenom_stag':
              $having .= " and LOWER(s.prenom_stag) like LOWER('%$value%')";
              break;
            case 'id_stat':
              $having .= " and LOWER(st.libelle_stat) like LOWER('%$value%')";
              break;
            case 'id_filiere':
              $having .= " and LOWER(f.libelle_filiere) like LOWER('%$value%')";
              break;
							
							case 'id_groupe':
              $having .= " and LOWER(g.libelle_groupe) like LOWER('%$value%')";
              break;
          }
        }
      } 
			
			$where = 'where 1=1';
			
			if ($_REQUEST["recher_cin"]!=''){
				$where .= ' and s.cin_stag = "'.$_REQUEST["recher_cin"].'"';
			}
			
			if ($_REQUEST["recher_nom"]!=''){
				$where .= ' and s.nom_stag like "%'.$_REQUEST["recher_nom"].'%"';
			}
			if ($_REQUEST["recher_prenom"]!=''){
				$where .= ' and s.prenom_stag like "%'.$_REQUEST["recher_prenom"].'%"';
			}
			if ($_REQUEST["id_filiere"]!=0){
				$where .= ' and s.id_filiere = '.$_REQUEST["id_filiere"];
			}
			if ($_REQUEST["id_groupe"]!=0){
				$where .= ' and s.id_groupe = '.$_REQUEST["id_groupe"];
			}
			
			if ($_REQUEST["sensibilise_stag"]!=0 || $_REQUEST["visite_incub_stag"]!=0 || $_REQUEST["opportunite_stag"]!=0){
				$where .= ' and s.id_stat in ('.implode(",", $tab_id_stat).')';
			}
			
			

      $sql = "select s.id_stag, s.matricule_stag, s.cin_stag, s.nom_stag, s.prenom_stag, st.id_stat, st.libelle_stat, f.id_filiere, f.libelle_filiere, g.id_groupe,g.libelle_groupe, count(*) AS full_count
							from stagiaire s
							left join filiere f on f.id_filiere = s.id_filiere
							left join groupe g on g.id_groupe = s.id_groupe
							left join statut_stagiaire st on st.id_stat = s.id_stat
							$where
							group by s.id_stag, g.id_groupe
							having 1=1 $having
							";
				
				// echo($sql."<br>");			
							// $sql = "select s.id_stag, s.matricule_stag, s.cin_stag, s.nom_stag, s.prenom_stag, s.id_stat, s.id_filiere, g.id_groupe, count(*) AS full_count
							// from stagiaire s, groupe g
							// where s.id_filiere=g.id_filiere
							// group by s.id_stag, s.id_filiere
							// having 1=1 $having
							// order by $order $tri limit $iDisplayLength offset $iDisplayStart";
			
			// print_r($sql );

      $query = $connection->prepare($sql);
      $query->execute();

      $filteredCount = 0;
      while ($data = $query->fetch())
      {
				
				
        // $action = '<span style="overflow: visible; position: relative; width: 35px;">';
        // $action .= '<div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md pointer"><i class="flaticon-more-1"></i></a><div class="dropdown-menu dropdown-menu-right">';
        // $action .= '<ul class="kt-nav">';
        // $action .= '<li class="kt-nav__item"><a class="kt-nav__link pointer" onclick="loadAPI(\'./stagiaire/add/'.$data['id_stag'].'\');"><i class="kt-nav__link-icon flaticon-edit-1"></i><span class="kt-nav__link-text">Modifier</span></a></li>';
        // $action .= '<li class="kt-nav__item"><a class="kt-nav__link pointer" onclick="supprimerFournisseur('.$data['id_stag'].')"><i class="kt-nav__link-icon fa fa-trash"></i><span class="kt-nav__link-text">Supprimer</span></a></li>';
        // $action .= '</ul>';
        // $action .= '</div></div></span>';
				
					$action = '<div class="dropdown">';
						$action .= '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" >';
							$action .= '<i class="bx bx-dots-vertical-rounded"></i>';
						$action .= '</button>';
						$action .= '<div class="dropdown-menu">';
							$action .= '<a class="dropdown-item" href="javascript:void(0);" onclick="location.href=\'./stagiaire/details/'.$data['id_stag'].'\';" role="button"><i class="bx bx-edit-alt me-1"></i> Modifier</a>';
							$action .= '<a class="dropdown-item" href="javascript:void(0);" onclick="supprimerStagiaire('.$data['id_stag'].')"><i class="bx bx-trash me-1"></i> Supprimer</a>';
						$action .= '</div>';
					$action .= '</div>';


        $filiere->Get($data['id_filiere']);
				$groupe->Get($data['id_groupe']);
				$statut_stagiaire->Get($data['id_stat']);
				
				$libelle_statut = "";
				
				if($statut_stagiaire->id_stat==1){
					$libelle_statut = '<span class="badge bg-label-primary me-1">'.utf8_encode($statut_stagiaire->libelle_stat).'</span>';
				}else if($statut_stagiaire->id_stat==2){
					$libelle_statut = '<span class="badge bg-label-warning me-1">'.utf8_encode($statut_stagiaire->libelle_stat).'</span>';
				}else if($statut_stagiaire->id_stat==3){
					$libelle_statut = '<span class="badge bg-label-info me-1">'.utf8_encode($statut_stagiaire->libelle_stat).'</span>';
				}else if($statut_stagiaire->id_stat==4){
					$libelle_statut = '<span class="badge bg-label-danger me-1">'.utf8_encode($statut_stagiaire->libelle_stat).'</span>';
				}else if($statut_stagiaire->id_stat==5){
					$libelle_statut = '<span class="badge bg-label-success me-1">'.utf8_encode($statut_stagiaire->libelle_stat).'</span>';
				}

        // print_r($statut_stagiaire->libelle_stat);


        $records["data"][] = [
          'matricule_stag' => $data["matricule_stag"],
          'cin_stag'        => $data['cin_stag'],
          'nom_stag'             => "<strong>".$data['nom_stag']."</strong>",
					'prenom_stag'             => "<strong>".$data['prenom_stag']."</strong>",
          'id_stat'        => $libelle_statut,
          'id_filiere'        => utf8_encode($filiere->libelle_filiere),
          'id_groupe'        => utf8_encode($groupe->libelle_groupe),
          
          'action'         => $action
        ];

        $filteredCount = $data['full_count'];
				
				
      }


      $records["draw"] = $sEcho;
      $records["recordsTotal"] = $iTotalRecords;
      $records["recordsFiltered"] = $filteredCount;
      // $records["recordsFiltered"] = $iTotalRecords;

      echo json_encode($records);
			
    
  

?>
