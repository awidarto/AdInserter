<?php
/**
 * Class Filemodel
 * handles controller Class FreakAuth requests dealing with file table in DB
 * 
 *
 * @package     wssup
 * @subpackage  Models
 * @category    File Upload & Access
 * @author      Andy K. Awidarto
 * @copyright   Copyright (c) 2007, sinaptix.com
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @link 		http://www.sinaptix.com
 * @version 	1.0.4
 */

class Filemodel extends Model 
{
	
	// ------------------------------------------------------------------------
	/**
	 * initialises the class inheriting the methods of the class Model 
	 *
	 * @return Filemodel
	 */
    function Filemodel()
    {     
        parent::Model();
        
        //FreakAuth_light table prefix
        $this->_prefix = $this->config->item('db_prefix');
        $this->_table='ci_files';
    }

	    // ------------------------------------------------------------------------

	/**
	 * Retrieves all records and all fields (or those passed in the $fields string)
	 * from the table user. It is possible (optional) to pass the wonted fields, 
	 * the query limit, and the query WHERE clause.
	 *
	 * @param string of fields wanted $fields
	 * @param array $limit
	 * @param string $where
	 * @return query string
	 */
	function getFiles($fields=null, $limit=null, $where=null)
	{	
		($fields != null) ? $this->db->select($fields) :'';

		($where != null) ? $this->db->where($where) :'';

		($limit != null ? $this->db->limit($limit['start'], $limit['end']) : '');

		//returns the query string
		return $this->db->get($this->_table);
	}

	// ------------------------------------------------------------------------
	/**
	 * Retrieves all records and all fields (or those passed in the $fields string)
	 * from the table files, by file owner id, It is possible (optional) to pass the wonted fields, 
	 * the query limit, and the query WHERE clause.
	 *
	 * @param string of fields wanted $fields
	 * @param array $limit
	 * @param string $where
	 * @return query string
	 */
	function getFilesByUID($id,$fields=null, $limit=null, $where=null)
	{	
		($fields != null) ? $this->db->select($fields) :'';

		($where != null) ? $this->db->where($where.' AND uid = '.$id) : $this->db->where('uid = $id') ;

		($limit != null ? $this->db->limit($limit['start'], $limit['end']) : '');

		//returns the query string
		return $this->db->get($this->_table);
	}
	
	// ------------------------------------------------------------------------
	/**
	 * Retrieves all records and all fields (or those passed in the $fields string)
	 * from the table files, by file owner id, It is possible (optional) to pass the wonted fields, 
	 * the query limit, and the query WHERE clause.
	 *
	 * @param string of fields wanted $fields
	 * @param array $limit
	 * @param string $where
	 * @return query string
	 */
	function getFileByFID($fid)
	{	
		if($fid){
			$this->db->where('fid',$fid);
			$this->db->limit(1);
			return $this->db->get($this->_table);
		}else{
			return False;
		}
		//returns the query string
	}

	// ------------------------------------------------------------------------

	/**
	 * Inserts the values into the user table)
	 *
	 * @param unknown_type $id
	 */
	function insertFile($data)
	{
	    $this->db->insert($this->_table, $data);
	}

	// ------------------------------------------------------------------------
	/**
	 * Updates the file by $where array condition
	 *
	 * @param array with where condition 'table_field'=>'value' $where
	 * @param array with 'table_field'=>'value' of data to update $data
	 */
	function updateFile($where, $data)
	{
        $this->db->where($where);
        $this->db->update($this->_table, $data);
	}



}

?>