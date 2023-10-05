<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `stagiaire` (
	`id_stag` int(11) NOT NULL auto_increment,
	`matricule_stag` VARCHAR(255) NOT NULL,
	`nom_stag` VARCHAR(255) NOT NULL,
	`prenom_stag` VARCHAR(255) NOT NULL,
	`civilite_stag` VARCHAR(255) NOT NULL,
	`cin_stag` VARCHAR(255) NOT NULL,
	`date_naissance_stag`  INT NOT NULL,
	`tel_stag` VARCHAR(255) NOT NULL,
	`id_groupe` int(11) NOT NULL, INDEX(`id_groupe`),
	`id_statut_stagiaire` int(11) NOT NULL, INDEX(`id_statut_stagiaire`),	
	`com_stag` TEXT NOT NULL, PRIMARY KEY  (`id_stag`)) ENGINE=MyISAM;
*/

/**
* <b>stagiaire</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5.1 MYSQL
* @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=stagiaire&attributeList=array+%28%0A++0+%3D%3E+%27matricule_stag%27%2C%0A++1+%3D%3E+%27stade_avancement_stagiaire%27%2C%0A++2+%3D%3E+%27com_rea%27%2C%0A++3+%3D%3E+%27filiere%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527TEXT%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527BELONGSTO%2527%252C%250A%2529&classList=array+%28%0A++0+%3D%3E+%27%27%2C%0A++1+%3D%3E+%27%27%2C%0A++2+%3D%3E+%27%27%2C%0A++3+%3D%3E+%27filiere%27%2C%0A%29
*/
include_once('class.pog_base.php');
include_once('class.groupe.php');
include_once('class.statut_stagiaire.php');

class stagiaire extends POG_Base
{
	public $id_stag = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $matricule_stag;
	
	
	/**
	 * @var VARCHAR(255)
	 */
	public $nom_stag;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $prenom_stag;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $civilite_stag;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $cin_stag;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $date_naissance_stag;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $tel_stag;
	
	/**
	 * @var INT(11)
	 */
	public $id_groupe;
	
	/**
	 * @var INT(11)
	 */
	public $id_statut_stagiaire;

	
	/**
	 * @var VARCHAR(255)
	 */
	public $com_stag;
	
	
	public $pog_attribute_type = array(
		"id_stag" => array('db_attributes' => array("NUMERIC", "INT")),
		"matricule_stag" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"nom_stag" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"prenom_stag" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"civilite_stag" => array('db_attributes' => array("TEXT", "VARCHAR", "10")),
		"cin_stag" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"date_naissance_stag" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"tel_stag" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"groupe" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"statut_stagiaire" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"com_stag" => array('db_attributes' => array("TEXT", "TEXT")),
		);
	public $pog_query;
	
	
	/**
	* Getter for some private attributes
	* @return mixed $attribute
	*/
	public function __get($attribute)
	{
		if (isset($this->{"_".$attribute}))
		{
			return $this->{"_".$attribute};
		}
		else
		{
			return false;
		}
	}
	
	function __construct($matricule_stag='',$nom_stag='',$prenom_stag='',$civilite_stag='',$cin_stag='',$date_naissance_stag='',$tel_stag='', $com_stag='')
	{
		$this->matricule_stag = $matricule_stag;
		$this->nom_stag = $nom_stag;
		$this->prenom_stag = $prenom_stag;
		$this->civilite_stag = $civilite_stag;
		$this->cin_stag = $cin_stag;
		$this->date_naissance_stag = $date_naissance_stag;
		$this->tel_stag = $tel_stag;
		$this->com_stag = $com_stag;
	}
	
	
	/**
	* Gets object from database
	* @param integer $id_stag 
	* @return object $stagiaire
	*/
	function Get($id_stag)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `stagiaire` where `id_stag`='".intval($id_stag)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->id_stag = $row['id_stag'];
			
			$this->matricule_stag = $this->Unescape($row['matricule_stag']);
			$this->nom_stag = $this->Unescape($row['nom_stag']);
			$this->prenom_stag = $this->Unescape($row['prenom_stag']);
			$this->civilite_stag = $this->Unescape($row['civilite_stag']);
			$this->cin_stag = $this->Unescape($row['cin_stag']);
			$this->date_naissance_stag = $this->Unescape($row['date_naissance_stag']);
			$this->tel_stag = $this->Unescape($row['tel_stag']);
			
			$this->id_groupe = $row['id_groupe'];
			$this->id_statut_stagiaire = $row['id_statut_stagiaire'];
			
