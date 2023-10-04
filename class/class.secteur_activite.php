<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `secteur_activite` (
	`id_secteur` int(11) NOT NULL auto_increment,
	`libelle_secteur` VARCHAR(255) NOT NULL, PRIMARY KEY  (`id_secteur`)) ENGINE=MyISAM;
*/

/**
 * <b>secteur_activite</b> class with integrated CRUD methods.
 * @author Php Object Generator
 * @version POG 3.2 / PHP5.1 MYSQL
 * @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
 * @copyright Free for personal & commercial use. (Offered under the BSD license)
 * @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=secteur_activite&attributeList=array+%28%0A++0+%3D%3E+%27libelle_secteur%27%2C%0A++1+%3D%3E+%27res_act%27%2C%0A++2+%3D%3E+%27com_act%27%2C%0A++3+%3D%3E+%27data_act%27%2C%0A++4+%3D%3E+%27datd_act%27%2C%0A++5+%3D%3E+%27daft_act%27%2C%0A++6+%3D%3E+%27sta_act%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527TEXT%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B4%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B5%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B6%2B%253D%253E%2B%2527INT%2527%252C%250A%2529&classList=array+%28%0A++0+%3D%3E+%27%27%2C%0A++1+%3D%3E+%27%27%2C%0A++2+%3D%3E+%27%27%2C%0A++3+%3D%3E+%27%27%2C%0A++4+%3D%3E+%27%27%2C%0A++5+%3D%3E+%27%27%2C%0A++6+%3D%3E+%27%27%2C%0A%29
 */
include_once('class.pog_base.php');
class secteur_activite extends POG_Base
{
    public $id_secteur = '';

    /**
     * @var VARCHAR(255)
     */
    public $libelle_secteur;

    

    public $pog_attribute_type = array(
        "id_secteur" => array('db_attributes' => array("NUMERIC", "INT")),
        "libelle_secteur" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
       
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

    function __construct($libelle_secteur='')
    {
        $this->libelle_secteur = $libelle_secteur;
    }


    /**
     * Gets object from database
     * @param integer $id_secteur
     * @return object $secteur_activite
     */
    function Get($id_secteur)
    {
        $connection = Database::Connect();
        $this->pog_query = "select * from `secteur_activite` where `id_secteur`='".intval($id_secteur)."' LIMIT 1";
        $cursor = Database::Reader($this->pog_query, $connection);
        while ($row = Database::Read($cursor))
        {
            $this->id_secteur = $row['id_secteur'];
            $this->libelle_secteur = $this->Unescape($row['libelle_secteur']);
            
        }
        return $this;
    }


    /**
     * Returns a sorted array of objects that match given conditions
     * @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...}
     * @param string $sortBy
     * @param boolean $ascending
     * @param int limit
     * @return array $secteur_activiteList
     */
    function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
    {
        $connection = Database::Connect();
        $sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
        $this->pog_query = "select * from `secteur_activite` ";
        $secteur_activiteList = Array();
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
            $sortBy = "id_secteur";
        }
        $this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
        $thisObjectName = get_class($this);
        $cursor = Database::Reader($this->pog_query, $connection);
        while ($row = Database::Read($cursor))
        {
            $secteur_activite = new $thisObjectName();
            $secteur_activite->id_secteur = $row['id_secteur'];
            $secteur_activite->libelle_secteur = $this->Unescape($row['libelle_secteur']);
            
            $secteur_activiteList[] = $secteur_activite;
        }
        return $secteur_activiteList;
    }


    /**
     * Saves the object to the database
     * @return integer $id_secteur
     */
    function Save()
    {
        $connection = Database::Connect();
        $rows = 0;
        if ($this->id_secteur!=''){
            $this->pog_query = "select `id_secteur` from `secteur_activite` where `id_secteur`='".$this->id_secteur."' LIMIT 1";
            $rows = Database::Query($this->pog_query, $connection);
        }
        if ($rows > 0)
        {
            $this->pog_query = "update `secteur_activite` set 
						`libelle_secteur`='".$this->Escape($this->libelle_secteur)."' where `id_secteur`='".$this->id_secteur."'";
        }
        else
        {
            $this->pog_query = "insert into `secteur_activite` (`libelle_secteur`) values (
			'".$this->Escape($this->libelle_secteur)."' )";
        }
        $insertId = Database::InsertOrUpdate($this->pog_query, $connection);
        if ($this->id_secteur == "")
        {
            $this->id_secteur = $insertId;
        }
        return $this->id_secteur;
    }


    /**
     * Clones the object and saves it to the database
     * @return integer $id_secteur
     */
    function SaveNew()
    {
        $this->id_secteur = '';
        return $this->Save();
    }


    /**
     * Deletes the object from the database
     * @return boolean
     */
    function Delete()
    {
        $connection = Database::Connect();
        $this->pog_query = "delete from `secteur_activite` where `id_secteur`='".$this->id_secteur."'";
		
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
            $pog_query = "delete from `secteur_activite` where ";
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