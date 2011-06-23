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

class Eventlogmodel extends Model 
{
	
	// ------------------------------------------------------------------------
	/**
	 * initialises the class inheriting the methods of the class Model 
	 *
	 * @return Filemodel
	 */
    function Eventlogmodel()
    {     
        parent::Model();
        
        //FreakAuth_light table prefix
        $this->_prefix = $this->config->item('db_prefix');
        $this->_table='event_log';
        
        $this->_TABLES = array('Event' => 'event_log','Outbox' => 'be_outbox'); 
        
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
	function getEvent($fields=null, $limit=null, $where=null,$order=array('field'=>'eventtime','sort'=>'desc'))
	{	
		($fields != null) ? $this->db->select($fields) :'*';

		($where != null) ? $this->db->where($where) :'';

		($limit != null ? $this->db->limit($limit['start'], $limit['end']) : '');

		($order != null) ? $this->db->order_by($order['field'],$order['sort']) :'';

		//returns the query string
		return $this->db->get($this->_table);
	}

	function getOutbox($fields=null, $limit=null, $where=null,$order=array('field'=>'timesent','sort'=>'desc'))
	{	
		($fields != null) ? $this->db->select($fields,false) :'*';

		($where != null) ? $this->db->where($where) :'';

		($limit != null ? $this->db->limit($limit['limit'], $limit['offset']) : '');

		($order != null) ? $this->db->order_by($order['field'],$order['sort']) :'';

		//returns the query string
		return $this->db->get($this->_TABLES['Outbox']);
	}

	// ------------------------------------------------------------------------

	/**
	 * Inserts the values into the user table)
	 *
	 * @param unknown_type $id
	 */
	function insertEvent($data)
	{
	    $this->db->insert($this->_table, $data);
	    return $this->db->insert_id();
	}

	function insertOutbox($data)
	{
	    $this->db->insert($this->_TABLES['Outbox'], $data);
	    return $this->db->insert_id();
	}

	// ------------------------------------------------------------------------
	/**
	 * Updates the file by $where array condition
	 *
	 * @param array with where condition 'table_field'=>'value' $where
	 * @param array with 'table_field'=>'value' of data to update $data
	 */
	function updateEvent($where, $data)
	{
        $this->db->where($where);
        $this->db->update($this->_table, $data);
	}

	function updateOutbox($where, $data)
	{
        $this->db->where($where);
        $this->db->update($this->_TABLES['Outbox'], $data);
	}

	// ------------------------------------------------------------------------
	/**
	 * Updates the file by $where array condition
	 *
	 * @param array with where condition 'table_field'=>'value' $where
	 * @param array with 'table_field'=>'value' of data to update $data
	 */
	function deleteEvent($mid)
	{
        if(!empty($mid) || $mid !='' || isset($mid)){
			$this->db->where('id',$mid);
	        $this->db->delete($this->_table);
		}else{
			return False;
		}
	}

	function deleteOutbox($mid)
	{
        if(!empty($mid) || $mid !='' || isset($mid)){
			$this->db->where('id',$mid);
	        $this->db->delete($this->_TABLES['Outbox']);
		}else{
			return False;
		}
	}

    function getOldestDate($table,$datefield)
	{	
		$this->db->select_min($datefield);
		return $this->db->get($this->_TABLES[$table]);
		//returns the query string
	}


}

?>