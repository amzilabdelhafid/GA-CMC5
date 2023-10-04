<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `configuration` (
	`id_configuration` int(11) NOT NULL auto_increment,
	`des_conf` VARCHAR(255) NOT NULL,
	`val_conf` VARCHAR(255) NOT NULL, PRIMARY KEY  (`id_configuration`)) ENGINE=MyISAM;
*/

/**
 * <b>configuration</b> class with integrated CRUD methods.
 * @author Php Object Generator
 * @version POG 3.2 / PHP5.1 MYSQL
 * @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
 * @copyright Free for personal & commercial use. (Offered under the BSD license)
 * @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=configuration&attributeList=array+%28%0A++0+%3D%3E+%27des_conf%27%2C%0A++1+%3D%3E+%27val_conf%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2529&classList=array+%28%0A++0+%3D%3E+%27%27%2C%0A++1+%3D%3E+%27%27%2C%0A%29
 */
include_once('class.pog_base.php');



class configuration extends POG_Base
{
    public $id_configuration = '';

    /**
     * @var VARCHAR(255)
     */
    public $des_conf;

    /**
     * @var VARCHAR(255)
     */
    public $val_conf;

    public $pog_attribute_type = array(
        "id_configuration" => array('db_attributes' => array("NUMERIC", "INT")),
        "des_conf" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
        "val_conf" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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

    function __construct($des_conf='', $val_conf='')
    {
        $this->des_conf = $des_conf;
        $this->val_conf = $val_conf;
    }


    /**
     * Gets object from database
     * @param integer $id_configuration
     * @return object $configuration
     */
    function Get($id_configuration)
    {
        $connection = Database::Connect();
        $this->pog_query = "select * from `configuration` where `id_configuration`='".intval($id_configuration)."' LIMIT 1";
        $cursor = Database::Reader($this->pog_query, $connection);
        while ($row = Database::Read($cursor))
        {
            $this->id_configuration = $row['id_configuration'];
            $this->des_conf = $this->Unescape($row['des_conf']);
            $this->val_conf = $this->Unescape($row['val_conf']);
        }
        return $this;
    }


    /**
     * Returns a sorted array of objects that match given conditions
     * @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...}
     * @param string $sortBy
     * @param boolean $ascending
     * @param int limit
     * @return array $configurationList
     */
    function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
    {
        $connection = Database::Connect();
        $sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
        $this->pog_query = "select * from `configuration` ";
        $configurationList = Array();
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
            $sortBy = "id_configuration";
        }
        $this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
        $thisObjectName = get_class($this);
        $cursor = Database::Reader($this->pog_query, $connection);
        while ($row = Database::Read($cursor))
        {
            $configuration = new $thisObjectName();
            $configuration->id_configuration = $row['id_configuration'];
            $configuration->des_conf = $this->Unescape($row['des_conf']);
            $configuration->val_conf = $this->Unescape($row['val_conf']);
            $configurationList[] = $configuration;
        }
        return $configurationList;
    }


    /**
     * Saves the object to the database
     * @return integer $id_configuration
     */
    function Save()
    {
        $connection = Database::Connect();
        $rows = 0;
        if ($this->id_configuration!=''){
            $this->pog_query = "select `id_configuration` from `configuration` where `id_configuration`='".$this->id_configuration."' LIMIT 1";
            $rows = Database::Query($this->pog_query, $connection);
        }
        if ($rows > 0)
        {
            $this->pog_query = "update `configuration` set 
			`des_conf`='".$this->Escape($this->des_conf)."', 
			`val_conf`='".$this->Escape($this->val_conf)."' where `id_configuration`='".$this->id_configuration."'";
        }
        else
        {
            $this->pog_query = "insert into `configuration` (`des_conf`, `val_conf` ) values (
			'".$this->Escape($this->des_conf)."', 
			'".$this->Escape($this->val_conf)."' )";
        }
        $insertId = Database::InsertOrUpdate($this->pog_query, $connection);
        if ($this->id_configuration == "")
        {
            $this->id_configuration = $insertId;
        }
        return $this->id_configuration;
    }


    /**
     * Clones the object and saves it to the database
     * @return integer $id_configuration
     */
    function SaveNew()
    {
        $this->id_configuration = '';
        return $this->Save();
    }


    /**
     * Deletes the object from the database
     * @return boolean
     */
    function Delete()
    {
        $connection = Database::Connect();
        $this->pog_query = "delete from `configuration` where `id_configuration`='".$this->id_configuration."'";
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
            $pog_query = "delete from `configuration` where ";
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