<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `motifs_visite_incubateur` (
	`id_motif` int(11) NOT NULL auto_increment,
	`libelle_motif` VARCHAR(255) NOT NULL, PRIMARY KEY  (`id_motif`)) ENGINE=MyISAM;
*/

/**
 * <b>motifs_visite_incubateur</b> class with integrated CRUD methods.
 * @author Php Object Generator
 * @version POG 3.2 / PHP5.1 MYSQL
 * @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
 * @copyright Free for personal & commercial use. (Offered under the BSD license)
 * @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=motifs_visite_incubateur&attributeList=array+%28%0A++0+%3D%3E+%27libelle_motif%27%2C%0A++1+%3D%3E+%27res_act%27%2C%0A++2+%3D%3E+%27com_act%27%2C%0A++3+%3D%3E+%27data_act%27%2C%0A++4+%3D%3E+%27datd_act%27%2C%0A++5+%3D%3E+%27daft_act%27%2C%0A++6+%3D%3E+%27sta_act%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527TEXT%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B4%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B5%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B6%2B%253D%253E%2B%2527INT%2527%252C%250A%2529&classList=array+%28%0A++0+%3D%3E+%27%27%2C%0A++1+%3D%3E+%27%27%2C%0A++2+%3D%3E+%27%27%2C%0A++3+%3D%3E+%27%27%2C%0A++4+%3D%3E+%27%27%2C%0A++5+%3D%3E+%27%27%2C%0A++6+%3D%3E+%27%27%2C%0A%29
 */
include_once('class.pog_base.php');
class motifs_visite_incubateur extends POG_Base
{
    public $id_motif = '';

    /**
     * @var VARCHAR(255)
     */
    public $libelle_motif;

    

    public $pog_attribute_type = array(
        "id_motif" => array('db_attributes' => array("NUMERIC", "INT")),
        "libelle_motif" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
       
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

    function __construct($libelle_motif='')
    {
        $this->libelle_motif = $libelle_motif;
    }


    /**
     * Gets object from database
     * @param integer $id_motif
     * @return object $motifs_visite_incubateur
     */
    function Get($id_motif)
    {
        $connection = Database::Connect();
        $this->pog_query = "select * from `motifs_visite_incubateur` where `id_motif`='".intval($id_motif)."' LIMIT 1";
        $cursor = Database::Reader($this->pog_query, $connection);
        while ($row = Database::Read($cursor))
        {
            $this->id_motif = $row['id_motif'];
            $this->libelle_motif = $this->Unescape($row['libelle_motif']);
            
        }
        return $this;
    }


    /**
     * Returns a sorted array of objects that match given conditions
     * @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...}
     * @param string $sortBy
     * @param boolean $ascending
     * @param int limit
     * @return array $motifs_visite_incubateurList
     */
    function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
    {
        $connection = Database::Connect();
        $sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
        $this->pog_query = "select * from `motifs_visite_incubateur` ";
        $motifs_visite_incubateurList = Array();
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
            $sortBy = "id_motif";
        }
        $this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
        $thisObjectName = get_class($this);
        $cursor = Database::Reader($this->pog_query, $connection);
        while ($row = Database::Read($cursor))
        {
            $motifs_visite_incubateur = new $thisObjectName();
            $motifs_visite_incubateur->id_motif = $row['id_motif'];
            $motifs_visite_incubateur->libelle_motif = $this->Unescape($row['libelle_motif']);
            
            $motifs_visite_incubateurList[] = $motifs_visite_incubateur;
        }
        return $motifs_visite_incubateurList;
    }


    /**
     * Saves the object to the database
     * @return integer $id_motif
     */
    function Save()
    {
        $connection = Database::Connect();
        $rows = 0;
        if ($this->id_motif!=''){
            $this->pog_query = "select `id_motif` from `motifs_visite_incubateur` where `id_motif`='".$this->id_motif."' LIMIT 1";
            $rows = Database::Query($this->pog_query, $connection);
        }
        if ($rows > 0)
        {
            $this->pog_query = "update `motifs_visite_incubateur` set 
						`libelle_motif`='".$this->Escape($this->libelle_motif)."' where `id_motif`='".$this->id_motif."'";
        }
        else
        {
            $this->pog_query = "insert into `motifs_visite_incubateur` (`libelle_motif`) values (
			'".$this->Escape($this->libelle_motif)."' )";
        }
        $insertId = Database::InsertOrUpdate($this->pog_query, $connection);
        if ($this->id_motif == "")
        {
            $this->id_motif = $insertId;
        }
        return $this->id_motif;
    }


    /**
     * Clones the object and saves it to the database
     * @return integer $id_motif
     */
    function SaveNew()
    {
        $this->id_motif = '';
        return $this->Save();
    }


    /**
     * Deletes the object from the database
     * @return boolean
     */
    function Delete()
    {
        $connection = Database::Connect();
        $this->pog_query = "delete from `motifs_visite_incubateur` where `id_motif`='".$this->id_motif."'";
		
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
            $pog_query = "delete from `motifs_visite_incubateur` where ";
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