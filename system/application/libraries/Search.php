<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search {

	/*
	* constructor
	*
	*/
	function Search(){

		$this->CI=&get_instance();
		$this->chain_array = array('IGNORE'=>'<< Ignore This Filter','AND'=> 'AND','OR'=>'OR');
        $this->duration_sign_array = array('gt'=>'greater than','lt'=>'less than','gte'=>'greater or equal','lte'=>'less or equal','eq'=>'equals','ne'=>'not equal');
        
	}
	
	function initSearchForm(){
	    //$this->searchform = '<form name="goto" action="" class="form_goto">';
	    $this->searchform = '';
	}
	
	function closeSearchForm(){
	    //$this->searchform .= form_close();
	    $this->searchform .= '';
	}
	
	function printSearchForm(){
	    return $this->searchform;
	}

    function AddDateRangeForm($options = null){
        
        $labelstyle = ($options['labelstyle'])?$options['labelstyle']:'';
        
        $thisyearfrom = ($options['yearfrom'] == null)?date("Y",time()):$options['yearfrom'];
        $thismonthfrom = ($options['monthfrom'] == null)?date("m",time()):$options['monthfrom'];
        $todayfrom = ($options['dayfrom'] == null)?date("d",time()):$options['dayfrom'];
        $thisyearto = ($options['yearto'] == null)?date("Y",time()):$options['yearto'];
        $thismonthto = ($options['monthto'] == null)?date("m",time()):$options['monthto'];
        $todayto = ($options['dayto'] == null)?date("d",time()):$options['dayto'];
        
        for($i=1970;$i<2035;$i++){
            $years[$i] = $i;
        }
        for($i=1;$i<13;$i++){
            $months[$i] = $i;
        }
        for($i=1;$i<32;$i++){
            $days[$i] = $i;
        }
        
//        $this->searchform .= '<b>Date Range</b><br />';
        $this->searchform .='<script>
                                jQuery(window).bind("load", function() {
                                    var base_url = "'.base_url().index_page().'";
                                    jQuery("#bt_filter_date").bind("click",function(e){
                                        var datefield = jQuery("#datesearchfield").val();
                                        var from = jQuery("#from_year").val()+"-"+jQuery("#from_month").val()+"-"+jQuery("#from_day").val();
                                        var to = jQuery("#to_year").val()+"-"+jQuery("#to_month").val()+"-"+jQuery("#to_day").val();
                                        
                                        var uri = jQuery("#urimain").val()+"/result/"+"0"+"/"+jQuery("#uricount").val()+"/"+jQuery("#orderby").val()+"/"+jQuery("#sortby").val()+"/"+datefield+"/"+from+"/"+to;
                                        
                                        //alert("goto : "+base_url+"/"+uri);
                                        window.location = base_url+"/"+uri;
                                    });
                                });
                            </script>';
        $this->searchform .= '<span '.$labelstyle.'>'.$options['date_label'].'</span>&nbsp;&nbsp;&nbsp;'.form_dropdown('datesearchfield', $options['datefield_array'],$options['datefield_selected'],'id="datesearchfield"').'&nbsp;&nbsp;';
        $this->searchform .= '<br /><br /><strong>From</strong> [yy - mm - dd] :&nbsp;&nbsp;'.form_dropdown('from_year', $years,$thisyearfrom,'id="from_year" class="nowidth"');
        $this->searchform .= ' - '.form_dropdown('from_month', $months,$thismonthfrom,'id="from_month" class="nowidth"');
        $this->searchform .= ' - '.form_dropdown('from_day', $days,$todayfrom,'id="from_day" class="nowidth"').'&nbsp;&nbsp;&nbsp;&nbsp;';
        $this->searchform .= '<br /><br /><strong>To</strong> [yy - mm - dd] :&nbsp;&nbsp;'.form_dropdown('call_to_year', $years,$thisyearto,'id="to_year" class="nowidth"');
        $this->searchform .= ' - '.form_dropdown('to_month', $months,$thismonthto,'id="to_month" class="nowidth"');
        $this->searchform .= ' - '.form_dropdown('to_day', $days,$todayto,'id="to_day" class="nowidth"').'&nbsp;';
        $this->searchform .= '<input type="button" name="go" id="bt_filter_date" value="go" class="submit" style="width:5em;">';
//        $this->searchform .= '<input type="button" name="go" id="bt_filter_date" value="go" class="submit" style="width:5em;"><br /><br />';
        $this->searchform .= '<br />';
    }
    
    function addDurationForm($options = null){
        $durstyle = ($options['labelstyle'])?$options['labelstyle']:'';
        
        $this->searchform .= '<tr><td><span '.$durstyle.'>Duration </span></td><td>'.form_dropdown('duration_sign', $this->duration_sign_array,$hilite['fields']['duration_sign'],'id="duration_sign"').' '.form_input(array('name'=>'search_keyword_duration','id'=>'search_keyword_duration','size'=>5,'value'=>$hilite['fields']['duration']));
        $this->searchform .= '</td><td>';
        $this->searchform .= '<input type="button" name="go" id="bt_filter_duration" value="go" style="width:5em;">';
        $this->searchform .= '<br />';
        $this->searchform .= '</td><td>'.form_dropdown('chain_duration', array('IGNORE'=>'<< Ignore This Filter','INCLUDE'=> '<< Include This Filter'),$hilite['chains']['duration'],'id="chain_duration"').'</td></tr>';
        
    }
    
    function addScopeForm($options = null){
        $labelstyle = ($options['labelstyle'])?$options['labelstyle']:'';
        $options['prev_search'] = ($options['prev_search'])?$options['prev_search']:'"/"';
        $this->searchform .='<script>
                                jQuery(window).bind("load", function() {
                                    var base_url = "'.base_url().index_page().'";
                                    jQuery("#bt_'.$options['searchvalue_name'].'").bind("click",function(e){
                                        var datefield = jQuery("#datesearchfield").val();
                                        var from = jQuery("#from_year").val()+"-"+jQuery("#from_month").val()+"-"+jQuery("#from_day").val();
                                        var to = jQuery("#to_year").val()+"-"+jQuery("#to_month").val()+"-"+jQuery("#to_day").val();
                                        var scope = jQuery("#'.$options['scope_name'].'").val();
                                        var keyword = jQuery("#'.$options['searchvalue_name'].'").val();

                                        var uri = jQuery("#urimain").val()+"/result/"+"0"+"/"+jQuery("#uricount").val()+"/"+jQuery("#orderby").val()+"/"+jQuery("#sortby").val()+"/"+datefield+"/"+from+"/"+to+'.$options['prev_search'].'+scope+"/"+keyword;

                                        //alert("goto : "+base_url+"/"+uri);
                                        window.location = base_url+"/"+uri;
                                    });
                                });
                                
                            </script>';
        
        $this->searchform .= '<br /><span '.$labelstyle.'>'.$options['search_label'].'</span>&nbsp;&nbsp;&nbsp;'.form_dropdown($options['scope_name'], $options['scope_array'],$options['scope_selected'],'id="'.$options['scope_name'].'"');
        $this->searchform .= form_input(array('name'=>$options['searchvalue_name'],'id'=>$options['searchvalue_name'],'size'=>35,'value'=>$options['searchvalue']));
        $this->searchform .= '<input type="button" name="bt_'.$options['searchvalue_name'].'" id="bt_'.$options['searchvalue_name'].'" value="go" class="submit" style="width:5em;">&nbsp;&nbsp;&nbsp;';
        //$this->searchform .= '<br /><br />';
        
    }

    function makeSearchForm($options = null){

        $rsegs = $this->CI->uri->segment_array();

        $hilite = $this->_setHighlight($rsegs);
        

        //if($rsegs[$act] == 'list'){
        if(in_array($rsegs,'list')){    
            
            $act = array_search('list',$rsegs);
            //print 'list : '.$act;
            
            
            $thisyearfrom = date("Y",time());
            $thismonthfrom = date("m",time());
            $todayfrom = date("d",time());
            $thisyearto = date("Y",time());
            $thismonthto = date("m",time());
            $todayto = date("d",time());

            $scope = '';
            $search = '';

            $reset = '';

            $duration_sign = '=';

        }else if(in_array($rsegs,'result')){  
            //if($rsegs[$act] == 'result'){
            
            $act = array_search('result',$rsegs);
            //print 'result : '.$act;
            
            $fro = explode("-",$rsegs[8]);
            $thisyearfrom = $fro[0];
            $thismonthfrom = $fro[1];
            $todayfrom = $fro[2];

            $tor = explode("-",$rsegs[9]);
            $thisyearto = $tor[0];
            $thismonthto = $tor[1]; 
            $todayto = $tor[2];

            $reset = '&nbsp;&nbsp;|&nbsp;&nbsp;'.anchor($options['reset_anchor'],'clear search');

            if(isset($rsegs[10])){
                $scope = $rsegs[10];


                if($scope == 'duration'){
                    $duration_sign = $rsegs[11];
                    $search = $rsegs[12];
                }else{
                    $duration_sign = '=';
                    $search = $rsegs[11];
                }
            }else{
                $scope = 'none';
                $search = 'none';
            }

        }


        if(isset($options['cam_array'])){
            $cam_array = $options['cam_array'];
        }else{
            $cam_array = array('no_cam'=>'No Camera');
        }

        if(isset($options['cam_group_array'])){
            $cam_group_array = $options['cam_group_array'];
        }else{
            $cam_group_array = array('no_cam'=>'No Camera Group');
        }

        if(isset($options['file_array'])){
            $file_array = $options['file_array'];
        }else{    
            $file_array = array('no_cam'=>'No File Group');
        }

        if(isset($options['file_group_array'])){
            $file_group_array = $options['file_group_array'];
        }else{
            $file_group_array = array('no_cam'=>'No File Group');
        }


        $bold = 'style="font-weight:bold;"';
        $normal = 'style="font-weight:normal;"';

        $dstcstyle = ($hilite['fields']['dst'] == '')?$normal:$bold;
        $dstcgstyle = ($hilite['fields']['dstcg'] == '')?$normal:$bold;
        $dstfstyle = ($hilite['fields']['dstf'] == '')?$normal:$bold;
        $dstfgstyle = ($hilite['fields']['dstfg'] == '')?$normal:$bold;
        $dstsvstyle = ($hilite['fields']['dstsv'] == '')?$normal:$bold;
        $clidstyle = ($hilite['fields']['clid'] == '')?$normal:$bold;
        $durstyle = ($hilite['fields']['duration'] == '')?$normal:$bold;

        $service_array = (isset($options['service_array']))?$options['service_array']:array('1234'=>'1234','1235'=>'1235','1236'=>'1236');

        $chain_array = array('IGNORE'=>'<< Ignore This Filter','AND'=> 'AND','OR'=>'OR');

        $duration_sign_array = array('gt'=>'greater than','lt'=>'less than','gte'=>'greater or equal','lte'=>'less or equal','eq'=>'equals','ne'=>'not equal');

        $form_search = '<form name="goto" action="" class="form_goto">';
        $form_search .= '<h4>Search / Filter '.$reset.'</h4>';
        $form_search .= '<b>Date Range</b><br />';
        $form_search .= 'From [yy - mm - dd] :'.form_dropdown('call_from_year', $this->CI->config->item('doc_years'),$thisyearfrom,'id="call_from_year"');
        $form_search .= ' - '.form_dropdown('call_from_month', $this->CI->config->item('doc_months'),$thismonthfrom,'id="call_from_month"');
        $form_search .= ' - '.form_dropdown('call_from_day', $this->CI->config->item('doc_days'),$todayfrom,'id="call_from_day"').'&nbsp;&nbsp;';
        $form_search .= 'To [yy - mm - dd] :'.form_dropdown('call_to_year', $this->CI->config->item('doc_years'),$thisyearto,'id="call_to_year"');
        $form_search .= ' - '.form_dropdown('call_to_month', $this->CI->config->item('doc_months'),$thismonthto,'id="call_to_month"');
        $form_search .= ' - '.form_dropdown('call_to_day', $this->CI->config->item('doc_days'),$todayto,'id="call_to_day"');
        $form_search .= '<input type="button" name="go" id="bt_filter_date" value="go" class="submit" style="width:5em;"><br /><br />';
        $form_search .= '<br />';

        if($options['filter_enabled']){

            $form_search .= '<b>Filter By</b><br />';
            $form_search .= '<table border=0><tr><td>';
            $form_search .= 'Filter</td><td>&nbsp;</td><td>&nbsp;</td><td>Chain</td>';

            if($options['camera_search']){
                $form_search .= '<tr><td><span '.$dstcstyle.'>Dest. Camera ID </span></td><td>'.form_dropdown('search_keyword_dst', $cam_array,$hilite['fields']['dst'],'id="search_keyword_dst"');
                $form_search .= '</td><td>';
                $form_search .= '<input type="button" name="go" id="bt_filter_dst" value="go" class="submit" style="width:5em;">';
                $form_search .= '<br />';
                $form_search .= '</td><td>'.form_dropdown('chain_dst', $chain_array,$hilite['chains']['dst'],'id="chain_dst"').'</td></tr>';
            }
            if($options['camera_group_search']){
                $form_search .= '<tr><td><span '.$dstcgstyle.'>Dest. Camera Group </span></td><td>'.form_dropdown('search_keyword_dstcg', $cam_group_array,$hilite['fields']['dstcg'],'id="search_keyword_dstcg"');
                $form_search .= '</td><td>';
                $form_search .= '<input type="button" name="go" id="bt_filter_dstcg" value="go" class="submit" style="width:5em;">';
                $form_search .= '<br />';
                $form_search .= '</td><td>'.form_dropdown('chain_dstcg', $chain_array,$hilite['chains']['dstcg'],'id="chain_dstcg"').'</td></tr>';
            }
            if($options['file_search']){
                $form_search .= '<tr><td><span '.$dstfstyle.'>Dest. File ID </span></td><td>'.form_dropdown('search_keyword_dstf', $file_array,$hilite['fields']['dstf'],'id="search_keyword_dstf"');
                $form_search .= '</td><td>';
                $form_search .= '<input type="button" name="go" id="bt_filter_dstf" value="go" class="submit" style="width:5em;">';
                $form_search .= '<br />';
                $form_search .= '</td><td>'.form_dropdown('chain_dstf', $chain_array,$hilite['chains']['dstf'],'id="chain_dstf"').'</td></tr>';
            }
            if($options['file_group_search']){
                $form_search .= '<tr><td><span '.$dstfgstyle.'>Dest. File Group </span></td><td>'.form_dropdown('search_keyword_dstfg', $file_group_array,$hilite['fields']['dstfg'],'id="search_keyword_dstfg"');
                $form_search .= '</td><td>';
                $form_search .= '<input type="button" name="go" id="bt_filter_dstfg" value="go" class="submit" style="width:5em;">';
                $form_search .= '<br />';
                $form_search .= '</td><td>'.form_dropdown('chain_dstfg', $chain_array,$hilite['chains']['dstfg'],'id="chain_dstfg"').'</td></tr>';
            }
            if($options['service_search']){
                $form_search .= '<tr><td><span '.$dstsvstyle.'>Service </span></td><td>'.form_dropdown('search_keyword_dstsv', $service_array,$hilite['fields']['dstsv'],'id="search_keyword_dstsv"');
                $form_search .= '</td><td>';
                $form_search .= '<input type="button" name="go" id="bt_filter_dstsv" value="go" class="submit" style="width:5em;">';
                $form_search .= '<br />';
                $form_search .= '</td><td>'.form_dropdown('chain_dstsv', $chain_array,$hilite['chains']['dstsv'],'id="chain_dstsv"').'</td></tr>';
            }

            if($options['caller_search']){
                $form_search .= '<tr><td><span '.$clidstyle.'>Caller MSISDN </span></td><td>'.form_input(array('name'=>'search_keyword_clid','id'=>'search_keyword_clid','size'=>20,'value'=>$hilite['fields']['clid']));
                $form_search .= '</td><td>';
                $form_search .= '<input type="button" name="go" id="bt_filter_clid" value="go" class="submit" style="width:5em;">';
                $form_search .= '<br />';
                $form_search .= '</td><td>'.form_dropdown('chain_clid', $chain_array,$hilite['chains']['clid'],'id="chain_clid"').'</td></tr>';
            }

            if($options['duration_search']){
                $form_search .= '<tr><td><span '.$durstyle.'>Duration </span></td><td>'.form_dropdown('duration_sign', $duration_sign_array,$hilite['fields']['duration_sign'],'id="duration_sign"').' '.form_input(array('name'=>'search_keyword_duration','id'=>'search_keyword_duration','size'=>5,'value'=>$hilite['fields']['duration']));
                $form_search .= '</td><td>';
                $form_search .= '<input type="button" name="go" id="bt_filter_duration" value="go" class="submit" style="width:5em;">';
                $form_search .= '<br />';
                $form_search .= '</td><td>'.form_dropdown('chain_duration', array('IGNORE'=>'<< Ignore This Filter','INCLUDE'=> '<< Include This Filter'),$hilite['chains']['duration'],'id="chain_duration"').'</td></tr>';
            }
            if($options['camera_search'] || $options['file_search'] || $options['service_search'] || $options['caller_search'] || $options['duration_search']){
                $form_search .= '<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td align="center">';
                $form_search .= '<input type="button" name="go" id="bt_chain_exec" value="execute chain" class="submit" style="width:10em;"></td></tr>';
            }

            $form_search .= '<table />';


        }

        if($options['freeform_search']){
            $form_search .= '<b>Free Form Search</b><br />';
            $form_search .= 'In '.form_dropdown('search_scope', $this->CI->config->item('cdr_search_sections'),$scope,'id="search_scope"').' for '.form_input(array('name'=>'search_keyword','id'=>'search_keyword','size'=>20,'value'=>($scope == 'dst' || $scope == 'clid' || $scope == 'duration')?"":$search));
            $form_search .= '<input type="button" name="go" id="bt_search" value="go" class="submit" style="width:5em;">';
        }

        $form_search .= form_close();

        return $form_search;

    }
	
}	

