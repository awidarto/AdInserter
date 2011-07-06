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
 * Welcome
 *
 * The default welcome controller
 *
 * @package  	BackendPro
 * @subpackage  Controllers
 */
class Welcome extends Public_Controller
{
	function Welcome()
	{
		parent::Public_Controller();
		$this->load->module_library('auth','auth_form_processing');
		
	}
	
	function index(){
	    $this->auth_form_processing->login_form($this->_container);
	}

/*
	function index()
	{
		// Display Page
		$data['header'] = "Welcome";
		$data['page'] = $this->config->item('backendpro_template_public') . 'form_login';
		$data['module'] = 'auth';
		$this->load->view($this->_container,$data);
	}
*/
}


/* End of file welcome.php */
/* Location: ./modules/welcome/controllers/welcome.php */