			$this->com_stag = $this->Unescape($row['com_stag']);
			
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $stagiaireList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `stagiaire` ";
		$stagiaireList = Array();
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query .= " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($this->pog_attribute_type[$sortBy]['db_attributes']) && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE($sortBy) ";
				}
				else
				{
					$sortBy = "$sortBy ";
				}
			}
			else
			{
				$sortBy = "$sortBy ";
			}
		}
		else
		{
			$sortBy = "id_stag";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$stagiaire = new $thisObjectName();
			$stagiaire->id_stag = $row['id_stag'];
			$stagiaire->matricule_stag = $this->Unescape($row['matricule_stag']);
			$stagiaire->nom_stag = $this->Unescape($row['nom_stag']);
			$stagiaire->prenom_stag = $this->Unescape($row['prenom_stag']);
			$stagiaire->civilite_stag = $this->Unescape($row['civilite_stag']);
			$stagiaire->cin_stag = $this->Unescape($row['cin_stag']);
			$stagiaire->date_naissance_stag = $this->Unescape($row['date_naissance_stag']);
			$stagiaire->tel_stag = $this->Unescape($row['tel_stag']);
			
			$stagiaire->id_groupe = $row['id_groupe'];
			$stagiaire->id_statut_stagiaire = $row['id_statut_stagiaire'];
			
			$stagiaire->com_stag = $this->Unescape($row['com_stag']);
			
			$stagiaireList[] = $stagiaire;
		}
		return $stagiaireList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $id_stag
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->id_stag!=''){
			$this->pog_query = "select `id_stag` from `stagiaire` where `id_stag`='".$this->id_stag."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `stagiaire` set 
			
			`matricule_stag`='".$this->Escape($this->matricule_stag)."', 
			`nom_stag`='".$this->Escape($this->nom_stag)."', 
			`prenom_stag`='".$this->Escape($this->prenom_stag)."', 
			`civilite_stag`='".$this->Escape($this->civilite_stag)."', 
			`cin_stag`='".$this->Escape($this->cin_stag)."', 
			`date_naissance_stag`='".$this->Escape($this->date_naissance_stag)."', 
			`tel_stag`='".$this->Escape($this->tel_stag)."', 
			
			`id_groupe`='".$this->id_groupe."',
			`id_statut_stagiaire`='".$this->id_statut_stagiaire."',
			
			`com_stag`='".$this->Escape($this->com_stag)."' where `id_stag`='".$this->id_stag."'";
		}
		else
		{
			$this->pog_query = "insert into `stagiaire` (`matricule_stag`,`nom_stag`,`prenom_stag`,
			`civilite_stag`,`cin_stag`,`date_naissance_stag`,`tel_stag`,
			 `id_groupe`, `id_statut_stagiaire`, `com_stag` ) values (
			'".$this->Escape($this->matricule_stag)."', 
			'".$this->Escape($this->nom_stag)."', 
			'".$this->Escape($this->prenom_stag)."', 
			'".$this->Escape($this->civilite_stag)."', 
			'".$this->Escape($this->cin_stag)."', 
			'".$this->Escape($this->date_naissance_stag)."', 
			'".$this->Escape($this->tel_stag)."', 
			
			'".$this->id_groupe."',
			'".$this->id_statut_stagiaire."',
			
			'".$this->Escape($this->com_stag)."' )";
		}
		
		
		
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->id_stag == "")
		{
			$this->id_stag = $insertId;
		}
		return $this->id_stag;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $id_stag
	*/
	function SaveNew()
	{
		$this->id_stag = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `stagiaire` where `id_stag`='".$this->id_stag."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$connection = Database::Connect();
			$pog_query = "delete from `stagiaire` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
					{
						$pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$this->Escape($fcv_array[$i][2])."'";
					}
					else
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			return Database::NonQuery($pog_query, $connection);
		}
	}
	
	
	
	
	
	
	/**
	* Associates the groupe object to this one
	* @return boolean
	*/
	function GetGroupe()
	{
		$groupe = new groupe();
		return $groupe->Get($this->id_groupe);
	}
	
	
	/**
	* Associates the groupe object to this one
	* @return 
	*/
	function SetGroupe(&$groupe)
	{
		$this->id_groupe = $groupe->id_groupe;
	}
	/**
	* Associates the statut_stagiaire object to this one
	* @return boolean
	*/
	function GetStatut_stagiaire()
	{
		$statut_stagiaire = new statut_stagiaire();
		return $statut_stagiaire->Get($this->id_statut_stagiaire);
	}
	
	
	/**
	* Associates the statut_stagiaire object to this one
	* @return 
	*/
	function SetStatut_stagiaire(&$statut_stagiaire)
	{
		$this->id_statut_stagiaire = $statut_stagiaire->id_statut_stagiaire;
	}
	
	
	
	
}
 
?>