<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `groupe` (
	`id_groupe` int(11) NOT NULL auto_increment,
	`libelle_groupe` VARCHAR(255) NOT NULL,
	
	`id_filiere` int(11) NOT NULL, INDEX(`id_filiere`), PRIMARY KEY  (`id_groupe`)) ENGINE=MyISAM;
*/

/**
* <b>groupe</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5.1 MYSQL
* @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=groupe&attributeList=array+%28%0A++0+%3D%3E+%27libelle_groupe%27%2C%0A++1+%3D%3E+%27annee_formation%27%2C%0A++2+%3D%3E+%27com_rea%27%2C%0A++3+%3D%3E+%27filiere%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527TEXT%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527BELONGSTO%2527%252C%250A%2529&classList=array+%28%0A++0+%3D%3E+%27%27%2C%0A++1+%3D%3E+%27%27%2C%0A++2+%3D%3E+%27%27%2C%0A++3+%3D%3E+%27filiere%27%2C%0A%29
*/
include_once('class.pog_base.php');
include_once('class.filiere.php');
class groupe extends POG_Base
{
	public $id_groupe = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $libelle_groupe;
	
	
	/**
	 * @var INT(11)
	 */
	public $id_filiere;
	
	public $pog_attribute_type = array(
		"id_groupe" => array('db_attributes' => array("NUMERIC", "INT")),
		"libelle_groupe" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"filiere" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
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
	
	function __construct($libelle_groupe='')
	{
		
		$this->libelle_groupe = $libelle_groupe;
		
	}
	
	
	/**
	* Gets object from database
	* @param integer $id_groupe 
	* @return object $groupe
	*/
	function Get($id_groupe)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `groupe` where `id_groupe`='".intval($id_groupe)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->id_groupe = $row['id_groupe'];
			$this->libelle_groupe = $this->Unescape($row['libelle_groupe']);
			$this->id_filiere = $row['id_filiere'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $groupeList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `groupe` ";
		$groupeList = Array();
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
			$sortBy = "id_groupe";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$groupe = new $thisObjectName();
			$groupe->id_groupe = $row['id_groupe'];
			$groupe->libelle_groupe = $this->Unescape($row['libelle_groupe']);
			$groupe->id_filiere = $row['id_filiere'];
			$groupeList[] = $groupe;
		}
		return $groupeList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $id_groupe
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->id_groupe!=''){
			$this->pog_query = "select `id_groupe` from `groupe` where `id_groupe`='".$this->id_groupe."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `groupe` set 
			
			`libelle_groupe`='".$this->Escape($this->libelle_groupe)."', 
			
			`id_filiere`='".$this->id_filiere."' where `id_groupe`='".$this->id_groupe."'";
		}
		else
		{
			$this->pog_query = "insert into `groupe` (`libelle_groupe`, `id_filiere` ) values (
			
			'".$this->Escape($this->libelle_groupe)."', 
			
			'".$this->id_filiere."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->id_groupe == "")
		{
			$this->id_groupe = $insertId;
		}
		return $this->id_groupe;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $id_groupe
	*/
	function SaveNew()
	{
		$this->id_groupe = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `groupe` where `id_groupe`='".$this->id_groupe."'";
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
			$pog_query = "delete from `groupe` where ";
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
	* Associates the filiere object to this one
	* @return boolean
	*/
	function GetFiliere()
	{
		$filiere = new filiere();
		return $filiere->Get($this->id_filiere);
	}
	
	
	/**
	* Associates the filiere object to this one
	* @return 
	*/
	function SetFiliere(&$filiere)
	{
		$this->id_filiere = $filiere->id_filiere;
	}
}
?>