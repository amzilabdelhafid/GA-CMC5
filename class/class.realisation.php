<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `realisation` (
	`id_realisation` int(11) NOT NULL auto_increment,
	`des_rea` VARCHAR(255) NOT NULL,
	`dat_rea` VARCHAR(255) NOT NULL,
	`com_rea` TEXT NOT NULL,
	`id_categorie` int(11) NOT NULL, INDEX(`id_categorie`), PRIMARY KEY  (`id_realisation`)) ENGINE=MyISAM;
*/

/**
* <b>realisation</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5.1 MYSQL
* @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=realisation&attributeList=array+%28%0A++0+%3D%3E+%27des_rea%27%2C%0A++1+%3D%3E+%27dat_rea%27%2C%0A++2+%3D%3E+%27com_rea%27%2C%0A++3+%3D%3E+%27categorie%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527TEXT%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527BELONGSTO%2527%252C%250A%2529&classList=array+%28%0A++0+%3D%3E+%27%27%2C%0A++1+%3D%3E+%27%27%2C%0A++2+%3D%3E+%27%27%2C%0A++3+%3D%3E+%27categorie%27%2C%0A%29
*/
include_once('class.pog_base.php');
include_once('class.categorie.php');
class realisation extends POG_Base
{
	public $id_realisation = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $des_rea;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $dat_rea;
	
	/**
	 * @var TEXT
	 */
	public $com_rea;
	
	/**
	 * @var INT(11)
	 */
	public $id_categorie;
	
	public $pog_attribute_type = array(
		"id_realisation" => array('db_attributes' => array("NUMERIC", "INT")),
		"des_rea" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"dat_rea" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"com_rea" => array('db_attributes' => array("TEXT", "TEXT")),
		"categorie" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
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
	
	function __construct($des_rea='', $dat_rea='', $com_rea='')
	{
		$this->des_rea = $des_rea;
		$this->dat_rea = $dat_rea;
		$this->com_rea = $com_rea;
	}
	
	
	/**
	* Gets object from database
	* @param integer $id_realisation 
	* @return object $realisation
	*/
	function Get($id_realisation)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `realisation` where `id_realisation`='".intval($id_realisation)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->id_realisation = $row['id_realisation'];
			$this->des_rea = $this->Unescape($row['des_rea']);
			$this->dat_rea = $this->Unescape($row['dat_rea']);
			$this->com_rea = $this->Unescape($row['com_rea']);
			$this->id_categorie = $row['id_categorie'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $realisationList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `realisation` ";
		$realisationList = Array();
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
			$sortBy = "id_realisation";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$realisation = new $thisObjectName();
			$realisation->id_realisation = $row['id_realisation'];
			$realisation->des_rea = $this->Unescape($row['des_rea']);
			$realisation->dat_rea = $this->Unescape($row['dat_rea']);
			$realisation->com_rea = $this->Unescape($row['com_rea']);
			$realisation->id_categorie = $row['id_categorie'];
			$realisationList[] = $realisation;
		}
		return $realisationList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $id_realisation
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->id_realisation!=''){
			$this->pog_query = "select `id_realisation` from `realisation` where `id_realisation`='".$this->id_realisation."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `realisation` set 
			`des_rea`='".$this->Escape($this->des_rea)."', 
			`dat_rea`='".$this->Escape($this->dat_rea)."', 
			`com_rea`='".$this->Escape($this->com_rea)."', 
			`id_categorie`='".$this->id_categorie."' where `id_realisation`='".$this->id_realisation."'";
		}
		else
		{
			$this->pog_query = "insert into `realisation` (`des_rea`, `dat_rea`, `com_rea`, `id_categorie` ) values (
			'".$this->Escape($this->des_rea)."', 
			'".$this->Escape($this->dat_rea)."', 
			'".$this->Escape($this->com_rea)."', 
			'".$this->id_categorie."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->id_realisation == "")
		{
			$this->id_realisation = $insertId;
		}
		return $this->id_realisation;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $id_realisation
	*/
	function SaveNew()
	{
		$this->id_realisation = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `realisation` where `id_realisation`='".$this->id_realisation."'";
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
			$pog_query = "delete from `realisation` where ";
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
	* Associates the categorie object to this one
	* @return boolean
	*/
	function GetCategorie()
	{
		$categorie = new categorie();
		return $categorie->Get($this->id_categorie);
	}
	
	
	/**
	* Associates the categorie object to this one
	* @return 
	*/
	function SetCategorie(&$categorie)
	{
		$this->id_categorie = $categorie->id_categorie;
	}
}
?>