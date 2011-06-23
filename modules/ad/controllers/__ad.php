<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
     /**
      * BackendPro
      *
      * A website backend system for developers for PHP 4.3.2 or newer
      *
      * @package			BackendPro
      * @author				Adam Price
      * @copyright			Copyright (c) 2008
      * @license				http://www.gnu.org/licenses/lgpl.html
      * @tutorial				BackendPro.pkg
      */

      // ---------------------------------------------------------------------------

     /**
      * Ad
      *
      * Ad Platform Main Controller
      *
      * @package		AdPlatform
      * @subpackage		Controllers
      */
 	class Ad extends Public_Controller
 	{
 		/**
 		 * Constructor
 		 */
 		function Ad()
 		{
 			// Call parent constructor
 			parent::Public_Controller();
 			$this->load->model('ad_model','ad');
 			$this->load->module_model('auth','User_model','usermodel');
            $this->load->library('pager');
            $this->load->library('search');
            $this->load->library('upload');
            $this->load->library('preview');
            $this->load->library('CustomEmail');
            $this->load->library('media_lib');
            $this->load->config('pager');
            $this->load->config('ad');
            $this->load->dbutil();
            $this->load->helper('download');
            $this->controller = 'ad';
            $this->section = 'Ad';
            $this->where = null;
            $this->bep_site->set_crumb('Ad Campaign','ad');

 			log_message('debug','Bids Class Initialized');

 		}

         function index()
         {
             // Check if first access to plain index
             $type = ($this->uri->segment(2))?$this->uri->segment(2):"list";
             $page = ($this->uri->segment(3))?$this->uri->segment(3):"0";   
             $count = ($this->uri->segment(4))?$this->uri->segment(4):$this->config->item('records_per_page');
             $orderby = ($this->uri->segment(5))?$this->uri->segment(5):"datecreated";
             $sort = ($this->uri->segment(6))?$this->uri->segment(6):"desc";



             //if this is a plain call to index, then jump to long url format
             /*
             if(!$this->uri->segment(3)){
                 $jump = array(
                     $type,
                     $page,
                     $count,
                     $orderby,
                     $sort
                     );
                 $jump = $this->controller.'/'.implode("/",$jump);
                 redirect($jump,'location');
             }
             */



             $datefield = ($this->uri->segment(7))?$this->uri->segment(7):"none";
             $from = ($this->uri->segment(8))?$this->uri->segment(8):"none";
             $to = ($this->uri->segment(9))?$this->uri->segment(9):"none";
             $searchscope = ($this->uri->segment(10))?$this->uri->segment(10):"all";
             $searchstring = ($this->uri->segment(11))?$this->uri->segment(11):"";

             $fromsearch = $from;
             $tosearch = $to;

             // Display Page

             //start sql acrobats here 
             if($fromsearch != "none"){
                 $this->where.= " ( ".$datefield." >= '".$fromsearch." 00:00:00'";
                 $this->where.= " and ".$datefield." <= '".$tosearch." 23:59:59' )";
             }

             if($searchscope != "none" && $searchstring != ""){
                 if($searchscope == "all"){
                     $scopes = array();
                     foreach($this->config->item('documents_scope_array') as $key=>$val){
                         if($key != "all"){
                             $scopes[] = $key." like '%".$searchstring."%'";
                         }
                     }
                     $scopes = implode(" or ",$scopes);
                     $this->where .= " and ( ".$scopes." )";
                 }else{
                     $this->where.= " and ".$searchscope." like '%".$searchstring."%'";
                 }
             }

             //get total number of result
             $query = $this->ad->fetch('Documents', '*', null , $this->where,array('field'=>$orderby,'dir'=>$sort));            
             $total = $query->num_rows();
             $query->free_result();

             /* === paging options ================ */
             $options['page_total'] = $total;
             $options['page_pos'] = 4;
             $options['page_num'] = $page;
             $options['page_count'] = $count;
             $options['page_order'] = $orderby;
             $options['page_sort'] = $sort;
             $options['page_pad'] = 10;
             $options['page_attrib'] = null;
             $options['page_order_array'] = $this->config->item('documents_sort_array');

             $data['paging'] = $this->pager->createPager($options);
             $data['exportlink'] = $this->pager->createPager($options,true);

             /* === searchbox options ================ */
             /*
             $this->search->initSearchForm();

             $from = explode('-',$from);
             $to = explode('-',$to);
             $doptions['yearfrom'] = $from[0];
             $doptions['monthfrom'] = $from[1];
             $doptions['dayfrom'] = $from[2];
             $doptions['yearto'] = $to[0];
             $doptions['monthto'] = $to[1];
             $doptions['dayto'] = $to[2];

             $doptions['date_label'] = 'When';
             $doptions['labelstyle'] = 'style="font-weight:bold;"';
             $doptions['datefield_name'] = 'datefield';
             $doptions['datefield_array'] = $this->config->item('documents_datefield_array');
             $doptions['datefield_selected'] = $datefield;


             $this->search->addDateRangeForm($doptions);
             */

             $scoptions['scope_name'] = 'searchscope';
             $scoptions['scope_selected'] = $searchscope;
             $scoptions['scope_array'] = $this->config->item('documents_scope_array');
             $scoptions['search_label'] = 'Search by keyword';
             $scoptions['labelstyle'] = 'style="font-weight:bold;"';
             $scoptions['searchvalue_name'] = 'searchkeyword';
             $scoptions['searchvalue'] = $searchstring;
             $scoptions['prev_search'] = false;

             $this->search->addScopeForm($scoptions);
             $this->search->closeSearchForm();

             $data['search'] = $this->search->printSearchForm();
             /* === end searchbox options ================ */

             if(!(($type == 'csv' || $type == 'print') && $page == 'all')){
                 $limit = array('limit' => $count, 'offset' => ($page*$count));
             }else{
                 $limit = null;
             }

             //$fields = 'id,datecreated,filename,mediatype,duration,seconds,ownerid,ownername,thumbnail,title';            
             //$query = $this->ad->fetch('Documents', $fields , $limit , $this->where,array('field'=>$orderby,'dir'=>$sort));            

             $fields = '*,be_users.fullname';    

             $query = $this->ad->getMedia($this->where, $limit,array('field'=>$orderby,'dir'=>$sort));        
             //$query = $this->ad->getMedia('Documents', $fields , $limit , $this->where,array('field'=>$orderby,'dir'=>$sort));            

             foreach($query->result() as $doc){
                 $data['documents'][] = $doc;
             }


             $data['controller'] = $this->controller;

             $data['page_query'] = $this->db->last_query();
             $data['reset_search']=($type == 'result')?anchor('ad','Clear Search'):'';

             $data['header'] = 'Media Library';
             if($type == 'xml'){
                 $config = array (
                                   'root'    => 'root',
                                   'element' => 'element',
                                   'newline' => "\n",
                                   'tab'    => "\t"
                                 );
                 $xmldata = $this->dbutil->xml_from_result($query, $config);
                 $xmldata = explode("\n",$xmldata);

                 $xml_file_name = $this->controller.'_page_'.$page.'_'.date('Ymd',time()).'.xml';

                 if(file_exists($this->config->item('base_path').'tmp/'.$xml_file_name)){
                     unlink($this->config->item('base_path').'tmp/'.$xml_file_name);
                 }

                 $fp = fopen($this->config->item('base_path').'tmp/'.$xml_file_name, 'a');
                 foreach ($xmldata as $line) {
                     fwrite($fp, $line."\r\n");
                 }
                 fclose($fp);

                 clearstatcache();
       	        $filesize = filesize($this->config->item('base_path').'tmp/'.$xml_file_name);


     	        header("Content-type: text/xml");
                 header("Content-disposition: attachment; filename=".$xml_file_name);
                 header("Pragma: no-cache");
       	        $this->_stream_file($this->config->item('base_path').'tmp/'.$xml_file_name);

             }elseif($type == 'csv'){
                 $csvdata = $query->result_array();
                 $rows = array();
                 foreach($csvdata as $csvrow){
                     $r = array();
                     $h = array();
                     foreach($csvrow as $key=>$val){
                         $r[] = '"'.$val.'"';
                         $h[] = '"'.$key.'"';
                     }
                     $csvhead[0] = implode(',',$h);
                     $rows[]= implode(',',$r);
                 }

                 $csvdata = array_merge($csvhead,$rows);

                 $csv_file_name = $this->controller.'_page_'.$page.'_'.date('Ymd',time()).'.csv';

                 if(file_exists($this->config->item('base_path').'tmp/'.$csv_file_name)){
                     unlink($this->config->item('base_path').'tmp/'.$csv_file_name);
                 }

                 $fp = fopen($this->config->item('base_path').'tmp/'.$csv_file_name, 'a');
                 foreach ($csvdata as $line) {
                     fwrite($fp, $line."\r\n");
                 }
                 fclose($fp);

                 clearstatcache();
       	        $filesize = filesize($this->config->item('base_path').'tmp/'.$csv_file_name);


     	        header("Content-type: application/vnd.ms-excel");
                 header("Content-disposition: attachment; filename=".$csv_file_name);
                 header("Pragma: no-cache");
       	        $this->_stream_file($this->config->item('base_path').'tmp/'.$csv_file_name);

             }elseif($type == 'print'){
                 $data['print'] = true;
                 $data['search'] = false;
                 $data['page_query'] = false;
                 $data['reset_search'] = false;
                 $page = $this->config->item('backendpro_template_admin') . "media_list";
                 $this->load->view($page,$data);
             }else{
                 $data['page'] = $this->config->item('backendpro_template_admin') . "media_list";
                 $data['module'] = 'media';
                 $this->load->view($this->_container,$data);
             }
             return;
         }

         function form($id = NULL)
         {
             if(!is_user()){
                 redirect('auth/login','location');
             }
             // VALIDATION FIELDS & RULES

             $datestring = "Y-m-d H:i:s";

             foreach($this->config->item('documents_validation_array') as $key=>$val){
                 $fields[$key] = $val['field'];
                 $rules[$key] = $val['rule'];
             }

             $this->validation->set_fields($fields);

             // SETUP FORM DEFAULT VALUES
             if( !is_null($id) && ! $this->input->post('submit'))
             {
                 // Modify form, first load
                 $query = $this->ad->fetch('Documents', '*' , array('limit' => 1, 'offset' => 0), 'id = '.$id);            
                 $document = $query->row_array();
                 $document['doc_route'] = $this->_getRoutes($id);
                 $document['doc_custody'] = $this->_getCustody($id);
                 $document['doc_keyword'] = $this->_getTags($id,$this->section);

                 $this->validation->set_default_value($document);                
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

                 $data['locations'] = $this->_getLocations();
                 $data['companies'] = $this->_getCompanies();
                 $data['callnumbers'] = $this->_getCallNumbers($this->section);
                 $data['users'] = $this->_getUsers();

                 $this->validation->output_errors();
                 $data['header'] = (is_null($id))?'Create Document':'Edit Document : '.$id;
                 $this->page->set_crumb($data['header'],'documents/form/'.$id);
                 $data['page'] = $this->config->item('backendpro_template_public') . "form_document";
                 $data['module'] = 'documents';
                 $data['controller'] = $this->controller;
                 $this->load->view($this->_container,$data);                 
             }
             else
             {

                 // Save form
                 if( is_null($id))
                 {
                     // CREATE
                     // Fetch form values
                     $data = $this->_getPostData();

                     //pre-condition values
                     $data['doc_date_create'] = date($datestring,now());
                     $data['doc_call_seq'] = str_pad($data['doc_call_seq'], 3, "0", STR_PAD_LEFT);
             		$data['doc_callnumber'] = $data['doc_call_main'].'-'.$data['doc_call_company'].'-'.$data['doc_call_date'].'-'.$data['doc_call_seq'] ; 	

                     //insert value and get new id
                     $this->ad->insert('Documents',$data);
                     $did = $this->db->insert_id();

                     //post-process values
                     $data['doc_keyword'] = trim($data['doc_keyword']);

                     $msg = $this->_processRoute($data['doc_route'],$did);
                     $this->_processCustody($data['doc_custody'],$did);
                     $this->_processKeywords($data['doc_keyword'],$did,$this->section);

                     $uploaded = $this->_do_upload();
                     if($uploaded == false){
                         $data['doc_file_id'] = 'no_file';
                     }else{
                         $data['doc_file_id'] = $uploaded['path'];
                         $data['doc_file_active'] = $uploaded['file'];
                         $msg[] = $uploaded['file'].' uploaded';
                     }

                     unset($data['id']);
                     $this->ad->update('Documents',$data,array('id'=>$did));

                     flashMsg('info',implode("<br />",$msg));
                     redirect($this->controller);
                 }
                 else
                 {
                     // SAVE
                     $data = $this->_getPostData();
                     unset($data['id']);
                     //print_r($data);
                     //print $id;
                     $data['doc_call_seq'] = str_pad($data['doc_call_seq'], 3, "0", STR_PAD_LEFT);
             		$data['doc_callnumber'] = $data['doc_call_main'].'-'.$data['doc_call_company'].'-'.$data['doc_call_date'].'-'.$data['doc_call_seq'] ; 	

                     $this->ad->update('Documents',$data,array('id'=>$id));

                     $msg = $this->_processRoute($data['doc_route'],$id);
                     $this->_processCustody($data['doc_custody'],$id);
                     $this->_processKeywords($data['doc_keyword'],$id,$this->section);
                     /*
                     $docdata['doc_file_id'] = $this->_do_upload();
                     $docdata['doc_file_id'] = ($docdata['doc_file_id'] == False)?'no_file':$docdata['doc_file_id'];
                     */
                     flashMsg('info',implode("<br />",$msg));
                     redirect($this->controller);
                 }
             }         
         }

         function delete($id = null){
             if(is_null($id)){
                 redirect($this->controller);
             }else{
                 //print $id;
                 $this->ad->delete('Documents','id ='.$id);
                 redirect($this->controller);
             }
         }

         function searchUsers(){
             $searchstring = $this->input->post('q');
             $query = $this->ad->searchUser($searchstring);
             if($query->num_rows() > 0){
                 $users = array();
         		foreach ($query->result() as $row)
         	        	{
                     	    $users[] = $row->username."|".$row->id;
         	        	}
         	    $query->free_result();
         	    print implode("\n",$users);
             }else{
                 print "";
             }

         }

         function searchKeywords(){
             $searchstring = $this->input->post('q');
             $query = $this->ad->searchKeywords($searchstring);
             if($query->num_rows() > 0){
                 $tags = array();
         		foreach ($query->result() as $row)
         	        	{
                     	    $tags[] = $row->tag."|".$row->id;
         	        	}
         	    $query->free_result();
         	    print implode("\n",$tags);
             }else{
                 print "";
             }
         }

         function searchFolders(){
             $searchstring = $this->input->post('q');
             $query = $this->ad->searchFolder($searchstring);
             if($query->num_rows() > 0){
                 $folders = array();
         		foreach ($query->result() as $row)
         	        	{
                     	    $folders[] = $row->doc_loc_folder;
         	        	}
         	    $query->free_result();
         	    print implode("\n",$folders);
             }else{
                 print "";
             }
         }



     	function changepic($id){

     	    $this->load->library('validation');

     	    $data['id']=$id;

     	    $fields['doupload'] = $this->lang->line('userlib_scene');
     		$this->validation->set_fields($fields);	    

     	    $rules['doupload'] = 'trim|required';
     		$this->validation->set_rules($rules);

     		$this->bep_site->set_crumb('My Profile','user');
     		$this->bep_site->set_crumb("Change My Picture",'user/changepic');

     	    if ( $this->validation->run() === FALSE )
     		{
     			// Output any errors
     			$this->validation->output_errors();

     			// Display page
                 $user= $this->ad->fetch('Users', '*', null, array('id'=>$uid));
                 $users = $user->row_array();
                 $user= $this->ad->fetch('UserProfiles', '*', null, array('user_id'=>$uid));
                 $data['user'] = array_merge($users,$user->row_array());
                 $data['id'] = $uid;

                 $this->load->module_view('media','admin/uploadpic_overlay',$data);

     		}
     		else
     		{
     			// Submit form
     			$filename = $id;

     			$result = $this->_do_upload_pic($filename,'avatar');

     			$data['picture'] = get_avatar($id,$this->config->item('public_folder').'avatar/');

                 $this->load->module_view('media','admin/uploadpic_success_overlay',$data);
     		}
     	}



         function callseq($callmain = null){
             $query = $this->ad->getCallSeq($this->input->post('callmain'));
     	    $row = $query->row();
     	    $callseq = (int)$row->doc_call_seq;
     	    $callseq = str_pad($callseq+1,3,'0',STR_PAD_LEFT);
     	    $query->free_result();

     	    print "{callseq:'".$callseq."'}";
         }

         function playvideo($id,$uid){
             if($this->config->item('use_lighttpd')){
                 $data['url'] = sprintf($this->config->item('video_host').'%s',$id.'.flv');
             }else{
                 $data['url'] = sprintf(base_url().'public/video/online/%s',$id.'.flv');
             }
             $data['uid'] = $uid;

             $this->load->module_view('media','admin/media_overlay',$data);
         }

         function overlay($uid){

             $user= $this->ad->fetch('Users', '*', null, array('id'=>$uid));
             $data['user'] = $user->row_array();

             $this->load->module_view('media','admin/member_overlay',$data);
         }

         function printbadgevis($uid){

             $user= $this->user_model->fetch('Visitors', '*', null, array('id'=>$uid));
             $users = $user->row_array();
             $data['user'] = $users;
 			$data['user']['picture'] = get_avatar($uid,$this->config->item('public_folder').'avatar/','.jpg','','_vis_sm');
 			//$data['user']['picture'] = get_avatar($data['user']['id'],$this->config->item('public_folder').'avatar/');
             //print $data['user']['picture'];
             //$udata = $this->_qr_data($data);
             $udata = $this->qrdata($data);

 			$data['qrfile'] = $this->_generateQR($data['user']['id'].'_vis_qr.png',$udata);

             $this->load->module_view('media','admin/print_overlay',$data);
         }



         function _qr_data($data){
             $courses[] = ($data['user']['course_1'] > 0)?1:'_';
 			$courses[] = ($data['user']['course_2'] > 0)?2:'_';
 			$courses[] = ($data['user']['course_3'] > 0)?3:'_';
 			$courses[] = ($data['user']['course_4'] > 0)?4:'_';
 			$courses[] = ($data['user']['course_5'] > 0)?5:'_';

 			$courses = implode('-',$courses);

             $udata[] = $data['user']['id'];
             $udata[] = $data['user']['firstname'].' '.$data['user']['lastname'];
             $udata[] = $data['user']['company'];
             $udata[] = $data['user']['conv_id'];
             $udata[] = $data['user']['registrationtype'];
             $udata[] = 'Golf :'.($data['user']['golf'] == 'yes')?'Y':'N';
             $udata[] = 'Gala Dinner :'.($data['user']['galadinner'])?'Y':'N';

             $udata[] = $courses;

             //print_r($udata);
             $udata = implode("\n",$udata);

             return $udata;
         }

         function uploadpicframe($uid){

             $user= $this->ad->fetch('Users', '*', null, array('id'=>$uid));
             $users = $user->row_array();
             $user= $this->ad->fetch('UserProfiles', '*', null, array('user_id'=>$uid));
             $data['user'] = array_merge($users,$user->row_array());
             $data['id'] = $uid;

             $this->load->module_view('media','admin/uploadpic_frame',$data);
         }


         function uploadpic($uid){

             $user= $this->ad->fetch('Users', '*', null, array('id'=>$uid));
             $users = $user->row_array();
             $user= $this->ad->fetch('UserProfiles', '*', null, array('user_id'=>$uid));
             $data['user'] = array_merge($users,$user->row_array());
             $data['id'] = $uid;

             $this->load->module_view('media','admin/uploadpic_overlay',$data);
         }

         function snappic($uid){

             $user= $this->ad->fetch('Users', '*', null, array('id'=>$uid));
             $users = $user->row_array();
             $user= $this->ad->fetch('UserProfiles', '*', null, array('user_id'=>$uid));
             $data['user'] = array_merge($users,$user->row_array());
             $data['id'] = $uid;

             $this->load->module_view('media','admin/snap_overlay',$data);
         }

         function snappicvis($uid){

             $user= $this->user_model->fetch('Visitors', '*', null, array('id'=>$uid));
             $users = $user->row_array();
             $data['user'] = $users;
             $data['id'] = $uid;

             $this->load->module_view('media','admin/snap_overlay_vis',$data);
         }


         function receivephotovis($id){

             $filename = $this->config->item('public_folder').'avatar/'.$id.'_vis.jpg';
             $result = file_put_contents( $filename, file_get_contents('php://input') );
             if (!$result) {
             	print "ERROR: Failed to write data to $filename, check permissions\n";
             	exit();
             }else{
                 $this->load->library('image_lib');

 			    $config['image_library'] = 'gd2';
                 $config['source_image'] = $filename;
                 $config['create_thumb'] = FALSE;
                 $config['maintain_ratio'] = TRUE;
                 $config['width'] = 320;
                 $config['height'] = 240;
                 $config['new_image'] = $this->config->item('public_folder').'avatar/'.$id.'_vis.jpg';

                 $this->image_lib->initialize($config);
                 $this->image_lib->resize();

 			    $config['image_library'] = 'gd2';
                 $config['source_image'] = $this->config->item('public_folder').'avatar/'.$id.'_vis.jpg';
                 $config['maintain_ratio'] = FALSE;
                 $config['width'] = 180;
                 $config['height'] = 240;
                 $config['x_axis'] = (320 - 180) / 2;
                 $config['y_axis'] = 0;

                 $this->image_lib->initialize($config);
                 $this->image_lib->crop();

                 $config['new_image'] = $this->config->item('public_folder').'avatar/'.$id.'_vis_sm.jpg';
                 $config['maintain_ratio'] = FALSE;
                 $config['width'] = 180;
                 $config['height'] = 240;
                 $config['x_axis'] = (320 - 180) / 2;
                 $config['y_axis'] = 0;

                 $this->image_lib->initialize($config);
                 $this->image_lib->crop();

             }

             $url = base_url().'public/avatar/'.$id.'_vis.jpg?'.time();
             print $url;
         }

         function receivephotooff($id){

             $filename = $this->config->item('public_folder').'avatar/'.$id.'_off.jpg';
             $result = file_put_contents( $filename, file_get_contents('php://input') );
             if (!$result) {
             	print "ERROR: Failed to write data to $filename, check permissions\n";
             	exit();
             }else{
                 $this->load->library('image_lib');

 			    $config['image_library'] = 'gd2';
                 $config['source_image'] = $filename;
                 $config['create_thumb'] = FALSE;
                 $config['maintain_ratio'] = TRUE;
                 $config['width'] = 320;
                 $config['height'] = 240;
                 $config['new_image'] = $this->config->item('public_folder').'avatar/'.$id.'_off.jpg';

                 $this->image_lib->initialize($config);
                 $this->image_lib->resize();

 			    $config['image_library'] = 'gd2';
                 $config['source_image'] = $this->config->item('public_folder').'avatar/'.$id.'_off.jpg';
                 $config['maintain_ratio'] = FALSE;
                 $config['width'] = 180;
                 $config['height'] = 240;
                 $config['x_axis'] = (320 - 180) / 2;
                 $config['y_axis'] = 0;

                 $this->image_lib->initialize($config);
                 $this->image_lib->crop();

                 $config['new_image'] = $this->config->item('public_folder').'avatar/'.$id.'_off_sm.jpg';
                 $config['maintain_ratio'] = FALSE;
                 $config['width'] = 180;
                 $config['height'] = 240;
                 $config['x_axis'] = (320 - 180) / 2;
                 $config['y_axis'] = 0;

                 $this->image_lib->initialize($config);
                 $this->image_lib->crop();

             }

             $url = base_url().'public/avatar/'.$id.'_off.jpg?'.time();
             print $url;
         }

         /**
     	 * Delete
     	 *
     	 * Delete the selected users from the system
     	 *
     	 * @access public
     	 */
     	function delusr()
     	{
             $id = $this->input->post('userid');
 			if($id != 1)
 			{	// Delete as long as its not the Administrator account
 				$this->ad->delete('Users',array('id'=>$id));

 				$user= $this->ad->fetch('Users', '*', null, array('id'=>$id));

 				if($user->num_rows() > 0){
     			    $result = array('id'=>$id,'status'=>'ERR','msg'=>'fail to delete user');
 				}else{
     				$this->ad->delete('UserProfiles',array('user_id'=>$id));
     			    $result = array('id'=>$id,'status'=>'OK','msg'=>'User deleted');
 				}
 			}
 			else
 			{
 			    $result = array('id'=>$id,'status'=>'ERR','msg'=>'can not delete Administrator');
 			}

             print json_encode($result);
     	}

         function contactlog($uid){
             $user= $this->ad->fetch('Users', '*', null, array('id'=>$uid));
             $users = $user->row_array();
             $user= $this->ad->fetch('UserProfiles', '*', null, array('user_id'=>$uid));
             $data['user'] = array_merge($users,$user->row_array());
 			//$data['user']['picture'] = get_avatar($data['user']['user_id'],$this->config->item('public_folder').'avatar/','.jpg','','_sm');
 			$data['user']['picture'] = get_avatar($data['user']['user_id'],$this->config->item('public_folder').'avatar/');

 			//print_r($data['user']);
 			/*
 			$udata[] = 'uid:'.$data['user']['id'];
             $udata[] = 'name:'.$data['user']['firstname'].' '.$data['user']['lastname'];
             $udata[] = 'email:'.$data['user']['email'];

             //print_r($udata);
             $udata = implode("\r\n",$udata);
             */
             //$udata = $this->_qr_data($data);
             $udata = $this->qrdata($data);


 			$data['qrfile'] = $this->_generateQR($data['user']['id'].'_qr.png',$udata);

             $this->load->module_view('media','admin/contact_overlay',$data);
         }

         function invoice($uid){
             $user= $this->ad->fetch('Users', '*', null, array('id'=>$uid));
             $users = $user->row_array();
             $user= $this->ad->fetch('UserProfiles', '*', null, array('user_id'=>$uid));
             $data['user'] = array_merge($users,$user->row_array());

             $this->load->module_view('media','admin/invoice_overlay',$data);
         }

         function printinvoice($uid,$tax){
             $user= $this->ad->fetch('Users', '*', null, array('id'=>$uid));
             $users = $user->row_array();
             $user= $this->ad->fetch('UserProfiles', '*', null, array('user_id'=>$uid));
             $data['user'] = array_merge($users,$user->row_array());
             $data['tax'] = ($tax == 'yes')?true:false;

             $this->load->module_view('media','admin/invoice_print',$data);
         }

         function receipt($uid){
             $user= $this->ad->fetch('Users', '*', null, array('id'=>$uid));
             $users = $user->row_array();
             $user= $this->ad->fetch('UserProfiles', '*', null, array('user_id'=>$uid));
             $data['user'] = array_merge($users,$user->row_array());

             $this->load->module_view('media','admin/invoice_overlay',$data);
         }

         function printreceipt($uid,$tax){
             $user= $this->ad->fetch('Users', '*', null, array('id'=>$uid));
             $users = $user->row_array();
             $user= $this->ad->fetch('UserProfiles', '*', null, array('user_id'=>$uid));
             $data['user'] = array_merge($users,$user->row_array());
             $data['tax'] = ($tax == 'yes')?true:false;

             $this->load->module_view('media','admin/invoice_print',$data);
         }


     	function gen($fid = null)
     	{	
             if(!is_null($fid)){
             		$query = $this->myfiles->getFileByFID($fid);
             		$files = $query->result();
             		$file = $files[0];
             /*
             	        clearstatcache();
             	        $filesize = filesize($file->full_path);
             	        $headers = array(
             		        'Pragma: public',
             		        'Expires: 0',
             		        'Cache-Control: must-revalidate, post-check=0, pre-check=0, private',
             		        'Content-Type: '. $file->file_type,
             		        'Content-Length: '. $filesize,
             		        'Content-Disposition: attachment; filename="'.$file->orig_name.'"',
             		        'Content-Transfer-Encoding: binary',
             			);
             			//print_r($headers);
             	      // required for IE, otherwise Content-disposition is ignored
             			$this->_stream_audio($file->full_path,$headers);
             */
                     $data = file_get_contents($file->full_path); // Read the file's contents
                     $name = $file->orig_name;

                     force_download($name, $data);
             }
     	}


     	function dispatch($id)
     	{   
     		$data['doc_loc_warehouse'] = $this->input->post('doc_loc_warehouse');
     		$data['doc_loc_warehouse_box'] = $this->input->post('doc_loc_warehouse_box');
     	    $this->ad->update('Documents',$data,array('id'=>$id));    	    
     	    $res = $this->db->affected_rows(); 	
     	    if($res == 0){
     	        print json_encode(array("result"=>"failed"));
     	    }else{
     	        print json_encode(array("result"=>"ok","warehouse"=>$data['doc_loc_warehouse'],"box"=>$data['doc_loc_warehouse_box']));
     	    }
         }

     	function undispatch($id)
     	{   
     	    $data['doc_loc_warehouse'] = '';
     		$data['doc_loc_warehouse_box'] = '';
     	    $this->ad->update('Documents',$data,array('id'=>$id));   
     	    $res = $this->db->affected_rows(); 	
     	    if($res == 0){
     	        print json_encode(array("result"=>"failed"));
     	    }else{
     	        print json_encode(array("result"=>"ok"));
     	    }
         }



     	function stream($fid = null){
             if(!is_null($fid)){
             		$query = $this->myfiles->getFileByFID($fid);
             		$files = $query->result();
             		$file = $files[0];

             	        clearstatcache();
             	        $filesize = filesize($file->full_path);
             	        $headers = array(
             		        'Pragma: public',
             		        'Expires: 0',
             		        'Cache-Control: must-revalidate, post-check=0, pre-check=0, private',
             		        'Content-Type: '. $file->file_type,
             		        'Content-Length: '. $filesize,
             		        'Content-Disposition: attachment; filename="'.$file->orig_name.'"',
             		        'Content-Transfer-Encoding: binary',
             			);
             			//print_r($headers);
             	      // required for IE, otherwise Content-disposition is ignored
             			$this->_stream_file($file->full_path,$headers);
                     /*
                     $data = file_get_contents($file->full_path); // Read the file's contents
                     $name = $file->orig_name;

                     force_download($name, $data);
                     */
             }
     	}

         function _getCustody($id){
             $query = $this->ad->fetch('Custodian','custodian',null,'doc_id = '.$id);
             if($query->num_rows() > 0){
                 $custodians = $query->result_array();
                 $c = array();
                 foreach($custodians as $co){
                     $c[] = $co['custodian'];
                 }
                 return implode(", ",$c);
             }else{
                 return "";
             }
         }

         function _getRoutes($id){
             $query = $this->ad->fetch('Routes','user_name',null,'doc_id = '.$id);
             if($query->num_rows() > 0){
                 $routes = $query->result_array();
                 $r = array();
                 foreach($routes as $ro){
                     $r[] = $ro['user_name'];
                 }
                 return implode(", ",$r);
             }else{
                 return "";
             }
         }

         function _getActiveFile($folder,$filename){
             $query = $this->ad->fetch('Files','*',null,"fid = '".$folder."' and file_name = '".$filename."'");
             if($query->num_rows() > 0){
                 return $query->row();
             }else{
                 return false;
             }
         }

         function _getFiles($folder){
             $query = $this->ad->fetch('Files','*',null,"fid = '".$folder."'");
             if($query->num_rows() > 0){
                 return $query->result();
             }else{
                 return false;
             }
         }

         function _getPreviews($dir,$previewpath){
             $files = array();
             $dir = $dir.$previewpath;
             if (is_dir($dir)) {
                 if ($dh = opendir($dir)) {
                     while (($file = readdir($dh)) !== false) {
                         if(!($file == "." || $file == "..")){
                             $files[] = $file;
                         }
                     }
                     closedir($dh);
                 }
             }

             if(count($files) > 0){
                 return $files;
             }else{
                 return false;
             }
         }

         function _getTags($id,$section){
             $query = $this->ad->getTags($id,$section);
             if($query->num_rows() > 0){
                 $tags = $query->result_array();
                 $t = array();
                 foreach($tags as $tag){
                     $t[] = $tag['tag'];
                 }
                 return implode(", ",$t);
             }else{
                 return "";
             }
         }

         function _getPostData(){
             foreach($this->config->item('documents_validation_array') as $key=>$val){
                 $data[$key] = $this->input->post($key);
             }

             //return array('post'=>$data,'route'=>$routing_array,'custody'=>$custody_array);
             return $data;
         }

     	function _getLocations(){
             $query = $this->ad->getLocMain();
             $rd = array();
     		foreach ($query->result() as $row)
     	        	{
                 	    $rd[$row->loc_code] = '['.$row->loc_code.'] '.$row->loc_description;
     	        	}
     	    $query->free_result();
     	    return $rd;
     	}

     	function _getCallNumbers($section){
             $query = $this->ad->getCallMain($section);
             $rd = array();
     		foreach ($query->result() as $row)
     	        	{
                 	    $rd[$row->call_code] = '['.$row->call_code.'] '.$row->call_description;
     	        	}
     	    $query->free_result();
     	    return $rd;
     	}

     	function _getCompanies(){
             $query = $this->ad->getCompanies();
             $rd = array();
     		foreach ($query->result() as $row)
     	        	{
                 	    $rd[$row->co_code] = '['.$row->co_code.'] '.$row->co_name;
     	        	}
     	    $query->free_result();
     	    return $rd;
     	}

         function _getCompanyName($id){
             $query = $this->ad->getCompanyName($id);
             $rd = array();
             if ($query->num_rows() > 0){
                 $result = $query->row();
                 $co_name = $result->co_description; 	
             }

     	    $query->free_result();
     	    return $co_name;
         }

     	function _getUsers(){
             $query = $this->ad->getUsers();
     	    return $query;
     	}


     	function _stream_file($source)
     	{
     	    ob_start();
     	    if ($fd = fopen($source, 'rb')) {
     		    if (!ini_get('safe_mode')){
     		        set_time_limit(0);
     		    }
     		    while (!feof($fd)) {
     		        print fread($fd, 1024);
     		        ob_flush();
     		        flush();
     		    }
     		    fclose($fd);
     	    }
     		ob_end_clean();
     	    exit();
     	}

     	function _generateQR($filename,$data){

             $qrdata = array(
                 'd' => $data,
                 'e' => $this->config->item('e'),
                 's' => $this->config->item('s'),
                 'v' => $this->config->item('v'),
                 't' => $this->config->item('t'),
                 'f' => $filename
             );
             qrencode($qrdata);
             return $filename;
     	}

     	function _processRoute($routestring,$did){
     	    $routes = trim(str_replace(array('\n','\r',''),'',$routestring));
     	    $route_array = explode(',',$routes);

     	    //clean up old routes
             $this->ad->delete('Routes','doc_id = '.$did);
             $result = array();
     	    foreach($route_array as $route){
     	        if(trim($route) != ''){
                     $data = array('doc_id'=>$did,'user_name'=>$route);
                     $this->ad->insert('Routes',$data);
                     if($email = $this->_userExist($route)){
                         $subject = 'Cedar Document Update';
                         $message = $this->config->item('cedar_email_message');
                         if($rs = $this->customemail->sendCustomEmail($email,$subject,$message)){
                             $result[] = sprintf('Notification email sent to %s',$email);
                         }
                     }
     	        }
     	    }	    

     	    return $result;
     	}

     	function _processCustody($custodianstring,$did){
     	    $custodian = trim(str_replace(array('\n','\r'),'',$custodianstring));
     	    $custodian_array = explode(',',$custodian);

     	    //clean up old custodians
             $this->ad->delete('Custodian','doc_id = '.$did);

     	    foreach($custodian_array as $custody){
     	        if(trim($custody) != ''){
     	            $data = array('doc_id'=>$did,'custodian'=>$custody);
                     $this->ad->insert('Custodian',$data);
     	        }
     	    }	    
     	}

     	function _processKeywords($keywordstring,$did,$section){
     	    $keywordstring = trim(str_replace(array('\n','\r'),'',$keywordstring));
     	    $keyword_array = explode(',',$keywordstring);

     	    //clean up old keywords
             $this->ad->delete('SectionTags','did = '.$did);

     	    foreach($keyword_array as $keyword){
     	        if(trim($keyword) != ''){
     	            $tag = $this->_keywordCheck($keyword);
     	            $data = array('did'=>$did,'tagid'=>$tag['id'],'section'=>$section);
                     $this->ad->insert('SectionTags',$data);
     	        }
     	    }	    
     	}

     	function _keywordCheck($keyword){
     	    $keyword = strtolower(trim($keyword));
     	    $query = $this->ad->fetch('Tags', 'id,tag', null, array('tag'=>$keyword));
     	    if($query->num_rows() > 0){
     	        $tag = $query->row_array();
     	    }else{
     	        $this->ad->insert('Tags',array('tag'=>$keyword));
     	        $tagid = $this->db->insert_id();
     	        $tag = array('id'=>$tagid,'tag'=>$keyword);
     	    }
 	        return $tag;
     	}

     	function _userExist($username){
             $query = $this->ad->getUsers($username);
             if($query->num_rows() > 0){
                 $row = $query->row();
                 $email = $row->email;
                 $query->free_result();
                 return $email;
             }else{
                 $query->free_result();
         	    return false;
             }
     	}

     	function _do_upload($folder = null)
     	{

     		$result = False;
     		if(is_array($_FILES) && !empty($_FILES)){
     			foreach($_FILES as $key => $value){
     			    if(is_null($folder)){
         				$folder = md5(microtime().mt_rand());
         				$longpath = realpath('./public/storage/');
         				mkdir($longpath.'/'.$folder);
     			    }

     				$config['upload_path'] = './public/storage/'.$folder.'/';
     				$config['allowed_types'] = 'bzip|tgz|tar.gz|tar|zip|xls|doc|pdf|gif|jpg|png|3gp|3gpp|flv|mov|wmv|avi|mpg|mpeg|mp4|mp3|mp2';
     				$config['max_size']	= '10000';
     				$config['max_width']  = '4096';
     				$config['max_height']  = '4096';

     				$this->upload->initialize($config);				

     				if ( ! $this->upload->do_upload($key))
     				{

     					$result = False;
     					//$err .= $this->upload->display_errors();
     					rmdir($longpath.'/'.$folder);				
     				}	
     				else
     				{

     					$filedata = $this->upload->data();
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

     					$filedata['uid'] = $this->session->userdata('id');
     					$filedata['section'] = 'document';
     					$filedata['fid'] = $folder;
     					$filedata['mediatype'] = $mediatype;
     					$filedata['timestamp'] = date($datestring,now());
     					$filedata['thumbnail'] = $thumbname;
     					$filedata['postvia'] = 'web';
     					$filedata['process'] = 0;
     					$filedata['hint'] = '';
     					$filedata['title'] = $filedata['file_name'];
     					$filedata['message'] = $_POST['doc_subject'];										
     					$this->myfiles->insertFile($filedata);

     					// image thumbnailing
     					if($filedata['is_image']){

     						$thumbname = $this->media_lib->createImageThumbnail($filedata);
     						$this->myfiles->updateFile(array('fid'=>$filedata['fid']),array('thumbnail'=>$thumbname));

     					}else if($filedata['mediatype'] == 'audio'){

     						//get embedded image if any
     						//$musicdata = $this->music_lib->getID3tag($filedata['full_path']);

     						if(isset($musicdata)){

         						//print $musicdata['id3v2']['APIC'][0]['data'];
         						if(isset($musicdata['id3v2']['APIC'][0]['data'])){

         							$music_pic = $filedata['file_path'].$filedata['raw_name'].'.jpg';

         							if (!$handle = fopen($music_pic, 'wb')) {
         						         echo "Cannot open file ($music_pic)";
         						    }else{
             						    // Write $somecontent to our opened file.
             						    if (fwrite($handle, $musicdata['id3v2']['APIC'][0]['data']) === FALSE) {
             						        echo "Cannot write to file ($music_pic)";
             						    }

             						    fclose($handle);

             							$thumbraw = 'th_'.$filedata['raw_name'];

             							$thumbname = $this->media_lib->createImageThumbnailFromFile($music_pic,$thumbraw);

             							$this->myfiles->updateFile(array('fid'=>$filedata['fid']),array('thumbnail'=>$thumbname,'music_pic'=>$filedata['raw_name'].'.jpg'));
             							$filedata['music_pic'] = $filedata['raw_name'].'.jpg';
         						    }

         						}else{
         						    $filedata['music_pic'] = '';
         						}
     						}else{
     						    $filedata['music_pic'] = '';
     						}


     					    $converted = $this->media_lib->createAudioThumbnail($filedata);
     						$this->myfiles->updateFile(array('fid'=>$filedata['fid']),array('mp3_file'=>$converted['mp3_file'],'3gp_file'=>$converted['3gp_file']));


     					}else if($filedata['mediatype'] == 'video'){

     					    $converted = $this->media_lib->createVideoThumbnail($filedata);
     						$this->myfiles->updateFile(array('fid'=>$filedata['fid']),array('thumbnail'=>$converted['thumbnail'],'flv_file'=>$converted['flv_file'],'3gp_file'=>$converted['3gp_file']));
     						$filedata['thumbnail'] = $converted['thumbnail'];
     						$filedata['flv_file'] = $converted['flv_file'];
     						$filedata['3gp_file'] = $converted['3gp_file'];
     					}else if($filedata['mediatype'] == 'pdf'){
     					    $input = $filedata['full_path'];
     					    $previewfolder = "preview_".time();
     					    $outdir = $filedata['file_path'].$previewfolder;
     					    mkdir($outdir);
     					    $output = $outdir."/page%d.jpg";

     					    $rs = $this->preview->PDFtoJPEGSeq($input, $output);

     					    $this->myfiles->updateFile(array('fid'=>$filedata['fid']),array('thumbnail'=>$previewfolder));

     					}else if($filedata['mediatype'] == 'word'){

     					}

     					$data['fileuploaded'][] = $filedata;

     					$result = array('path'=>$filedata['fid'],'file'=>$filedata['file_name']);
     				}
     			}
     		}else if(!is_array($_FILES) && !empty($_FILES)){
     			if ( ! $this->upload->do_upload())
     			{
     				$this->uploadstatus[] = $this->upload->display_errors();
     			}	
     			else
     			{

     				$filedata = $this->upload->data();
     				$filedata['uid'] = $this->db_session->userdata('id');
     				$filedata['section'] = 'mymedia';
     				$filedata['fid'] = $folder;
     				$filedata['mediatype'] = 'media';
     				$filedata['timestamp'] = 'now()';
     				$filedata['thumbnail'] = 'thumb';
     				$filedata['postvia'] = 'web';
     				$filedata['process'] = 0;
     				$filedata['hint'] = '';
     				$this->myfiles->insertFile($filedata);
     			}
     		}

     		return $result;

     	}		


     	function _do_upload_pic($filename = null,$folder = null)
     	{

     		$result = False;

     		$this->load->library('upload');
     		$this->load->helper('date');

     		$folder = (is_null($folder))?'video/source/':$folder.'/';

     		$config['upload_path'] = $this->config->item('public_folder').$folder;
     		//$config['file_name'] = $filename;
     		$config['overwrite'] = TRUE;	
     		if($folder == 'avatar/'){
         		$config['allowed_types'] = 'jpg|png|gif';
     		}else{
         		$config['allowed_types'] = '3gp|3gpp|flv|mov|wmv|avi|mpg|mpeg|mp4|mp3|mp2|bzip|tgz|tar.gz|tar|zip|xls|doc|pdf|gif|jpg|png|txt';
     		}	
     		$config['max_size']	= '100000';
     		$config['max_width']  = '4096';
     		$config['max_height']  = '4096';

     		$this->upload->initialize($config);	

     		if ( ! $this->upload->do_upload('videofile'))
     		{
     			$result = array('status'=>'error','msg'=>$this->lang->line('userlib_upload_failed').$this->upload->display_errors());
     		}	
     		else
     		{

     			$filedata = $this->upload->data('videofile');
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
     			$filedata['postvia'] = (is_m())?'mobile':'web';
     			$filedata['process'] = 0;
     			$filedata['hint'] = '';
     			$filedata['title'] = $filedata['file_name'];
     			$filedata['scene'] = $this->input->post('scene');

     			$platform = (is_m())?$this->agent->platform().' on '.$this->agent->mobile():$this->agent->platform();
     			$filedata['useragent'] = $this->agent->agent_string().' platform : '.$platform;

     /*			
     			$this->myfiles->deleteFile(array('uid'=>$this->session->userdata('id'),'scene'=>$this->input->post('scene')));
     			$this->myfiles->registerFile($filedata);
     */			

     			if($filedata['is_image']){
                     $this->load->library('image_lib');

     			    $config['image_library'] = 'gd2';
                     $config['source_image'] = $filedata['full_path'];
                     $config['create_thumb'] = FALSE;
                     $config['maintain_ratio'] = TRUE;
                     $config['width'] = 195;
                     $config['height'] = 250;
                     $config['new_image'] = $filedata['file_path'].$filename.strtolower($filedata['file_ext']);

                     $this->image_lib->initialize($config);
                     $this->image_lib->resize();

                     $config['new_image'] = $filedata['file_path'].$filename.'_sm'.strtolower($filedata['file_ext']);
                     $config['maintain_ratio'] = FALSE;
                     $config['width'] = 70;
                     $config['height'] = 70;

                     $this->image_lib->initialize($config);
                     $this->image_lib->resize();

     			}			

     			if($filedata['mediatype'] == 'video'){
     			    $this->load->library('media_lib');

     			    $videoinfo = $this->media_lib->getVideoInfo($filedata['full_path']);

     			    //print_r($videoinfo);

     			    $converted = $this->media_lib->createVideoThumbnail($filedata);
     				$this->myfiles->updateFile(array('fid'=>$filedata['fid'],'duration'=>$videoinfo['duration'],'seconds'=>$videoinfo['seconds'],'thumbnail'=>$converted['thumbnail'],'flv_file'=>$converted['flv_file'],'3gp_file'=>$converted['3gp_file']),array('raw_name'=>$filedata['raw_name']));

     				//print $this->db->last_query();
     				/*
     				if(file_exists($filedata['file_path'].$filedata['raw_name'].'.flv')){
     				    @unlink($this->config->item('public_folder').'video/online/'.$filedata['raw_name'].'.flv');
     				    copy($filedata['file_path'].$filedata['raw_name'].'.flv',$this->config->item('public_folder').'video/online/'.$filedata['raw_name'].'.flv');
     				}
     				*/

     				if(file_exists($filedata['file_path'].$filedata['raw_name'].'.jpg')){
     				    copy($filedata['file_path'].$filedata['raw_name'].'.jpg',$this->config->item('public_folder').'video/thumb/'.$filedata['raw_name'].'.jpg');
     				}

     				if(file_exists($filedata['file_path'].'th_'.$filedata['raw_name'].'.jpg')){
     				    copy($filedata['file_path'].'th_'.$filedata['raw_name'].'.jpg',$this->config->item('public_folder').'video/thumb/th_'.$filedata['raw_name'].'.jpg');
     				}

     				$filedata['duration'] = $videoinfo['duration'];
     				$filedata['seconds'] = $videoinfo['seconds'];
     				$filedata['thumbnail'] = $converted['thumbnail'];
     				$filedata['flv_file'] = $converted['flv_file'];
     				$filedata['3gp_file'] = $converted['3gp_file'];
     			}
     			$data['fileuploaded'][] = $filedata;

     			$result = array('status'=>'success','msg'=>$this->lang->line('userlib_upload_success'),'path'=>$filedata['fid'],'file'=>$filedata['file_name'],'ext'=>$filedata['file_ext'],'fullpath'=>$filedata['full_path']);
     		}

     		return $result;

     	}	

         function qrdata($data){

     		//$CI =& get_instance();

             $courses[] = ($data['user']['course_1'] > 0)?1:'';
     		$courses[] = ($data['user']['course_2'] > 0)?2:'';
     		$courses[] = ($data['user']['course_3'] > 0)?3:'';
     		$courses[] = ($data['user']['course_4'] > 0)?4:'';
     		$courses[] = ($data['user']['course_5'] > 0)?5:'';

     		$courses = implode('',$courses);

     		//print $data['user']['golf'];
     		$info = array();

     		$info[] = ($data['user']['judge'] > 0)?'JD':'';
     		$info[] = ($data['user']['golf'] > 0)?'GF':'';
     		$info[] = ($data['user']['galadinner'] > 0)?'GD':'';
     		$info[] = ($data['user']['foc'] > 0)?'FoC':'';
     		$info[] = ($data['user']['media'] > 0)?'M':'';
     		$info[] = ($data['user']['exhibitor'] > 0)?'Ex':'';

     		$info = implode(' ',$info);

             $udata[] = $data['user']['id'];
             $udata[] = $data['user']['firstname'].' '.$data['user']['lastname'];
             $udata[] = substr(addslashes(str_replace(array('(',')','*','\'','"'),' ',$data['user']['company'])),0,54);
             $udata[] = $data['user']['conv_id'];
             $udata[] = $data['user']['registrationtype'];

             $udata[] = 'C:'.$courses;
             $udata[] = 'A:'.$info;
             /*
             $udata[] = 'Golf : '.$golf;
             $udata[] = 'Gala Dinner : '.$galadinner;
             $udata[] = 'Exhibitor : '.$exhibitor;
             $udata[] = 'Media : '.$media;
             $udata[] = 'FoC : '.$foc;
             */

             //print_r($udata);
             $udata = implode("\n",$udata);
             return $udata;
         }


 	}
 ?>