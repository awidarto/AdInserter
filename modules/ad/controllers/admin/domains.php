<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * BackendPro
 *
 * A website backend system for developers for PHP 4.3.2 or newer
 *
 * @package         BackendPro
 * @author          Adam Price
 * @copyright       Copyright (c) 2008
 * @license         http://www.gnu.org/licenses/lgpl.html
 * @link            http://www.kaydoo.co.uk/projects/backendpro
 * @filesource
 */

// ---------------------------------------------------------------------------

/**
 * Members
 *
 * Allow the user to manage website users
 *
 * @package         BackendPro
 * @subpackage      Controllers
 */
class Domains extends Admin_Controller
{
	function Domains()
	{
		parent::Admin_Controller();

		$this->load->helper('form');

		// Load userlib language
		$this->lang->load('userlib');

		// Set breadcrumb
		$this->load->model('ad_model');

		// Check for access permission
		check('Members');

		// Load the validation library
		$this->load->library('validation');

		log_message('debug','BackendPro : Members class loaded');
	}

	/**
	 * View Members
	 *
	 * @access public
	 */
	function index()
	{
		// Get Member Infomation
		$data['members'] = $this->ad_model->getTopDomain();
		$this->bep_site->set_crumb('Top Domains','ad/admin/domains');

		// Display Page
		$data['header'] = 'Top Domains';
		$data['page'] = $this->config->item('backendpro_template_admin') . "domains/view_top_domain";
		$data['module'] = 'ad';
		$this->load->view($this->_container,$data);
	}

	/**
	 * View Members
	 *
	 * @access public
	 */
	function position()
	{
		// Get Member Infomation
		$data['members'] = $this->ad_model->getPosition();
		$this->bep_site->set_crumb('Insert Position','ad/admin/domains/position');

		// Display Page
		$data['header'] = 'Insert Position';
		$data['page'] = $this->config->item('backendpro_template_admin') . "domains/view_position";
		$data['module'] = 'ad';
		$this->load->view($this->_container,$data);
	}

	/**
	 * View Widget
	 *
	 * @access public
	 */
	function widget()
	{
		// Get Member Infomation
		$data['members'] = $this->ad_model->getWidget();
		$this->bep_site->set_crumb('Widget Position','ad/admin/domains/widget');

		// Display Page
		$data['header'] = 'Widget Position';
		$data['page'] = $this->config->item('backendpro_template_admin') . "domains/view_widget";
		$data['module'] = 'ad';
		$this->load->view($this->_container,$data);
	}

	/**
	 * Set Profile Defaults
	 *
	 * Specify what values should be shown in the profile fields when creating
	 * a new user by default
	 *
	 * @access private
	 */
	function _set_profile_defaults()
	{
		//$this->validation->set_default_value('field1','value');
		//$this->validation->set_default_value('field2','value');
	}

	/**
	 * Get User Details
	 *
	 * Load user detail values from the submited form
	 *
	 * @access private
	 * @return array
	 */
	function _get_user_details()
	{
		$data['id'] = $this->input->post('id');
		$data['username'] = $this->input->post('username');
		$data['email'] = $this->input->post('email');
		$data['group'] = $this->input->post('group');
		$data['active'] = $this->input->post('active');

		// Only if password is set encode it
		if($this->input->post('password') != '')
		{
			$data['password'] = $this->userlib->encode_password($this->input->post('password'));
		}

		return $data;
	}

	/**
	 * Get Profile Details
	 *
	 * Load user profile detail values from the submited form
	 *
	 * @access private
	 * @return array
	 */
	function _get_profile_details()
	{
		$data = array();
		//$data['field1'] = $this->input->post('field1');
		//$data['field2'] = $this->input->post('field2');
		//$data['field3'] = $this->input->post('field3');
		return $data;
	}

