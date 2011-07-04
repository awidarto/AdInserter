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
class Ad extends Admin_Controller
{
	function Ad()
	{
		parent::Admin_Controller();

		$this->load->helper('form');

        $this->load->model('ad_model');
		// Load userlib language
		$this->lang->load('userlib');

		// Set breadcrumb
		$this->bep_site->set_crumb('Ad Campaign','ad/admin/ad');

		// Check for access permission
		//check('Members');

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
		//is_user();
		
		// Get Member Infomation
		$data['members'] = $this->ad_model->getCampaign(array('user_id'=>$this->session->userdata('id')));

		// Display Page
		$data['header'] = 'Ad Campaign';
		$data['page'] = $this->config->item('backendpro_template_admin') . "ad/view";
		$data['module'] = 'ad';
		$this->load->view($this->_container,$data);
	}
	
	/**
	 * View Members
	 *
	 * @access public
	 */
	function dashboard()
	{
		//is_user();
		
		// Get Member Infomation
		$data['members'] = $this->ad_model->getCampaign(array('user_id'=>$this->session->userdata('id')));

		// Display Page
		$data['header'] = 'Dashboard';
		$data['page'] = $this->config->item('backendpro_template_admin') . "ad/view_dashboard";
		$data['module'] = 'ad';
		$this->load->view($this->_container,$data);
	}


	function reports()
	{
		//is_user();
		
		// Get Member Infomation
		$data['members'] = $this->ad_model->getCampaign(array('user_id'=>$this->session->userdata('id')));

		// Display Page
		$data['header'] = 'Reports';
		$data['page'] = $this->config->item('backendpro_template_admin') . "ad/view_report";
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
		$this->validation->set_default_value('gender','male');
		$this->validation->set_default_value('fullname','John Smith');
		$this->validation->set_default_value('company','Some Company');
		$this->validation->set_default_value('dob','1960-01-01');
		$this->validation->set_default_value('dob_y','1960');
		$this->validation->set_default_value('dob_m','01');
		$this->validation->set_default_value('dob_d','01');
		$this->validation->set_default_value('street','MH Thamrin');
	    $this->validation->set_default_value('city','Jakarta');                                         
        $this->validation->set_default_value('zip','90210');     
		$this->validation->set_default_value('country','Indonesia');
		$this->validation->set_default_value('domain',base_url());
    }


	/**                                       
	 * Get User Details                        
	 *
	 * Load user detail values from the submited form
	 *
	 * @access private
	 * @return array
	 */
	function _get_campaign_details()
	{
		//print_r($_POST);
		
		//$data['id'] = $this->input->post('id');
		//$data['company_id'] = $this->input->post('company_id');
		$data['user_id'] = $this->session->userdata('id');
		$data['cpn_name'] = $this->input->post('cpn_name');
		$data['cpn_start'] = $this->input->post('cpn_start');
        $data['cpn_end'] = $this->input->post('cpn_end');
		$data['cpn_time_start'] = $this->input->post('cpn_time_start');
        $data['cpn_time_end'] = $this->input->post('cpn_time_end');
        $data['allday'] = $this->input->post('allday');
        $data['cpn_landing_uri'] = $this->input->post('cpn_landing_uri');
        $data['campaign_id'] = $this->input->post('campaign_id');
        $data['color'] = $this->input->post('color');
        //$data['datecreated'] = $this->input->post('datecreated');
        $data['active'] = $this->input->post('active');
        
		return $data;
	}

