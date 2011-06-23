<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Custom_Qr {

	/*
	* constructor
	*
	*/
	function Custom_Qr(){

		$this->CI=&get_instance();
		//$this->CI->load->helper('qr');
	}
	
	function generateQRcode($filename,$udata){
        $qrdata = array(
            'd' => $data,
            'e' => 'Q',
            's' => 8,
            'v' => 8,
            't' => 'P',
            'f' => $filename
        );
        qrencode($qrdata);
        return $filename;
	}
	
}

?>