	/**
	 * Display Member Form
	 *
	 * @access public
	 * @param integer $id Member ID
	 */
	function form($id = NULL)
	{
		// VALIDATION FIELDS
		$fields['id'] = "ID";
		$fields['domain'] = "Domain";
		$this->validation->set_fields($fields);

		// Setup validation rules
		if( is_null($id))
		{
			// Use create user rules (make sure no-one has the same email)
			$rules['domain'] = "trim|required";
		}
		else
		{
			// Use edit user rules (make sure no-one other than the current user has the same email)
			$rules['domain'] = "trim|required";
		}

		// Setup form default values
		if( ! is_null($id) AND ! $this->input->post('submit'))
		{
			// Modify form, first load
			$user = $this->ad_model->getTopDomain(array('domain.id'=>$id));
			$user = $user->row_array();
			
			$this->validation->set_default_value($user);
		}
		elseif( is_null($id) AND ! $this->input->post('submit'))
		{
			// Create form, first load
			$this->validation->set_default_value('domain','');

			// Setup profile defaults
			$this->_set_profile_defaults();
		}
		elseif( $this->input->post('submit'))
		{
			// Form submited, check rules
			$this->validation->set_rules($rules);
		}

		// RUN
		if ($this->validation->run() === FALSE)
		{

			// Display form
			$this->validation->output_errors();
			$data['header'] = ( is_null($id)?'Add Top Domain':'Update Top Domain');
    		$this->bep_site->set_crumb('Top Domains','ad/admin/domains');
			$this->bep_site->set_crumb($data['header'],'ad/admin/domains/form/'.$id);
			$data['page'] = $this->config->item('backendpro_template_admin') . "domains/form_top_domain";
			$data['module'] = 'ad';
			$this->load->view($this->_container,$data);
		}
		else
		{
			// Save form
			if( is_null($id))
			{
				// CREATE
				// Fetch form values
				$dom['domain'] = $this->input->post('domain');
				$dom['created'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->insert('TopDomain',$dom);

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('%s saved as Top Domain',$dom['domain']));
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to save %s as Top Domain',$dom['domain']));
				}
				redirect('ad/admin/domains');
			}
			else
			{
				// SAVE
				$dom['id'] = $this->input->post('id');
				$dom['domain'] = $this->input->post('domain');
				$dom['modified'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->update('TopDomain',$dom,array('id'=>$dom['id']));

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('%s updated',$dom['domain']));
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to update %s',$dom['domain']));
				}
				redirect('ad/admin/domains');
			}
		}
	}

	function formpos($id = NULL)
	{
		// VALIDATION FIELDS
		$fields['id'] = "ID";
		$fields['toplevelhost'] = "Domain";
		$fields['pos'] = "Insert Position";
		$this->validation->set_fields($fields);

		// Setup validation rules
		if( is_null($id))
		{
			// Use create user rules (make sure no-one has the same email)
			$rules['toplevelhost'] = "trim|required";
			$rules['pos'] = "trim|required";
		}
		else
		{
			// Use edit user rules (make sure no-one other than the current user has the same email)
			$rules['toplevelhost'] = "trim|required";
			$rules['pos'] = "trim|required";
		}

		// Setup form default values
		if( ! is_null($id) AND ! $this->input->post('submit'))
		{
			// Modify form, first load
			$pos = $this->ad_model->getPosition(array('pos.id'=>$id));
			$pos = $pos->row_array();
			
			$this->validation->set_default_value($pos);
		}
		elseif( is_null($id) AND ! $this->input->post('submit'))
		{
			// Create form, first load
			$this->validation->set_default_value('toplevelhost','');
			$this->validation->set_default_value('pos','both');

			// Setup profile defaults
			$this->_set_profile_defaults();
		}
		elseif( $this->input->post('submit'))
		{
			// Form submited, check rules
			$this->validation->set_rules($rules);
		}

		// RUN
		if ($this->validation->run() === FALSE)
		{

			// Display form
			$this->validation->output_errors();
			$data['header'] = ( is_null($id)?'Add Insert Position':'Update Insert Position');
    		$this->bep_site->set_crumb('Insert Position','ad/admin/domains/position');
			$this->bep_site->set_crumb($data['header'],'ad/admin/domains/formpos/'.$id);
			$data['page'] = $this->config->item('backendpro_template_admin') . "domains/form_position";
			$data['module'] = 'ad';
			$this->load->view($this->_container,$data);
		}
		else
		{
			// Save form
			if( is_null($id))
			{
				// CREATE
				// Fetch form values
				$dom['toplevelhost'] = $this->input->post('toplevelhost');
				$dom['pos'] = $this->input->post('pos');
				$dom['created'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->insert('Position',$dom);

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('Insert position saved for %s',$dom['toplevelhost']));
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to save insert position for %s',$dom['toplevelhost']));
				}
				redirect('ad/admin/domains/position');
			}
			else
			{
				// SAVE
				$dom['id'] = $this->input->post('id');
				$dom['toplevelhost'] = $this->input->post('toplevelhost');
				$dom['pos'] = $this->input->post('pos');
				$dom['modified'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->update('Position',$dom,array('id'=>$dom['id']));

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('%s updated',$dom['toplevelhost']));
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to update %s',$dom['toplevelhost']));
				}
				redirect('ad/admin/domains/position');
			}
		}
	}


	function formwidget($id = NULL)
	{
		// VALIDATION FIELDS
		$fields['id'] = "ID";
		$fields['toplevelhost'] = "Domain";
		$fields['pos'] = "Insert Position";
		$this->validation->set_fields($fields);

		// Setup validation rules
		if( is_null($id))
		{
			// Use create user rules (make sure no-one has the same email)
			$rules['toplevelhost'] = "trim|required";
			$rules['pos'] = "trim|required";
		}
		else
		{
			// Use edit user rules (make sure no-one other than the current user has the same email)
			$rules['toplevelhost'] = "trim|required";
			$rules['pos'] = "trim|required";
		}

		// Setup form default values
		if( ! is_null($id) AND ! $this->input->post('submit'))
		{
			// Modify form, first load
			$pos = $this->ad_model->getWidget(array('widget.id'=>$id));
			$pos = $pos->row_array();
			
			$this->validation->set_default_value($pos);
		}
		elseif( is_null($id) AND ! $this->input->post('submit'))
		{
			// Create form, first load
			$this->validation->set_default_value('toplevelhost','');
			$this->validation->set_default_value('pos','both');

			// Setup profile defaults
			$this->_set_profile_defaults();
		}
		elseif( $this->input->post('submit'))
		{
			// Form submited, check rules
			$this->validation->set_rules($rules);
		}

		// RUN
		if ($this->validation->run() === FALSE)
		{

			// Display form
			$this->validation->output_errors();
			$data['header'] = ( is_null($id)?'Add Widget Position':'Update Widget Position');
    		$this->bep_site->set_crumb('Widget Position','ad/admin/domains/widget');
			$this->bep_site->set_crumb($data['header'],'ad/admin/domains/formwidget/'.$id);
			$data['page'] = $this->config->item('backendpro_template_admin') . "domains/form_widget";
			$data['module'] = 'ad';
			$this->load->view($this->_container,$data);
		}
		else
		{
			// Save form
			if( is_null($id))
			{
				// CREATE
				// Fetch form values
				$dom['toplevelhost'] = $this->input->post('toplevelhost');
				$dom['pos'] = $this->input->post('pos');
				$dom['created'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->insert('Widget',$dom);

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('Insert position saved for %s',$dom['toplevelhost']));
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to save insert position for %s',$dom['toplevelhost']));
				}
				redirect('ad/admin/domains/widget');
			}
			else
			{
				// SAVE
				$dom['id'] = $this->input->post('id');
				$dom['toplevelhost'] = $this->input->post('toplevelhost');
				$dom['pos'] = $this->input->post('pos');
				$dom['modified'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->update('Widget',$dom,array('id'=>$dom['id']));

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('%s updated',$dom['toplevelhost']));
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to update %s',$dom['toplevelhost']));
				}
				redirect('ad/admin/domains/widget');
			}
		}
	}



	/**
	 * Delete
	 *
	 * Delete the selected users from the system
	 *
	 * @access public
	 */
	function delete()
	{
		if(FALSE === ($selected = $this->input->post('select')))
		{
			redirect('ad/admin/domains','location');
		}

		foreach($selected as $user)
		{
			if($user != 1)
			{	// Delete as long as its not the Administrator account
				$this->ad_model->delete('TopDomain',array('id'=>$user));
			}
			else
			{
				flashMsg('error',$this->lang->line('userlib_administrator_delete'));
			}
		}

		flashMsg('success','Domain(s) deleted');
		redirect('ad/admin/domains','location');
	}

	function delpos()
	{
		if(FALSE === ($selected = $this->input->post('select')))
		{
			redirect('ad/admin/domains/position','location');
		}

		foreach($selected as $user)
		{
			if($user != 1)
			{	// Delete as long as its not the Administrator account
				$this->ad_model->delete('Position',array('id'=>$user));
			}
			else
			{
				flashMsg('error',$this->lang->line('userlib_administrator_delete'));
			}
		}

		flashMsg('success','Position(s) deleted');
		redirect('ad/admin/domains/position','location');
	}

	function delwidget()
	{
		if(FALSE === ($selected = $this->input->post('select')))
		{
			redirect('ad/admin/domains/widget','location');
		}

		foreach($selected as $user)
		{
			if($user != 1)
			{	// Delete as long as its not the Administrator account
				$this->ad_model->delete('Widget',array('id'=>$user));
			}
			else
			{
				flashMsg('error',$this->lang->line('userlib_administrator_delete'));
			}
		}

		flashMsg('success','Widget Position Rule(s) deleted');
		redirect('ad/admin/domains/widget','location');
	}

}
/* End of file members.php */
/* Location: ./modules/auth/controllers/admin/members.php */