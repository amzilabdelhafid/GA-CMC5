<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `projet` (
	`id_projet` int(11) NOT NULL auto_increment,
	`intitule_projet` VARCHAR(255) NOT NULL,
	`des_projet` TEXT NOT NULL,
	`nb_stag` INT(11) NOT NULL, 	
	`date_creation_projet` INT NOT NULL,
	`id_secteur` int(11) NOT NULL, INDEX(`id_secteur`),
	`id_stade` int(11) NOT NULL, INDEX(`id_stade`),PRIMARY KEY  (`id_projet`)) ENGINE=MyISAM;
*/

/**
* <b>projet</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5.1 MYSQL
* @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=projet&attributeList=array+%28%0A++0+%3D%3E+%27intitule_projet%27%2C%0A++1+%3D%3E+%27stade_avancement_projet%27%2C%0A++2+%3D%3E+%27com_rea%27%2C%0A++3+%3D%3E+%27filiere%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527TEXT%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527BELONGSTO%2527%252C%250A%2529&classList=array+%28%0A++0+%3D%3E+%27%27%2C%0A++1+%3D%3E+%27%27%2C%0A++2+%3D%3E+%27%27%2C%0A++3+%3D%3E+%27filiere%27%2C%0A%29
*/
include_once('class.pog_base.php');
include_once('class.secteur_activite.php');
class projet extends POG_Base
{
	public $id_projet = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $intitule_projet;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $id_stade;
	
	/**
	 * @var INT(11)
	 */
	public $id_secteur;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $des_projet;
	
	/**
	 * @var INT(11)
	 */
	public $nb_stag;
	
	/**
	 * @var INT
	 */
	public $date_creation_projet;
	
	
	public $pog_attribute_type = array(
		"id_projet" => array('db_attributes' => array("NUMERIC", "INT")),
		"intitule_projet" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"stade" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"secteur_activite" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"des_projet" => array('db_attributes' => array("TEXT", "TEXT")),
		"nb_stag" => array('db_attributes' => array("NUMERIC", "INT")),
		"date_creation_projet" => array('db_attributes' => array("NUMERIC", "INT")),
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
	
	function __construct($intitule_projet='',  $des_projet='', $nb_stag='', $date_creation_projet='')
	{
		$this->intitule_projet = $intitule_projet;
		$this->des_projet = $des_projet;
		$this->nb_stag = $nb_stag;
		$this->date_creation_projet = $date_creation_projet;
	}
	
	
	/**
	* Gets object from database
	* @param integer $id_projet 
	* @return object $projet
	*/
	function Get($id_projet)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `projet` where `id_projet`='".intval($id_projet)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->id_projet = $row['id_projet'];
			$this->intitule_projet = $this->Unescape($row['intitule_projet']);
			$this->id_stade = $row['id_stade'];
			$this->id_secteur = $row['id_secteur'];
			$this->des_projet = $this->Unescape($row['des_projet']);
			$this->nb_stag = $this->Unescape($row['nb_stag']);
			$this->date_creation_projet = $this->Unescape($row['date_creation_projet']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $projetList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `projet` ";
		$projetList = Array();
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
			$sortBy = "id_projet";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$projet = new $thisObjectName();
			$projet->id_projet = $row['id_projet'];
			$projet->intitule_projet = $this->Unescape($row['intitule_projet']);
			$projet->id_stade = $row['id_stade'];
			$projet->id_secteur = $row['id_secteur'];
			$projet->des_projet = $this->Unescape($row['des_projet']);
			$projet->nb_stag = $this->Unescape($row['nb_stag']);
			$projet->date_creation_projet = $this->Unescape($row['date_creation_projet']);
			$projetList[] = $projet;
		}
		return $projetList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $id_projet
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->id_projet!=''){
			$this->pog_query = "select `id_projet` from `projet` where `id_projet`='".$this->id_projet."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `projet` set 
			`intitule_projet`='".$this->Escape($this->intitule_projet)."', 
			`id_stade`='".$this->id_stade."',
			`id_secteur`='".$this->id_secteur."',
			`des_projet`='".$this->Escape($this->des_projet)."', 
			`nb_stag`='".$this->Escape($this->nb_stag)."', 
			`date_creation_projet`='".$this->Escape($this->date_creation_projet)."' where `id_projet`='".$this->id_projet."'";
		}
		else
		{
			$this->pog_query = "insert into `projet` (`intitule_projet`, `id_stade`, `id_secteur`, `des_projet`, `nb_stag`, `date_creation_projet` ) values (
			'".$this->Escape($this->intitule_projet)."', 
			'".$this->id_stade."',
			'".$this->id_secteur."',
			'".$this->Escape($this->des_projet)."', 
			'".$this->Escape($this->nb_stag)."', 
			'".$this->Escape($this->date_creation_projet)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->id_projet == "")
		{
			$this->id_projet = $insertId;
		}
		return $this->id_projet;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $id_projet
	*/
	function SaveNew()
	{
		$this->id_projet = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `projet` where `id_projet`='".$this->id_projet."'";
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
			$pog_query = "delete from `projet` where ";
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
	* Associates the secteur_activite object to this one
	* @return boolean
	*/
	function GetSecteur_activite()
	{
		$secteur_activite = new secteur_activite();
		return $secteur_activite->Get($this->id_secteur);
	}
	
	
	/**
	* Associates the secteur_activite object to this one
	* @return 
	*/
	function SetSecteur_activite(&$secteur_activite)
	{
		$this->id_secteur = $secteur_activite->id_secteur;
	}
	
	
	
	/**
	* Associates the stade object to this one
	* @return boolean
	*/
	function GetStade()
	{
		$stade = new stade();
		return $stade->Get($this->id_stade);
	}
	
	
	/**
	* Associates the stade object to this one
	* @return 
	*/
	function SetStade(&$stade)
	{
		$this->id_stade = $stade->id_stade;
	}
	
}
?>