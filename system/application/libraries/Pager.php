<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pager {

	/*
	* constructor
	*
	*/
	function Pager(){

		$this->CI=&get_instance();
		
	}
	
	
    function createPager($options,$export = null){

        $rsegs = $this->CI->uri->segment_array();
        
        //print_r($rsegs);
        
        $total = $options['page_total'];
        $current = $options['page_num'];
        $count = $options['page_count'];
        $orderby = $options['page_order'];
        $sort = $options['page_sort'];
        $pad = $options['page_pad'];
        $attrib = $options['page_attrib'];
        $order_array = $options['page_order_array'];
        $type = $rsegs[$options['page_pos']-1];
        
        $rsegs[$options['page_pos']] = '%s';
        $rsegs[$options['page_pos']+1] = '%s';
        $rsegs[$options['page_pos']+2] = '%s';
        $rsegs[$options['page_pos']+3] = '%s';
        
        $uri = implode('/',$rsegs);
                
        $pages = ceil($total/$count);
        $pager = array();
        
        $doublepads = (2*$pad);

        $first = anchor(sprintf($uri,0,$count,$orderby,$sort), '&laquo;&laquo; first', array('class'=>'first'));
        $last = anchor(sprintf($uri,$pages-1,$count,$orderby,$sort), 'last &raquo;&raquo;',array('class'=>'last'));
        
        if($pages <= $doublepads){
            for($i=0;$i<$pages;$i++){
                $pager[] = $this->_makeLink($uri,$i,$current,$count,$orderby,$sort,$attrib);
            }
        }else if($pages > $doublepads){
            if($current <= $pad){
                for($i=0;$i<($doublepads+1);$i++){
                    $pager[] = $this->_makeLink($uri,$i,$current,$count,$orderby,$sort,$attrib);
                }                                                                                                 
            }else if($current >= ($pages - $pad)){                                                                
                for($i=($pages - $doublepads - 1);$i<$pages;$i++){                                                
                    $pager[] = $this->_makeLink($uri,$i,$current,$count,$orderby,$sort,$attrib);
                }                                                                                                 
            }else{                                                                                                
                for($i=($current-$pad);$i<($current+$pad+1);$i++){                                                
                    $pager[] = $this->_makeLink($uri,$i,$current,$count,$orderby,$sort,$attrib);
                }
            }
        }

        $pager = implode(" ",$pager);
        $prev = anchor(sprintf($uri,$current-1,$count,$orderby,$sort), '&laquo; prev', array('class'=>'previous'));
        $next = anchor(sprintf($uri,$current+1,$count,$orderby,$sort), 'next &raquo;', array('class'=>'next'));
        
        if($current == 0){
            $pager .= " | ".$next." | ".$last;
        }else if($current == $pages-1){
            $pager = $first." | ".$prev." | ".$pager;
        }else{
            $pager .= " | ".$next;
            $pager = $first." | ".$prev." | ".$pager." | ".$last;
        }
        
        $formgoto = $this->_makeGoto($options);
        $formCSVexport = $this->_makeCSV($options['page_pos']-1);
        $formXMLexport = $this->_makeXML($options['page_pos']-1);
        $formprint = $this->_makePrint($options['page_pos']-1);
        
        $exportstring = $formCSVexport.' | '.$formXMLexport.' | '.$formprint;
        
        if(is_null($export)){
            if($pages > 1){
                if($type == 'print'){
                    return '<span class="page_indicator">[ page '.($current+1).' of '.$pages.' pages ]</span><br /><br />';
                }else{
                    return $pager.'<span class="page_indicator">[ page '.($current+1).' of '.$pages.' pages ]</span><br /><br />'.$formgoto['goto_script'].$formgoto['main_form'].'&nbsp;&nbsp;'.$formgoto['orderby_form'].$formgoto['hidden_form'];
                }
            }else{
                return '<span class="page_indicator">[ page 1 of 1 page ]</span><br /><br />'.$formgoto['goto_script'].$formgoto['orderby_form'].$formgoto['hidden_jumpto'].$formgoto['hidden_form'];
            }
        }else{
            return $exportstring.'<br /><br />';
        }
    }
    

    
    function _makeLink($uri,$pagenum,$current,$count,$orderby,$sort,$attrib){
        $urifix = sprintf($uri,$pagenum,$count,$orderby,$sort);
        if($pagenum == $current){
            $pagelink = '<span class="selected_page">'.($pagenum+1).'</span>';
        }else{
            $pagelink = anchor($urifix, $pagenum+1, $attrib);
        }
        
        return $pagelink;
    }
    
    function _makeGoto($options){

        $rsegs = $this->CI->uri->segment_array();
        
        $total = $options['page_total'];
        $current = $options['page_num'];
        $count = $options['page_count'];
        $orderby = $options['page_order'];
        $sort = $options['page_sort'];
        $pad = $options['page_pad'];
        $attrib = $options['page_attrib'];
        $order_array = $options['page_order_array'];
        
        $type = $rsegs[$options['page_pos'] - 1];
        
        $rsegs[$options['page_pos']] = '%s';
        $rsegs[$options['page_pos']+1] = '%s';
        $rsegs[$options['page_pos']+2] = '%s';
        $rsegs[$options['page_pos']+3] = '%s';
        

        $muri = array();
        for($i=1;$i<($options['page_pos']-1);$i++){
            $muri[]=$rsegs[$i];
        }
        
        if(count($muri) > 0){
            $muri = implode("/",$muri);
        }else{
            $muri = '';
        }

        $euri = $rsegs;
        for($i=0;$i<($options['page_pos']+3);$i++){
            array_shift($euri);
        }
        
        $gotoval = $current + 1;
        //print_r($euri);
        
        if(count($euri) > 0){
            $euri = implode("/",$euri);
        }else{
            $euri = '';
        }
        
        $form_goto['goto_script'] = '<script>
                            jQuery(window).bind("load", function() {
                                var base_url = "'.base_url().index_page().'";
                                jQuery("#bt_goto").bind("click",function(e){
                                    var jump = jQuery("#jumpto").val();
                                    var total = jQuery("#totalpages").val();
                                    //if(jump < total){
                                        var uri = jQuery("#urimain").val()+"/"+jQuery("#uritype").val()+"/"+(jQuery("#jumpto").val()-1)+"/"+jQuery("#uricount").val()+"/"+jQuery("#orderby").val()+"/"+jQuery("#sortby").val()+"/"+jQuery("#uriafter").val();
                                        //alert("goto : "+base_url+"/"+uri);
                                        window.location = base_url+"/"+uri;
                                    //}else{
                                    //    alert("Page number specified [ "+jQuery("#jumpto").val()+" ] is greater than total number of pages [ "+jQuery("#totalpages").val()+" ]");
                                    //};
                                });
                            });
                        </script>';
        
        
        $form_goto['main_form'] = '
            Go to Page <input type="text" name="jumpto" id="jumpto" style="width:5em;" value="'.$gotoval.'" />';
            
        $form_goto['orderby_form'] = 'Order By
            '.form_dropdown('orderby', $order_array,$orderby,'id="orderby"').'
            '.form_dropdown('sortby', array("desc"=>"Desc","asc"=>"Asc"),$sort,'id="sortby" class="nowidth"').'
            <input type="button" name="go" id="bt_goto" value="go" class="submit" style="width:5em;">
            ';
        $form_goto['hidden_jumpto'] = '
            <input type="hidden" name="jumpto" id="jumpto" value="'.$gotoval.'" />';

        $form_goto['hidden_orderby'] = '
            <input type="hidden" name="sortby" id="sortby" value="'.$sort.'" />
            <input type="hidden" name="orderby" id="orderby" value="'.$orderby.'" />';
            
        $form_goto['hidden_form'] = '
            <input type="hidden" name="uritype" id="uritype" value="'.$type.'" />
            <input type="hidden" name="uripages" id="uripages" value="'.$current.'" />
            <input type="hidden" name="uricount" id="uricount" value="'.$count.'" />
            <input type="hidden" name="urimain" id="urimain" value="'.$muri.'" />
            <input type="hidden" name="uriafter" id="uriafter" value="'.$euri.'" />
            <input type="hidden" name="totalpages" id="totalpages" value="'.$total.'" />
        ';
        return $form_goto;
        
    }

    function _makeCSV($typepos){
        $ucsv = $this->CI->uri->segment_array();
        $ucsv[$typepos] = 'csv';
        $uri_csv_page = implode("/",$ucsv);
        $ucsv[$typepos+1] = 'all';
        $uri_csv_all = implode("/",$ucsv);
        $atts = array(
                      'width'      => '200',
                      'height'     => '150',
                      'scrollbars' => 'no',
                      'status'     => 'no',
                      'resizable'  => 'no',
                      'screenx'    => '100',
                      'screeny'    => '100'
                    );
        $link_export = 'Export to CSV : ';
        $link_export .= anchor_popup($uri_csv_page, 'This Page', $atts);
        $link_export .= '&nbsp;&nbsp;';
        $link_export .= anchor_popup($uri_csv_all, 'All Result', $atts);
        $link_export .= '&nbsp;&nbsp;';
        return $link_export;
    }
    
    function _makePrint($typepos){
        $uprint = $this->CI->uri->segment_array();
        $uprint[$typepos] = 'print';
        $uri_print_page = implode("/",$uprint);
        $uprint[$typepos+1] = 'all';
        $uri_print_all = implode("/",$uprint);
        $atts = array(
                      'width'      => '600',
                      'height'     => '700',
                      'scrollbars' => 'yes',
                      'status'     => 'no',
                      'resizable'  => 'no',
                      'screenx'    => '100',
                      'screeny'    => '100'
                    );
        $link_print = 'Print : ';
        $link_print .= anchor_popup($uri_print_page, 'This Page', $atts);
        $link_print .= '&nbsp;&nbsp;';
        $link_print .= anchor_popup($uri_print_all, 'All Result', $atts);
        $link_print .= '&nbsp;&nbsp;';
        return $link_print;
    }

    function _makeXML($typepos){
        $uXML = $this->CI->uri->segment_array();
        $uXML[$typepos] = 'xml';
        $uri_XML_page = implode("/",$uXML);
        $uXML[$typepos+1] = 'all';
        $uri_XML_all = implode("/",$uXML);
        
        
        $atts = array(
                      'width'      => '600',
                      'height'     => '700',
                      'scrollbars' => 'yes',
                      'status'     => 'no',
                      'resizable'  => 'no',
                      'screenx'    => '100',
                      'screeny'    => '100'
                    );
        $link_XML = 'Export XML : ';
        $link_XML .= anchor_popup($uri_XML_page, 'This Page', $atts);
        $link_XML .= '&nbsp;&nbsp;';
        $link_XML .= anchor_popup($uri_XML_all, 'All Result', $atts);
        $link_XML .= '&nbsp;&nbsp;';
        return $link_XML;
    }

	
}