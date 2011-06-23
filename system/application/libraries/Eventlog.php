<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Eventlog {

	/*
	* constructor
	*
	*/
	function Eventlog(){

		$this->CI=& get_instance();
		
		$this->CI->load->model('eventlogmodel');
		
	}
	
	function logEvent($event,$data){
	    $datestring = "Y-m-d H:i:s";	    
	    $eventdata = array(
	            'eventtime'=>date($datestring,now()),
	            'event'=>$event,
	            'eventdata'=>$data
	        );
        $id = $this->CI->eventlogmodel->insertEvent($eventdata);
        return $id;
    }

	function outbox($data){
        $id = $this->CI->eventlogmodel->insertOutbox($data);
        return $id;
    }

	
}

?>