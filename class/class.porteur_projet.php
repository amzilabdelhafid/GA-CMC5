<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `porteur_projet` (
	`id_porteur` int(11) NOT NULL auto_increment,
	`ref_porteur` VARCHAR(255) NOT NULL,
	`qualite_porteur` TEXT NOT NULL,
	`id_stag` int(11) NOT NULL, INDEX(`id_stag`),
	`id_projet` int(11) NOT NULL, INDEX(`id_projet`),	PRIMARY KEY  (`id_porteur`)) ENGINE=MyISAM;
*/

/**
* <b>porteur_projet</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5.1 MYSQL
* @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=porteur_projet&attributeList=array+%28%0A++0+%3D%3E+%27ref_porteur%27%2C%0A++1+%3D%3E+%27stade_avancement_porteur_projet%27%2C%0A++2+%3D%3E+%27com_rea%27%2C%0A++3+%3D%3E+%27filiere%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527TEXT%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527BELONGSTO%2527%252C%250A%2529&classList=array+%28%0A++0+%3D%3E+%27%27%2C%0A++1+%3D%3E+%27%27%2C%0A++2+%3D%3E+%27%27%2C%0A++3+%3D%3E+%27filiere%27%2C%0A%29
*/
include_once('class.pog_base.php');
include_once('class.stagiaire.php');
include_once('class.projet.php');
class porteur_projet extends POG_Base
{
	public $id_porteur = '';

	/**
	 * @var INT(11)
	 */
	public $id_stag;
	
	/**
	 * @var INT(11)
	 */
	public $id_projet;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $ref_porteur;
	
	
	/**
	 * @var VARCHAR(255)
	 */
	public $qualite_porteur;
	
	
	
	public $pog_attribute_type = array(
		"id_porteur" => array('db_attributes' => array("NUMERIC", "INT")),
		"stagiaire" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"projet" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"ref_porteur" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"qualite_porteur" => array('db_attributes' => array("TEXT", "TEXT")),
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
	
	function __construct($ref_porteur='', $qualite_porteur='')
	{
		$this->ref_porteur = $ref_porteur;
		$this->qualite_porteur = $qualite_porteur;
	}
	
	
	/**
	* Gets object from database
	* @param integer $id_porteur 
	* @return object $porteur_projet
	*/
	function Get($id_porteur)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `porteur_projet` where `id_porteur`='".intval($id_porteur)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->id_porteur = $row['id_porteur'];
			$this->id_stag = $row['id_stag'];
			$this->id_projet = $row['id_projet'];
			$this->ref_porteur = $this->Unescape($row['ref_porteur']);
			$this->qualite_porteur = $this->Unescape($row['qualite_porteur']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $porteur_projetList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `porteur_projet` ";
		$porteur_projetList = Array();
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
			$sortBy = "id_porteur";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$porteur_projet = new $thisObjectName();
			$porteur_projet->id_porteur = $row['id_porteur'];
			$porteur_projet->id_stag = $row['id_stag'];
			$porteur_projet->id_projet = $row['id_projet'];
			$porteur_projet->ref_porteur = $this->Unescape($row['ref_porteur']);
			$porteur_projet->qualite_porteur = $this->Unescape($row['qualite_porteur']);
			$porteur_projetList[] = $porteur_projet;
		}
		return $porteur_projetList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $id_porteur
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->id_porteur!=''){
			$this->pog_query = "select `id_porteur` from `porteur_projet` where `id_porteur`='".$this->id_porteur."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `porteur_projet` set 
			`id_stag`='".$this->id_stag."',
			`id_projet`='".$this->id_projet."',
			`ref_porteur`='".$this->Escape($this->ref_porteur)."', 
			`qualite_porteur`='".$this->Escape($this->qualite_porteur)."' where `id_porteur`='".$this->id_porteur."'";
		}
		else
		{
			$this->pog_query = "insert into `porteur_projet` (`id_stag`, `id_projet`,`ref_porteur`, `qualite_porteur` ) values (
			'".$this->id_stag."',
			'".$this->id_projet."',
			'".$this->Escape($this->ref_porteur)."', 
			'".$this->Escape($this->qualite_porteur)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->id_porteur == "")
		{
			$this->id_porteur = $insertId;
		}
		return $this->id_porteur;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $id_porteur
	*/
	function SaveNew()
	{
		$this->id_porteur = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `porteur_projet` where `id_porteur`='".$this->id_porteur."'";
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
			$pog_query = "delete from `porteur_projet` where ";
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
	* Associates the stagiaire object to this one
	* @return boolean
	*/
	function GetStagiaire()
	{
		$stagiaire = new stagiaire();
		return $stagiaire->Get($this->id_stag);
	}
	
	
	/**
	* Associates the stagiaire object to this one
	* @return 
	*/
	function SetStagiaire(&$stagiaire)
	{
		$this->id_stag = $stagiaire->id_stag;
	}
	
	
	/**
	* Associates the Projet object to this one
	* @return boolean
	*/
	function GetProjet()
	{
		$projet = new projet();
		return $projet->Get($this->id_projet);
	}
	
	
	/**
	* Associates the Projet object to this one
	* @return 
	*/
	function SetProjet(&$projet)
	{
		$this->id_projet = $projet->id_projet;
	}
}
?>