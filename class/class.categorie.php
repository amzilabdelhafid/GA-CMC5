<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `categorie` (
	`id_categorie` int(11) NOT NULL auto_increment,
	`des_cat` VARCHAR(255) NOT NULL,
	`sta_cat` INT NOT NULL, PRIMARY KEY  (`id_categorie`)) ENGINE=MyISAM;
*/

/**
* <b>categorie</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5.1 MYSQL
* @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=categorie&attributeList=array+%28%0A++0+%3D%3E+%27des_cat%27%2C%0A++1+%3D%3E+%27sta_cat%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527INT%2527%252C%250A%2529&classList=array+%28%0A++0+%3D%3E+%27%27%2C%0A++1+%3D%3E+%27%27%2C%0A%29
*/
include_once('class.pog_base.php');
class categorie extends POG_Base
{
	public $id_categorie = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $des_cat;
	
	/**
	 * @var INT
	 */
	public $sta_cat;
	
	/**
	 * @var INT
	 */
	public $ord_cat;
	
	public $pog_attribute_type = array(
		"id_categorie" => array('db_attributes' => array("NUMERIC", "INT")),
		"des_cat" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"sta_cat" => array('db_attributes' => array("NUMERIC", "INT")),
		"ord_cat" => array('db_attributes' => array("NUMERIC", "INT")),
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
	
	function __construct($des_cat='', $sta_cat='', $ord_cat='')
	{
		$this->des_cat = $des_cat;
		$this->sta_cat = $sta_cat;
		$this->ord_cat = $ord_cat;
	}
	
	
	/**
	* Gets object from database
	* @param integer $id_categorie 
	* @return object $categorie
	*/
	function Get($id_categorie)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `categorie` where `id_categorie`='".intval($id_categorie)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->id_categorie = $row['id_categorie'];
			$this->des_cat = $this->Unescape($row['des_cat']);
			$this->sta_cat = $this->Unescape($row['sta_cat']);
			$this->ord_cat = $this->Unescape($row['ord_cat']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $categorieList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `categorie` ";
		$categorieList = Array();
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
			$sortBy = "id_categorie";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$categorie = new $thisObjectName();
			$categorie->id_categorie = $row['id_categorie'];
			$categorie->des_cat = $this->Unescape($row['des_cat']);
			$categorie->sta_cat = $this->Unescape($row['sta_cat']);
			$categorie->ord_cat = $this->Unescape($row['ord_cat']);
			$categorieList[] = $categorie;
		}
		return $categorieList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $id_categorie
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->id_categorie!=''){
			$this->pog_query = "select `id_categorie` from `categorie` where `id_categorie`='".$this->id_categorie."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `categorie` set 
			`des_cat`='".$this->Escape($this->des_cat)."', 
			`sta_cat`='".$this->Escape($this->sta_cat)."',
			`ord_cat`='".$this->Escape($this->ord_cat)."' where `id_categorie`='".$this->id_categorie."'";
		}
		else
		{
			$this->pog_query = "insert into `categorie` (`des_cat`, `sta_cat`, `ord_cat` ) values (
			'".$this->Escape($this->des_cat)."', 
			'".$this->Escape($this->sta_cat)."',
			'".$this->Escape($this->ord_cat)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->id_categorie == "")
		{
			$this->id_categorie = $insertId;
		}
		return $this->id_categorie;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $id_categorie
	*/
	function SaveNew()
	{
		$this->id_categorie = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `categorie` where `id_categorie`='".$this->id_categorie."'";
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
			$pog_query = "delete from `categorie` where ";
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
}
?>