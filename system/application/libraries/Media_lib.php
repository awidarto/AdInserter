<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Media_lib {

	/*
	* constructor
	*
	*/
	function Media_lib(){

		$this->CI=& get_instance();
		$this->CI->load->library('Eventlog');
		
	}
	
	
	/**
	 * Dynamically outputs an image
	 *
	 * @access	public
	 * @param	resource
	 * @return	void
	 */
    function displayImageFile($file, $width = 400 )
    {
		$swidth = $file->image_width;
		$sheight = $file->image_height;
		
		if($sheight == 0){
			$twidth = $width;
			$theight = $height;
		}else if($width <= $swidth){
			$twidth = $width;
			$theight = ($sheight / $swidth) * $width;
		}else{
			$twidth = $swidth;
			$theight = $sheight;
		}
		
		
		
		
		switch ($file->image_type)
		{
			case 'gif' 		:	$src = imagecreatefromgif($file->full_path);
				break;
			case 'jpeg'		:	$src = imagecreatefromjpeg($file->full_path);
				break;
			case 'png'		:	$src = imagecreatefrompng($file->full_path);
				break;
			default		:	print 'Unable to display the image';
				break;		
		}
		
		$template = imagecreatetruecolor($twidth, $theight);
		imagecopyresampled($template, $src, 0, 0, 0, 0, $twidth, $theight, $swidth, $sheight);
	
		header("Content-Disposition: filename={$file->file_name};");
		header("Content-Type: {$file->file_type}");
		header('Content-Transfer-Encoding: binary');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');

		switch ($file->image_type)
		{
			case 'gif' 		:	imagegif($template);
				break;
			case 'jpeg'		:	imagejpeg($template, '', 100);
				break;
			case 'png'		:	imagepng($template);
				break;
			default		:	echo 'Unable to display the image';
				break;		
		}
		imagedestroy($template);
    }
    
    function displayImageUrl($url, $type='png' )
    {
		
		switch ($type)
		{
			case 'gif' 		:	$src = imagecreatefromgif($url);
                                $file_name = 'map.gif';
			                    $file_type = 'image/gif';
				break;
			case 'jpeg'		:	$src = imagecreatefromjpeg($url);
                                $file_name = 'map.jpg';
                                $file_type = 'image/jpeg';
				break;
			case 'png'		:	$src = imagecreatefrompng($url);
                                $file_name = 'map.png';
                                $file_type = 'image/png';
				break;
			default		:	print 'Unable to display the image';
				break;		
		}
	
		header("Content-Disposition: filename={$file_name};");
		header("Content-Type: {$file_type}");
		header('Content-Transfer-Encoding: binary');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');

		switch ($type)
		{
			case 'gif' 		:	imagegif($src);
				break;
			case 'jpeg'		:	imagejpeg($src, '', 100);
				break;
			case 'png'		:	imagepng($src);
				break;
			default		:	echo 'Unable to display the image';
				break;		
		}
		imagedestroy($src);
    }
    
    
    
    	/**
    	 * Generate from audio, 3gp files ( for mobile ) and mp3 ( for web )
    	 *
    	 * @access	public
    	 * @param	resource
    	 * @return	void
    	 */
        function createAudioThumbnail($file, $thumbfilename = NULL, $width = 75 )
        {
    		$file = (is_array($file))?$this->_createFileObject($file):$file;

    		$thumbfilename = ($thumbfilename == NULL)?$file->raw_name:$thumbfilename;

    		set_time_limit (0);
        	
            if( preg_match("/mp3/",$file->file_name) || $file->file_type == 'audio/mpeg' || $file->file_type == 'audio/x-mpeg'){
    		    $converted['mp3_file'] = $file->file_name;
            }else{
            	$in = $file->full_path;
            	$out = $file->file_path.$file->raw_name.".mp3";
        		system(escapeshellcmd($this->CI->config->item('ffmpeg_location')." -y -i ".$in." -f mp3 -acodec mp3 -ac 2 -ab 64k -ar 22050 ".$out),$retval);
        		$converted['mp3_file'] = $file->raw_name.".mp3";
            }

        	/*create and hint 3gp*/
        	$in = $file->full_path;
        	$out = $file->file_path.$file->raw_name.".3gp";
            system(escapeshellcmd($this->CI->config->item('ffmpeg_location')." -y -i ".$in." -f 3gp -vn -ac 1 -ab 12.2k -ar 8000 -acodec ".$this->CI->config->item('ffmpeg_amr_codec')." ".$out),$retval);
//            system(escapeshellcmd('sudo /bin/chmod 777 '.$out));
//            $retval = shell_exec(escapeshellcmd("sudo /usr/local/bin/MP4Box -hint ".$out));
            $converted['3gp_file'] = $file->raw_name.".3gp";
                
            return $converted;

    	}
    

	/**
	 * Generate image thumbnail from video, also create 3gp files ( for mobile ) and flv ( for web )
	 *
	 * @access	public
	 * @param	resource
	 * @return	void
	 */
    function createVideoThumbnail($file, $thumbfilename = NULL, $width = 75,$text = '' )
    {
		$file = (is_array($file))?$this->_createFileObject($file):$file;
		
		$thumbfilename = ($thumbfilename == NULL)?$file->raw_name:$thumbfilename;
		
		set_time_limit (0);
		
		
        $thumbfile = $thumbfilename.".jpg";
        $seek = $this->CI->config->item('ffmpeg_thumbnail_seek');
        $cmd = $this->CI->config->item('ffmpeg_location')." -y -i ".$file->full_path." -an -y -f mjpeg -ss ".$seek." -vframes 1 ".$file->file_path.$thumbfile;
    	system(escapeshellcmd($cmd),$retval);
		
		$text = ($file->scene == '')?'':'Scene '.$file->scene;
		$converted['thumbnail'] = $this->createImageThumbnailFromFile($file->file_path.$thumbfile, NULL, $width = 75,$text );
		
    	$in = $file->full_path;
    	//$out = $file->file_path.$file->raw_name.".flv";
    	$out = $this->CI->config->item('public_folder').'video/online/'.$file->raw_name.".flv";
    	$this->encodeToFLV($in,$out);
		$converted['flv_file'] = $file->raw_name.".flv";

		
/*        
        
		if($file->file_type == 'video/x-flv'){
		    $converted['flv_file'] = $file->file_name;
        }else{
        	$in = $file->full_path;
        	//$out = $file->file_path.$file->raw_name.".flv";
        	$out = $this->CI->config->item('public_folder').'video/online/'.$file->raw_name.".flv";
        	$this->encodeToFLV($in,$out);
    		$converted['flv_file'] = $file->raw_name.".flv";
        }

    	//create and hint 3gp

        if($file->file_type == 'video/3gpp'){
            $converted['3gp_file'] = $file->file_name;
            system(escapeshellcmd('sudo /bin/chmod 777 '.$out));
    		$retval = shell_exec(escapeshellcmd("sudo /usr/local/bin/MP4Box -hint ".$out));
        }else{
        	$in = $file->full_path;
        	$out = $file->file_path.$file->raw_name.".3gp";
        	if($node->media_upload_file->filemime == 'video/mp4'){
        		$retval = shell_exec(escapeshellcmd("sudo /usr/local/bin/MP4Box -3gp -hint ".$in." -out ".$out));
        		system(escapeshellcmd('sudo /bin/chmod 777 '.$out));
        	}else{
              this one specifics for server
        		system(escapeshellcmd("/usr/local/bin/ffmpeg -y -i ".$in." -f 3gp -vcodec h263 -ac 1 -ab 12.2k -ar 8000 -s 352x288 -acodec libamr_nb ".$out),$retval);
        		system(escapeshellcmd($this->CI->config->item('ffmpeg_location')." -y -i ".$in." -f 3gp -vcodec h263 -ac 1 -ab 12.2k -ar 8000 -s 352x288 -acodec ".$this->CI->config->item('ffmpeg_amr_codec')." ".$out),$retval);
              system(escapeshellcmd('sudo /bin/chmod 777 '.$out));
        		$retval = shell_exec(escapeshellcmd("sudo /usr/local/bin/MP4Box -hint ".$out));
        	}
            $converted['3gp_file'] = $file->raw_name.".3gp";
        }
        
*/
        $converted['3gp_file'] = $file->raw_name.".3gp";

        return $converted;
		
	}




	/**
	 * Dynamically outputs an image
	 *
	 * @access	public
	 * @param	resource
	 * @return	void
	 */
    function createImageThumbnail($file, $thumbfilename = NULL, $width = 75 )
    {
		$file = (is_array($file))?$this->_createFileObject($file):$file;
		
		
		$swidth = $file->image_width;
		$sheight = $file->image_height;
		$thumbfilename = ($thumbfilename == NULL)?'th_'.$file->raw_name:$thumbfilename;		
		
		if($swidth <= $sheight){
    		$twidth = $width;
    		$theight = ($sheight / $swidth) * $width;
		}else{
    		$theight = $width;
    		$twidth = ( $swidth / $sheight) * $width;
		}
		
				
		switch ($file->image_type)
		{
			case 'gif' 		:	$src = imagecreatefromgif($file->full_path);
				break;
			case 'jpeg'		:	$src = imagecreatefromjpeg($file->full_path);
				break;
			case 'png'		:	$src = imagecreatefrompng($file->full_path);
				break;
			default		:	print 'Unable to display the image';
				break;		
		}
		
		$template = imagecreatetruecolor($twidth, $theight);
		imagecopyresampled($template, $src, 0, 0, 0, 0, $twidth, $theight, $swidth, $sheight);
		
		$thumbtemplate = imagecreatetruecolor($width, $width);
		imagecopyresampled($thumbtemplate, $template, 0, 0, 0, 0, $twidth, $theight, $twidth, $theight);		
		
		$filethumbfullpath = $file->file_path.$thumbfilename.$file->file_ext;
		
		switch ($file->image_type)
		{
			case 'gif' 		:	imagegif($thumbtemplate,$filethumbfullpath);
				break;
			case 'jpeg'		:	imagejpeg($thumbtemplate, $filethumbfullpath, 100);
				break;
			case 'png'		:	imagepng($thumbtemplate,$filethumbfullpath);
				break;
			default		:	echo 'Unable to display the image';
				break;		
		}
		
		imagedestroy($template);
		imagedestroy($thumbtemplate);
		
		return $thumbfilename.$file->file_ext;
		
    }


	/**
	 * Dynamically outputs an image
	 *
	 * @access	public
	 * @param	resource
	 * @return	void
	 */
    function createImageThumbnailFromFile($filename, $thumbfilename = NULL, $width = 75,$text = '' )
    {
		
		$file = getimagesize($filename);
		
		$path_parts = pathinfo($filename);
		$file_path = $path_parts['dirname'].'/';
		$extension = '.'.$path_parts['extension'];
		$basename = trim(str_replace($extension,'',$path_parts['basename']));
		
		$swidth = $file[0];
		$sheight = $file[1];
		$thumbfilename = ($thumbfilename == NULL)?'th_'.$basename:$thumbfilename;
		
		if(preg_match("/jpeg/",$file['mime'])) $image_type = 'jpeg';
		if(preg_match("/gif/",$file['mime'])) $image_type = 'gif';
		if(preg_match("/png/",$file['mime'])) $image_type = 'png';			

		if($swidth <= $sheight){
    		$twidth = $width;
    		$theight = ($sheight / $swidth) * $width;
		}else{
    		$theight = $width;
    		$twidth = ( $swidth / $sheight) * $width;
		}
		
		
		switch ($image_type)
		{
			case 'gif' 		:	$src = imagecreatefromgif($filename);
				break;
			case 'jpeg'		:	$src = imagecreatefromjpeg($filename);
				break;
			case 'png'		:	$src = imagecreatefrompng($filename);
				break;
			default		:	print 'Unable to display the image';
				break;		
		}

		$template = imagecreatetruecolor($twidth, $theight);
		imagecopyresampled($template, $src, 0, 0, 0, 0, $twidth, $theight, $swidth, $sheight);

		$thumbtemplate = imagecreatetruecolor($width, $width);
		imagecopyresampled($thumbtemplate, $template, 0, 0, 0, 0, $twidth, $theight, $twidth, $theight);	
		if($text != ''){
		    $textcolor = ImageColorAllocate ($thumbtemplate, 255, 255, 220); 
		    imagestring($thumbtemplate, 2, 5, $theight-5 , $text, $textcolor);
		}

		$filethumbfullpath = $file_path.$thumbfilename.$extension;

		switch ($image_type)
		{
			case 'gif' 		:	imagegif($thumbtemplate,$filethumbfullpath);
				break;
			case 'jpeg'		:	imagejpeg($thumbtemplate, $filethumbfullpath, 100);
				break;
			case 'png'		:	imagepng($thumbtemplate,$filethumbfullpath);
				break;
			default		:	echo 'Unable to display the image';
				break;		
		}

		imagedestroy($template);
		imagedestroy($thumbtemplate);

		return $thumbfilename.$extension;

    }
    
    function composeOver($filename,$width,$height,$color = 'white'){
        $template = imagecreatetruecolor($width, $height);
        
        if($color == 'white'){
            $color = imagecolorallocate($template, 255, 255, 255);
        }else{
            $color = imagecolorallocate($template, 0, 0, 0);
        }
        imagefill($template, 0, 0, $color);
        
        $file = getimagesize($filename);
		
		if(preg_match("/jpeg/",$file['mime'])) $image_type = 'jpeg';
		if(preg_match("/gif/",$file['mime'])) $image_type = 'gif';
		if(preg_match("/png/",$file['mime'])) $image_type = 'png';			
		
		switch ($image_type)
		{
			case 'gif' 		:	$src = imagecreatefromgif($filename);
				break;
			case 'jpeg'		:	$src = imagecreatefromjpeg($filename);
				break;
			case 'png'		:	$src = imagecreatefrompng($filename);
				break;
			default		:	print 'Unable to display the image';
				break;		
		}
		
		$src_width = $file[0];
		$src_height = $file[1];
        
        if($src_width > $width){
            $dst_x = 0;
            $src_x = 0;
        }else if($src_width < $width){
            $dst_x = abs(($width/2)-($src_width/2));
            $src_x = 0;
        }else{
            $dst_x = 0;
            $src_x = 0;
        }

        if($src_height > $height){
            $dst_y = 0;
            $src_y = 0;
        }else if($src_height < $height){
            $dst_y = abs(($height/2)-($src_height/2));
            $src_y = 0;
        }else{
            $dst_y = 0;
            $src_y = 0;
        }
        
        $src_w = $src_width;
        $src_h = $src_height;		

		imagecopymerge($template,$src,$dst_x,$dst_y,$src_x,$src_y,$src_w,$src_h,100);
		
		switch ($image_type)
		{
			case 'gif' 		:	imagegif($template,$filename);
				break;
			case 'jpeg'		:	imagejpeg($template, $filename, 100);
				break;
			case 'png'		:	imagepng($template,$filename);
				break;
			default		:	echo 'Unable to display the image';
				break;		
		}

		imagedestroy($template);
		imagedestroy($src);
		
		return true;
        
    }

    function prepParameters($vpro,$jpeg = false){

        $param = array();
        
        //$param[] = (isset($vpro['ad']) && $vpro['ad'] != "")?"-itsoffset ".$this->_prepDelay($vpro['ad']):"";
        $param[] = (isset($vpro['ad']) && $vpro['ad'] != "")?"-itsoffset ".$vpro['ad']:"";
        $param[] = (isset($vpro['au']) && $vpro['au'] != "")?"-i ".$vpro['au']:"";

        if($jpeg){
            $param[] = (isset($vpro['md']) && $vpro['md'] != "")?"-vframes ".($vpro['md']*$vpro['frame_rate']):"";
        }
        
        $param[] = (isset($vpro['gop']) && $vpro['gop'] != "")?"-g ".$vpro['gop']:"";
        $param[] = (isset($vpro['max_rate']) && $vpro['max_rate'] != "")?"-maxrate ".$vpro['max_rate']:"";
        $param[] = (isset($vpro['min_rate']) && $vpro['min_rate'] != "")?"-minrate ".$vpro['min_rate']:"";
        $param[] = (isset($vpro['buffer_size']) && $vpro['buffer_size'] != "")?"-bufsize ".$vpro['buffer_size']:"";
        $param[] = (isset($vpro['bit_rate']) && $vpro['bit_rate'] != "")?"-b ".$vpro['bit_rate']:"";
        $param[] = (isset($vpro['frame_rate']) && $vpro['frame_rate'] != "")?"-r ".$vpro['frame_rate']:"";
        if(!$jpeg){
            $param[] = (isset($vpro['audio_bit_rate']) && $vpro['audio_bit_rate'] != "")?"-ab ".$vpro['audio_bit_rate']:"";
        }
        
        //-i %s -g 100 -s qcif -r 8 -b 45k -maxrate 45k -minrate 45k -bufsize 135k -vcodec h263 -ab 12.2k -ac 1 -acodec %s -ar 8000 -f 3gp %s
        //-i %s -s qcif %s -vcodec h263 -ac 1 -acodec %s -ar 8000 -f 3gp %s

        // -loop_input -y -i %s %s -vframes 720 -s qcif -vcodec h263 -f 3gp %s
        // -maxrate 50k -minrate 50k -bufsize 150k -r 8 -b 50k -g 160 
        return implode(" ",$param);
    }

    function hint3gp($src){
        $result = shell_exec(escapeshellcmd(sprintf($this->CI->preference->item('nano_GCMS_mp4creator_location').' '.$this->CI->preference->item('nano_GCMS_mp4creator_command'),$src)));
        $this->CI->eventlog->logEvent('hint3gp',$src." : ".$result);
        return $result;
    }
    

    function encodeToAmr($src,$dest){

        //ffmpeg -i audioin.mp3 -acodec amr_nb -ar 8000 -ac 1 -ab 32 audioout.amr 
        
        $cmd = sprintf($this->CI->preference->item('nano_GCMS_ffmpeg_location').' '.$this->CI->preference->item('nano_GCMS_ffmpeg_audio_amr_command'),$src,$this->CI->preference->item('nano_GCMS_ffmpeg_audio_codec'),$dest);
        $result = shell_exec(escapeshellcmd($cmd));
        $this->CI->eventlog->logEvent('encodetoAmr',$cmd." : ".$result);
        
        return $result;
    }

    function encodeTo3gp($src,$dest,$encprofile){
        // -i %s -g 100 -s qcif -r 8 -b 45k -maxrate 45k -minrate 45k -bufsize 135k -vcodec h263 -ab 12.2k -ac 1 -acodec %s -ar 8000 -f 3gp %s
        
        $cmd = sprintf($this->CI->preference->item('nano_GCMS_ffmpeg_location').' '.$this->CI->preference->item('nano_GCMS_ffmpeg_movie_3gp_command'),$src,$encprofile,$this->CI->preference->item('nano_GCMS_ffmpeg_audio_codec'),$dest);
        //print $cmd;
        //$result = $cmd;
        
        
        $result = shell_exec(escapeshellcmd($cmd));
        

        $this->CI->eventlog->logEvent('encodeto3gp',$cmd." : ".$result);
        
        return $result;
    }

    function encodeToFLV($src,$dest){
        $cmd = sprintf($this->CI->preference->item('nano_GCMS_ffmpeg_location').' '.$this->CI->preference->item('nano_GCMS_ffmpeg_movie_flv_command'),$src,$dest);
        $result = shell_exec(escapeshellcmd($cmd));
        $this->CI->eventlog->logEvent('encodetoFLV',$cmd." : ".$result);
        return $result;
    }

    function makeThumbnail($src,$dest){
        $cmd = sprintf($this->CI->preference->item('nano_GCMS_ffmpeg_location').' '.$this->CI->preference->item('nano_GCMS_ffmpeg_movie_thumb_command'),$src,$dest);
        $result = shell_exec(escapeshellcmd($cmd));
        $this->CI->eventlog->logEvent('makeThumbnail',$cmd." : ".$result);
        return $result;
    }

    
    function encodeImageTo3gp($src,$dest,$encprofile){
        // -loop_input -y -i %s -vframes 720 -g 160 -s qcif -r 8 -b 50k -maxrate 50k -minrate 50k -bufsize 150k -vcodec h263 -f 3gp %s

        $cmd = sprintf($this->CI->preference->item('nano_GCMS_ffmpeg_location').' '.$this->CI->preference->item('nano_GCMS_ffmpeg_jpeg_3gp_command'),$src,$encprofile,$dest);
        
        //$result = $cmd;
        $result = shell_exec(escapeshellcmd($cmd));
        
        $this->CI->eventlog->logEvent('encodeimageto3gp',$cmd." : ".$result);
        return $result;
    }
    
    function mergeVideos($src1,$src2,$result){

        $cmd = sprintf($this->CI->preference->item('mp4box_location').' '.$this->CI->preference->item('mp4box_mergevideo_command'),$src1,$src2,basename($result));
        
    	$rdir = getcwd();
    	chdir(dirname($result));
        $result = shell_exec(escapeshellcmd($cmd));
        
    	chdir($rdir);

        $this->CI->eventlog->logEvent('mergevideo',$cmd." : ".$result);
        
        return $result;
    }
    
    
    function getVideoEncodingProfile($where = null){
        $this->CI->load->module_model('portal','videotypemodel');
        
        if(is_null($where)){
            $vtquery = $this->CI->videotypemodel->getVideoTypes();
            if($vtquery->num_rows() > 0){
                $result = $vtquery->result_array();
            }else{
                $result = false;
            }
        }else{
            $vtquery = $this->CI->videotypemodel->getVideoTypes($where);
            if($vtquery->num_rows() > 0){
                $result = $vtquery->row_array();
            }else{
                $result = false;
            }
        }
        
        return $result;
    }

    function _prepDelay($sec){
        if($sec <= 59){
            return '00:00:'.str_pad($sec,2,'0',STR_PAD_LEFT);
        }else{
            $secs = $sec % 60;
            $min = str_pad((($sec - $secs)/60),2,'0',STR_PAD_LEFT);
            $sec = str_pad($secs,2,'0',STR_PAD_LEFT);
            return '00:'.$min.':'.$sec;
        }
    }

	function _createFileObject($filedataarray){
		$file = new stdClass();
		foreach($filedataarray as $key => $val){
			$file->$key = $val;
		}
		return $file;
	}
	
	function getVideoInfo($src)
    {
        $cmd = sprintf($this->CI->preference->item('nano_GCMS_ffmpeg_location').' '.$this->CI->preference->item('nano_GCMS_ffmpeg_info_command').' 2>&1',$src);
        //print $src;
        ob_start();
        passthru($cmd);
        $duration = ob_get_contents();
        ob_end_clean();

        preg_match('/Duration: (.*?),/', $duration, $matches);
        $duration = $matches[1];
        
        $duration_array = split(':', $duration);
        $seconds = $duration_array[0] * 3600 + $duration_array[1] * 60 + $duration_array[2];
                
        $this->CI->eventlog->logEvent('getVideoInfo',$cmd." : ".$duration);
        return array('duration'=>$duration,'seconds'=>$seconds);
    }
    
    function generateExcelXML($indata,$asarray = true){
        if(count($indata) < 0){
            return false;
        }

        $data['header'] = array_keys($indata[0]);
        $data['datarows'] = $indata;
        
        $head = array();
        $body = array();
        $head[] = '<?xml version="1.0"?>';
        $head[] = '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="http://www.w3.org/TR/REC-html40">';  
        $head[] = '	<Styles>';
        $head[] = '     <Style ss:ID="headTitle">';
        $head[] = '			<Font x:Family="Swiss" ss:Bold="1" />';
        $head[] = '	    </Style>';
        $head[] = '     <Style ss:ID="cellStyle">';
        $head[] = '			<Font x:Family="Swiss" ss:Normal="1" />';
        $head[] = '	    </Style>';
        $head[] = ' </Styles>';
        
        
        $body[] = ' 	<Worksheet ss:Name="Sheet1">';
        $body[] = '    		<Table>';
        
        
        $headcell = array();
        $headcell[] = '<Row>';
        foreach($data['header'] as $headtitle){
            $headcell[] = '     <Cell ss:StyleID="headTitle">';
			$headcell[] = '          <Data ss:Type="String">'.$headtitle.'</Data>';
            $headcell[] = '     </Cell>';
        }
        $headcell[] = '</Row>';
        
        $cells = array();
        foreach($data['datarows'] as $row){
            //print_r($row);
            
            $cells[] = "<Row>";
            foreach($row as $key=>$val){
                $cells[] = '     <Cell ss:StyleID="cellStyle">';
    			$cells[] = '          <Data ss:Type="String">'.$val.'</Data>';
                $cells[] = '     </Cell>';
            }
            $cells[] = "</Row>";
            
        }
        
        //print_r($cells);

        $footer = array();
        $footer[] = '    		</Table>';
        $footer[] = '     </Worksheet>';
        $footer[] = '</Workbook>';
        
        $xml = array_merge($head,$body,$headcell,$cells,$footer);
        
        if($asarray == true){
            return $xml;
        }else{
            $xml = implode("\n",$xml);
            return $xml;
        }
    }


}

?>