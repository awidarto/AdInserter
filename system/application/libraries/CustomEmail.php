<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CustomEmail {

	/*
	* constructor
	*
	*/
	function CustomEmail(){

		$this->CI=&get_instance();
		$this->CI->load->library('email');
	}
	
    function sendCustomEmail($email_to,$subject,$message,$attachment = false){
	    $this->CI->email->from($this->CI->config->item('cedar_email_from'), $this->CI->config->item('cedar_email_name_from'));

        $this->CI->email->to($email_to);

        $this->CI->email->subject($subject);
        
        $this->CI->email->message($message);
        
        if($attachment){
            foreach($attachment as $tf){
                $this->CI->email->attach($tf);
            }
        }
        
        if (!$this->CI->email->send())
            return false;
        else
            return true;
        
    }	
	
}

?>