	/**                                       
	 * Get User Details                        
	 *
	 * Load user detail values from the submited form
	 *
	 * @access private
	 * @return array
	 */
	function _get_schedule_details()
	{
		//print_r($_POST);
		
		//print_r(json_decode($_POST['eventobjects']));
		
		//$data['id'] = $this->input->post('id');
		//$data['company_id'] = $this->input->post('company_id');
        $data['campaign_id'] = $this->input->post('campaign_id');
		$data['user_id'] = $this->session->userdata('id');
		$data['cpn_name'] = $this->input->post('cpn_name');
		$data['cpn_start'] = $this->input->post('cpn_start');
        $data['cpn_end'] = $this->input->post('cpn_end');
		$data['cpn_time_start'] = $this->input->post('cpn_time_start');
        $data['cpn_time_end'] = $this->input->post('cpn_time_end');
        $data['allday'] = $this->input->post('allday');
        $data['cpn_landing_uri'] = $this->input->post('cpn_landing_uri');
        $data['color'] = $this->input->post('color');
        //$data['datecreated'] = $this->input->post('datecreated');
        $data['active'] = $this->input->post('active');
        
		return $data;
	}

	function _get_audience_details()
	{
		//print_r($_POST);
		
		//$data['id'] = $this->input->post('id');
		//$data['company_id'] = $this->input->post('company_id');
		$data['browser'] = $this->input->post('browser');
		$data['browser_specific'] = $this->input->post('browser_specific');
		$data['domain'] = $this->input->post('domain');
		$data['url_specific'] = $this->input->post('url_specific');
		$data['order_impression'] = $this->input->post('order_impression');
        $data['order_click'] = $this->input->post('order_click');
        
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
        $fields['company_id'] = 'Company ID';
        $fields['user_id'] = 'User ID';
        $fields['cpn_name'] = 'Campaign Title';
        $fields['cpn_start'] = 'Campaign Start';
        $fields['cpn_end'] = 'Campaign End';
        $fields['cpn_time_start'] = 'Time Start';
        $fields['cpn_time_end'] = 'Time End';
        $fields['allday'] = 'All Day';
        $fields['cpn_landing_uri'] = 'Campaign Landing URL';
        $fields['campaign_id'] = 'Campaign ID';
        $fields['color'] = 'Calendar Color';
        $fields['datecreated'] = 'Date Created';
        $fields['active'] = 'Status';

		$this->validation->set_fields($fields);

        $rules['company_id'] = 'trim';
        $rules['user_id'] = 'trim';
        $rules['cpn_name'] = 'trim';
        $rules['cpn_start'] = 'trim';
        $rules['cpn_end'] = 'trim';
        $rules['cpn_time_start'] = 'trim';
        $rules['cpn_time_end'] = 'trim';
        $rules['allday'] = 'trim';
        $rules['cpn_landing_uri'] = 'trim';
        $rules['campaign_id'] = 'trim';
        $rules['color'] = 'trim';
        //$rules['datecreated'] = 'trim';
        $rules['active'] = 'trim';
        
        
        $data['sizes'] = $this->ad_model->fetch("BannerSize");
        

		// Setup validation rules

		// Setup form default values
		if( ! is_null($id) AND ! $this->input->post('submit'))
		{
			// Modify form, first load
			$campaign = $this->ad_model->getCampaign(array('id'=>$id));
			$campaign = $campaign->row_array();
			
			$this->validation->set_default_value($campaign);
		}
		elseif( is_null($id) AND ! $this->input->post('submit'))
		{
			// Create form, first load
			$this->validation->set_default_value('active','1');
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
			$data['header'] = ( is_null($id)?'New Campaign':'Update Campaign');
			$this->bep_site->set_crumb($data['header'],'ad/admin/ad/form/'.$id);
			$data['page'] = $this->config->item('backendpro_template_admin') . "ad/form_campaign";
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
				$campaign = $this->_get_campaign_details();
				$campaign['datecreated'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->insert('Campaign',$campaign);
				$campaign_id = $this->db->insert_id();

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('Campaign: %s saved, Please Set Initial Schedule',$campaign['cpn_name']));

				    $this->_upload_files($campaign_id);

    				redirect('ad/admin/ad/schedule/'.$campaign_id.'/new');
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to save %s',$campaign['cpn_name']));
    				redirect('ad/admin/ad/');
				}
			}
			else
			{
				// SAVE
				$campaign = $this->_get_campaign_details();
				$campaign['modified'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->update('Campaign',$campaign,array('id'=>$id));

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('Campaign: %s updated',$campaign['cpn_name']));
				
				    $this->_upload_files($id);
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to update %s',$campaign['cpn_name']));
				}
				redirect('ad/admin/ad/');
			}
		}
	}
	
	
	function schedsave(){
	    $data = json_decode($this->input->post('obj'));
		//print_r($data);
		$sch['campaign_id'] = $data->campaign_id;
		$sch['user_id'] = $data->user_id;
		$sch['title'] = $data->title;
		$sch['color']	 = $data->color;
		$sch['cpn_id'] = $data->cpn_id;
		$sch['cpn_start'] = $data->cpn_start;
		$sch['cpn_end']	 = $data->cpn_end;
		$sch['cpn_time_start'] = $data->cpn_time_start;
		$sch['cpn_time_end'] = $data->cpn_time_end;
		$sch['allday'] = (is_null($data->allday) || $data->allday == false)?0:1;
	
	    $this->ad_model->insert('CampaignSchedules',$sch);
	}

	/**
	 * Display Member Form
	 *
	 * @access public
	 * @param integer $id Member ID
	 */
	function audience($id = NULL)
	{
		// VALIDATION FIELDS
		$fields['id'] = "ID";
        $fields['domain'] = 'Domain';
        $fields['browser'] = 'Browser';
        $fields['order_impression'] = 'Impressions Order';
        $fields['order_click'] = 'Clicks Order';

		$this->validation->set_fields($fields);

        $rules['id'] = 'trim';
        $rules['domain'] = 'trim';
        $rules['browser'] = 'trim';
        $rules['order_impression'] = 'trim';
        $rules['order_click'] = 'trim';

        $data['top_domains'] = $this->ad_model->fetch("TopDomain");

		// Setup validation rules

		// Setup form default values
		if( ! is_null($id) AND ! $this->input->post('submit'))
		{
			// Modify form, first load
			$campaign = $this->ad_model->getCampaign(array('id'=>$id));
			$campaign = $campaign->row_array();
			
			$data['campaign'] = $campaign;
			//print_r($campaign);
			
			$this->validation->set_default_value($campaign);
			//$this->validation->set_default_value('domain',$campaign['domain']);
			//$this->validation->set_default_value('browser',$campaign['browser']);
		}
		elseif( is_null($id) AND ! $this->input->post('submit'))
		{
			// Create form, first load
			$this->validation->set_default_value('domain','all');
			$this->validation->set_default_value('browser','all');
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
			$data['header'] = ( is_null($id)?'Set Audience':'Update Audience');
			$this->bep_site->set_crumb($data['header'],'ad/admin/ad/audience/'.$id);
			$data['page'] = $this->config->item('backendpro_template_admin') . "ad/form_audience";
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
				$campaign = $this->_get_audience_details();
				
				print_r($campaign);

				$this->db->trans_begin();

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success','Campaign saved');
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error','Failed to save campaign');
				}
				redirect('ad/admin/ad/');
			}
			else
			{
				// SAVE
				$campaign = $this->_get_audience_details();
				$campaign['modified'] = date('Y-m-d H:i:s');
				
				if($campaign['browser'] == 'all'){
				    $campaign['bweight'] = 0;
				}else if($campaign['browser'] == 'specific'){
    				$campaign['bweight'] = 1;
    			}

				if($campaign['domain'] == 'all'){
				    $campaign['dweight'] = 0;
				}else if($campaign['domain'] == 'specific'){
    				$campaign['dweight'] = 1;
				}else if($campaign['domain'] == 'top'){
    				$campaign['dweight'] = 2;
    			}

				$this->db->trans_begin();
				$this->ad_model->update('Campaign',$campaign,array('id'=>$id));

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success','Campaign saved');
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to update %s',$campaign['cpn_name']));
				}
				redirect('ad/admin/ad/');
			}
		}
	}


	/**
	 * Display Member Form
	 *
	 * @access public
	 * @param integer $id Member ID
	 */
	function schedule($id = NULL,$update = 'new')
	{
		// VALIDATION FIELDS
		$fields['id'] = "ID";
        $fields['company_id'] = 'Company ID';
        $fields['user_id'] = 'User ID';
        $fields['cpn_name'] = 'Campaign Title';
        $fields['cpn_start'] = 'Campaign Start';
        $fields['cpn_end'] = 'Campaign End';
        $fields['cpn_landing_uri'] = 'Campaign Landing URL';
        $fields['campaign_id'] = 'Campaign ID';
        $fields['color'] = 'Calendar Color';
        $fields['datecreated'] = 'Date Created';
        $fields['active'] = 'Status';

		$this->validation->set_fields($fields);

        $rules['company_id'] = 'trim';
        $rules['user_id'] = 'trim';
        $rules['cpn_name'] = 'trim';
        $rules['cpn_start'] = 'trim';
        $rules['cpn_end'] = 'trim';
        $rules['cpn_landing_uri'] = 'trim';
        $rules['campaign_id'] = 'trim';
        $rules['color'] = 'trim';
        //$rules['datecreated'] = 'trim';
        $rules['active'] = 'trim';

		// Setup validation rules

		// Setup form default values
		if( ! is_null($id) AND ! $this->input->post('submit'))
		{
			// Modify form, first load
			$campaign = $this->ad_model->getCampaign(array('id'=>$id));
			$campaign = $campaign->row_array();
			
			$data['campaign'] = $campaign;
			
			$this->validation->set_default_value($campaign);
		}
		elseif( is_null($id) AND ! $this->input->post('submit'))
		{
			// Create form, first load
			$this->validation->set_default_value('active','1');
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
			$data['update'] = (is_null($update))?'new':$update;
			$this->validation->output_errors();
			$data['header'] = ( is_null($id)?'Create New Schedule':'Set Schedule Dates');
			$this->bep_site->set_crumb($data['header'],'ad/form/'.$id);
			$data['page'] = $this->config->item('backendpro_template_admin') . "ad/form_schedule";
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
				$campaign = $this->_get_campaign_details();
				$campaign['datecreated'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->insert('Campaign',$campaign);
				$campaign_id = $this->db->insert_id();

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('Campaign: %s saved, Please Set Initial Schedule',$campaign['cpn_name']));
    				redirect('ad/admin/ad/schedule/'.$campaign_id);
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to save %s',$campaign['cpn_name']));
    				redirect('ad/admin/ad/');
				}
			}
			else
			{
				// SAVE
				$campaign = $this->_get_schedule_details();
				$campaign['modified'] = date('Y-m-d H:i:s');

				$this->db->trans_begin();
				$this->ad_model->update('Campaign',$campaign,array('id'=>$id));

				if($this->db->trans_status() === TRUE)
				{
					$this->db->trans_commit();
					flashMsg('success',sprintf('Campaign: %s updated',$campaign['cpn_name']));
  				    //redirect('ad/audience/'.$id);
				}
				else
				{
					$this->db->trans_rollback();
					flashMsg('error',sprintf('Failed to update %s',$campaign['cpn_name']));
					redirect('ad/admin/ad/');
				}
			}
		}
	}


    function adevent($id = NULL){
		$campaign = $this->ad_model->getSchedules(array('sch.user_id'=>$id));
		$campaign = $campaign->result_array();
		
		//print_r($campaign);
		
		$cpn_display = array();
		
		$evt_id = 1;
		
		foreach($campaign as $cpn){
		    if($cpn['start'] == $cpn['end']){
		        $cpn['id'] = $evt_id;
		        $cpn_display[] = $cpn;
		    }else{
                $start = strtotime($cpn['start']); 
                $end = strtotime($cpn['end']); 
                $date = $start;
                $cpn_temp = $cpn;
                while($date <= $end) 
                { 
    		        $cpn['id'] = $evt_id;
                    $cpn_temp['start'] = date('Y-m-d',$date);
                    $cpn_temp['end'] = date('Y-m-d',$date);
                    $cpn_display[] = $cpn_temp; 
                   //write your code here 
                   $date = strtotime("+1 day", $date); 
                } 
		    }
		    $evt_id++;
		}
		
		
		$campaign = $cpn_display;

		//print_r($campaign);

		for($i = 0;$i < count($campaign);$i++){
		    $campaign[$i]['id'] = $i;
			$campaign[$i]['start'] = $campaign[$i]['start'].'T'.$campaign[$i]['cpn_time_start'].'Z';
			$campaign[$i]['end'] = $campaign[$i]['end'].'T'.$campaign[$i]['cpn_time_end'].'Z';
			$campaign[$i]['allDay'] = ($campaign[$i]['allday'] == 1)?True:False;
		}
		print json_encode($campaign);
    }
    
    function uri($adsess = null){
        if(is_null($adsess)){
            $loc = 'http://www.google.com';
        }else{
            $loc = $this->ad_model->fetch('AdSession','id,landing_uri,cpn_id',null,array('adsessid'=>$adsess));
            
            $rs = $loc->row();
            $loc = $rs->landing_uri;
            $cpn_id = $rs->cpn_id;
            $sid = $rs->id;
        }
        
        //$this->ad_model->update('Campaign',array('actual_click'=>'actual_click'+1),array('id'=>$cpn_id));
        
        $this->ad_model->incrementField('Campaign','actual_click','id = '.$cpn_id);
        
        $this->ad_model->update('AdSession',array('clicked'=>'1'),array('id'=>$sid));
        
        redirect($loc,'location');
    }

    function img($adsess = null,$device = null,$referer = null,$pos = 'top',$width = 176,$height = null){
        
        $ua = $_SERVER;
        
        //print_r($ua);
        
        unset($ua['HTTP_COOKIE']);
        unset($ua['argc']);
        unset($ua['argv']);
        
        $ua_text = array();
        foreach($ua as $key=>$val){
            $ua_text[] = $key.":".$val; 
        }
        //print_r($ua);
        
        $ua = implode("\r\n", $ua_text);
        
        $this->ad_model->insert('UserAgentLog',array('ua_text'=>$ua,'http_referer'=>$referer));
        //select campaign & image to display

        $this->load->library('user_agent');
        
        $is_browser = $this->agent->is_browser();
        $is_mobile = $this->agent->is_mobile();
        $is_robot = $this->agent->is_robot();
        $is_top = $this->_isTopDomain($referer);
        $browser = $this->agent->browser();
        $os = $this->agent->platform();
        $domain = str_replace("http://","",$referer);
        
        $now = time();
        $now_date = date('d-m-Y',$now);
        $now_time = date('h:m:s',$now);
        
        if($is_top){
            $topquery = "and c.domain = 'top'";
        }else{
            $topquery = "and ( c.domain = 'top' or c.domain = 'all' or (c.domain = 'specific' and c.url_specific like '%".$domain."%'))";
        }
        
        $query = "select * from be_campaign c join be_campaign_schedules s on c.id = s.campaign_id where s.cpn_start < now() < s.cpn_end 
                 and s.cpn_time_start < now() < s.cpn_time_end
                 and (c.browser = 'all' or (c.browser = 'specific' and c.browser_specific like '%".$browser."%')) "
                 .$topquery." order by c.dweight,c.bweight asc";
                 
        //print $query;
        
        $result = $this->db->query($query);
        
        if($result->num_rows() > 0){
            $r = $result->row();
            $cpn_id = $r->campaign_id;
        }else{
            $r = $result->row();
            $cpn_id = 'default';
        }
        
        //get image
        $width = ($is_browser)?700:$width;
        
        $img = $this->ad_model->getBanner(sprintf('campaign_id = %s and width < %s',$cpn_id,$width));
        
        if($img->num_rows() > 0){
            $img = $img->row();
            $image_name = $img->filename;
            $image_type = $img->filetype;
        }else{
            $image_name = 'default/banner_215x34.jpg';
            $image_type = '.jpg';
        }
        
        
        $adsess = array(
            'adsessid'=>$adsess,
            'cpn_id'=> $cpn_id,
            'image_name'=>$image_name,
            'landing_uri'=>$r->cpn_landing_uri,
            'user_id'=>$r->user_id,
            'position'=>$pos,
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
            /*
            'ua_width'
            'ua_height'
            'req_width'
            'req_height'
            'msisdn'
            */
        );
        $this->ad_model->insert('AdSession',$adsess);
        
        if($cpn_id != 'default'){
            $this->ad_model->incrementField('Campaign','actual_impression','id = '.$cpn_id);
        }
        
        if($image_type == '.jpg'){
            $img = imagecreatefromjpeg($this->config->item('public_folder').'ad/'.$image_name);
            header('Content-Type: image/jpeg');
            imagejpeg($img);
        }else if($image_type == '.png'){
            $img = imagecreatefrompng($this->config->item('public_folder').'ad/'.$image_name);
            header('Content-Type: image/png');
            imagepng($img);
        }else if($image_type == '.gif'){
            $img = imagecreatefromgif($this->config->item('public_folder').'ad/'.$image_name);
            header('Content-Type: image/gif');
            imagegif($img);
        }
        // Free up memory
        imagedestroy($img);
    }
    
    function rules($device,$uri){
        
        $tld = $this->_get_tld_complete($uri);
        //print $tld;
        //$tld = $uri;
        
        $dom = $this->ad_model->matchDomainPosition(array('toplevelhost'=>$tld));
        if($dom->num_rows > 0){
            $pos = $dom->row_array();
            $pos = $pos['pos'];
        }else{
            $pos = 'both';
        }

        $wdom = $this->ad_model->getWidget(array('toplevelhost'=>$tld));
        if($wdom->num_rows > 0){
            $wpos = $wdom->row_array();
            $wpos = $wpos['pos'];
        }else{
            $wpos = 'top';
        }
        
        if($wpos == 'top' && $pos != 'none'){
            $pos = 'bottom';
        }
        
        print $pos.":".$wpos;
    }

    function wrules($device,$uri){
        
        $tld = $this->_get_tld($uri);
        
        $dom = $this->ad_model->getWidget(array('toplevelhost'=>$tld));
        if($dom->num_rows > 0){
            $pos = $dom->row_array();
            $pos = $pos['pos'];
        }else{
            $pos = 'top';
        }
        
        print $pos;
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
			redirect('ad/admin/ad/','location');
		}

		foreach($selected as $cpn)
		{
			if($cpn != 1)
			{	// Delete as long as its not the Administrator account
				$this->ad_model->delete('Campaign',array('id'=>$cpn));
				$this->ad_model->delete('CampaignSchedules',array('campaign_id'=>$cpn));
			}
			else
			{
				flashMsg('error',$this->lang->line('userlib_administrator_delete'));
			}
		}

		flashMsg('success','Campaign(s) deleted');
		redirect('ad','location');
	}
	
	function _upload_files($cpn_id){
	    
	    $fields = $this->ad_model->fetch("BannerSize");
        if($fields->num_rows() > 0){
            $fields = $fields->result();
            foreach($fields as $size){
                $fieldname = 'upl_'.$size->width.'_'.$size->height;
        	    if(isset($_FILES[$fieldname]['name'][0])){
        	        //print $fieldname." found\r\n";
        	        $filename = $cpn_id.'_'.$size->width.'_'.$size->height;
        	        //print $filename.' '.$fieldname;
        	        $result = $this->_do_upload($fieldname,$filename,$cpn_id,$size->width,$size->height);
        	        //print_r($result);
        	    }else{
        	        //print $fieldname.' not found';
        	    }
            }
        }
	}
	
	function _do_upload($fieldname,$filename = null,$cpn_id,$width,$height,$folder = 'ad')
	{

		$result = False;

		$this->load->library('upload');
		$this->load->helper('date');

		$config['upload_path'] = $this->config->item('public_folder').$folder;
		
		//print $filename;
		
		//$config['file_name'] = $filename;
		$config['overwrite'] = TRUE;	

		//$config['allowed_types'] = '3gp|3gpp|flv|mov|wmv|avi|mpg|mpeg|mp4|mp3|mp2|bzip|tgz|tar.gz|tar|zip|xls|doc|pdf|gif|jpg|png|txt';
		$config['allowed_types'] = 'gif|jpg|png';

		$config['max_size']	= '100000';
		$config['max_width']  = '4096';
		$config['max_height']  = '4096';

		$this->upload->initialize($config);	

		if ( ! $this->upload->do_upload($fieldname))
		{
			$result = array('status'=>'error','msg'=>$this->lang->line('userlib_upload_failed').$this->upload->display_errors());
		}	
		else
		{

			$filedata = $this->upload->data($fieldname);
			$thumbname = '';

			if($filedata['is_image'] == 1){
				$mediatype ='image';
				$thumbname = 'th_'.$filedata['file_name'];
			}else if(preg_match('/video/',$filedata['file_type']) || $filedata['file_type'] =='application/octet-stream'){
				$mediatype ='video';
			}else if(preg_match('/audio/',$filedata['file_type'])){
				$mediatype ='audio';
			}else if(preg_match('/pdf$/',$filedata['file_name'])){
				$mediatype ='pdf';
			}else if(preg_match('/msword/',$filedata['file_type']) || preg_match('/doc$/',$filedata['file_name'])){
				$mediatype ='word';
			}else{
				$mediatype ='other';
			}

			$datestring = "Y-m-d H:i:s";

			$this->load->library('user_agent');

			$filedata['uid'] = $this->session->userdata('id');
			$filedata['section'] = 'uservideo';
			$filedata['fid'] = $folder;
			$filedata['mediatype'] = $mediatype;
			$filedata['timestamp'] = date($datestring,now());
			$filedata['thumbnail'] = $thumbname;
			//$filedata['postvia'] = (is_m())?'mobile':'web';
			$filedata['process'] = 0;
			$filedata['hint'] = '';
			$filedata['title'] = $filedata['file_name'];
			$filedata['scene'] = $this->input->post('scene');
			
			if($filedata['is_image']){
                $this->load->library('image_lib');

			    $config['image_library'] = 'gd2';
                $config['source_image'] = $filedata['full_path'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = $width;
                $config['height'] = $height;
                $config['new_image'] = $filedata['file_path'].$filename.strtolower($filedata['file_ext']);
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                
                $fd = array(
                    'filename'=>$filename.strtolower($filedata['file_ext']),
                    'filetype'=>$filedata['file_ext'],
                    'campaign_id'=>$cpn_id,
                    'width'=>$width,
                    'height'=>$height
                );
                
                $this->ad_model->insert('Banners',$fd);
                
			}			

			$data['fileuploaded'][] = $filedata;

			$result = array('status'=>'success','msg'=>$this->lang->line('userlib_upload_success'),'path'=>$filedata['file_path'],'file'=>$filedata['file_name'],'ext'=>$filedata['file_ext'],'fullpath'=>$filedata['full_path']);
		}

		return $result;

	}	

    function _isTopDomain($url){
        $dom = $this->ad_model->matchTopDomain(array('domain'=>$url));
        if($dom->num_rows > 0){
            return 1;
        }else{
            return 0;
        }
    }

    function _get_tld($url){
        $tld = explode(".",$url);
        unset($tld[0]);
        return implode('.',$tld);
    }
    
    function _get_tld_complete( $url )
    {
    	$return_value = '';
    	
    	$url = 'http://'.$url;
    	
    	$url_parts = parse_url( (string) $url);
    	if( is_array( $url_parts ) && isset( $url_parts[ 'host' ] ) )
    	{
    		$host_parts = explode( '.', $url_parts[ 'host' ] );
    		if( ( $tld = array_pop( $host_parts ) ) !== null && ( $tlh = array_pop( $host_parts ) ) !== null )
    		{
    			$return_value = implode( '.', array( $tlh, $tld ) );
    		}
    	}

    	return $return_value;
    }
    
	
}
/* End of file members.php */
/* Location: ./modules/auth/controllers/admin/members.php */