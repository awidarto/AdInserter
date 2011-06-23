<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Preview {

	/*
	* constructor
	*
	*/
	function Preview(){

		$this->CI=& get_instance();
		$this->CI->load->library('Eventlog');
		$this->CI->load->config('preview');
		
	}
	
	
    function PDFtoJPEGSeq($input, $output){
        $cmd = sprintf($this->CI->config->item('ghostscript_binary').$this->CI->config->item('pdf2jpeg_cmd'),$output,$input);
        
        //$result = $cmd;
        $result = shell_exec(escapeshellcmd($cmd));
        
        $this->CI->eventlog->logEvent('encodeimageto3gp',$cmd." : ".$result);
        return $result;
        
    }

}

?>