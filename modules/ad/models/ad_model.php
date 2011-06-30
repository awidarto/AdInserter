<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * BackendPro
 *
 * An open source development control panel written in PHP
 *
 * @package		BackendPro
 * @author		Adam Price
 * @copyright	Copyright (c) 2008, Adam Price
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @link		http://www.kaydoo.co.uk/projects/backendpro
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * User_model
 *
 * Provides functionaly to query all tables related to the
 * user.
 *
 * @package   	BackendPro
 * @subpackage  Models
 */
class Ad_model extends Base_model
{
	function Ad_model()
	{
		parent::Base_model();

		$this->_prefix = $this->config->item('backendpro_table_prefix');
		$this->_TABLES = array(     'Campaign' => $this->_prefix . 'campaign',
                                    'CampaignSchedules' => $this->_prefix . 'campaign_schedules',
                                    'AdSession' => $this->_prefix . 'ad_session',
                                    'Banners' => $this->_prefix . 'banners',
                                    'BannerSize' => $this->_prefix . 'banner_sizes',
                                    'UserAgentLog' => $this->_prefix . 'ua_log',
                                    'TopDomain' => $this->_prefix . 'top_domain',
                                    'Position' => $this->_prefix . 'domain_pos',
                                    );

		log_message('debug','BackendPro : Ad_model class loaded');
	}

	/**
	 * Get Users
	 *
	 * @access public
	 * @param mixed $where Where query string/array
	 * @param array $limit Limit array including offset and limit values
	 * @return object
	 */
	function getCampaign($where = NULL, $limit = array('limit' => NULL, 'offset' => ''))
	{

		$this->db->select('*');
		$this->db->from($this->_TABLES['Campaign'] . " campaign");
		//$this->db->join($this->_TABLES['CampaignSchedules'] . " sch",'campaign.id=sch.campaign_id');
		if( ! is_null($where))
		{
			$this->db->where($where);
		}
		if( ! is_null($limit['limit']))
		{
			$this->db->limit($limit['limit'],( isset($limit['offset'])?$limit['offset']:''));
		}
		return $this->db->get();
	}
	
	
	function getSchedules($where = NULL, $limit = array('limit' => NULL, 'offset' => '')){
		$this->db->select('sch.*, sch.id as sch_id,cpn.cpn_name as title,sch.cpn_start as start,sch.cpn_end as end, sch.color as color, sch.allday as allday');
		$this->db->from($this->_TABLES['CampaignSchedules'] . " sch");
		$this->db->join($this->_TABLES['Campaign'] . " cpn",'sch.campaign_id = cpn.id','left');
		if( ! is_null($where))
		{
			$this->db->where($where);
		}
		if( ! is_null($limit['limit']))
		{
			$this->db->limit($limit['limit'],( isset($limit['offset'])?$limit['offset']:''));
		}
		return $this->db->get();
	}
	
	function getTopDomain($where = NULL, $limit = array('limit' => NULL, 'offset' => ''))
	{

		$this->db->select('*');
		$this->db->from($this->_TABLES['TopDomain'] . " domain");
		//$this->db->join($this->_TABLES['CampaignSchedules'] . " sch",'campaign.id=sch.campaign_id');
		if( ! is_null($where))
		{
			$this->db->where($where);
		}
		if( ! is_null($limit['limit']))
		{
			$this->db->limit($limit['limit'],( isset($limit['offset'])?$limit['offset']:''));
		}
		return $this->db->get();
	}	

	function getPosition($where = NULL, $limit = array('limit' => NULL, 'offset' => ''))
	{

		$this->db->select('*');
		$this->db->from($this->_TABLES['Position'] . " pos");
		//$this->db->join($this->_TABLES['CampaignSchedules'] . " sch",'campaign.id=sch.campaign_id');
		if( ! is_null($where))
		{
			$this->db->where($where);
		}
		if( ! is_null($limit['limit']))
		{
			$this->db->limit($limit['limit'],( isset($limit['offset'])?$limit['offset']:''));
		}
		return $this->db->get();
	}	
	
	
	function incrementField($table,$field,$where)
	{
	    $this->db->query(sprintf('UPDATE %s SET %s = %s + 1 WHERE %s',$this->_TABLES[$table],$field,$field,$where));
	}

	/**
	 * Delete Users
	 *
	 * Extend the delete users function to make sure we delete all data related
	 * to the user
	 *
	 * @access private
	 * @param mixed $where Delete user where
	 * @return boolean
	 */
	function _delete_Campaign($where)
	{
		// Get the ID's of the users to delete
		$query = $this->fetch('Campaign','id',NULL,$where);
		foreach($query->result() as $row)
		{
			$this->db->trans_begin();
			// -- ADD USER REMOVAL QUERIES/METHODS BELOW HERE

			// Delete main user details
			$this->db->delete($this->_TABLES['Campaign'],array('id'=>$row->id));

			// Delete user profile
			//$this->db->delete('CampaignSchedules',array('campaign_id'=>$row->id));

			// -- DON'T CHANGE BELOW HERE
			// Check all the tasks completed
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			} else
			{
				$this->db->trans_commit();
			}
		}
		return TRUE;
	}
}

/* End of file: user_model.php */
/* Location: ./modules/auth/controllers/admin/user_model.php */