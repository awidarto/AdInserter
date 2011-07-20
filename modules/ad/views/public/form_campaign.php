<script type='text/javascript'>

	jQuery(document).ready(function() {

		$( "#cpn_start,#cpn_end" ).datepicker({
			showWeek: true,
			firstDay: 1,
			dateFormat: 'yy-mm-dd'
		});
		
		$("#cpn_time_start,#cpn_time_end").timepicker({});
		
	});

</script>

<h2><?php print  $header;?></h2>
<?php print form_open_multipart('ad/form/'.$this->validation->id,array('class'=>'horizontal'))?>
    <fieldset>
        <ol>
            <li>
                <?php print form_label('Title','cpn_name')?>
                <?php print form_input('cpn_name',$this->validation->cpn_name,'id="cpn_name" class="text"')?>
            </li>
            <li>
                <?php print form_label('URL','cpn_landing_uri')?>
                <?php print form_input('cpn_landing_uri',$this->validation->cpn_landing_uri,'id="cpn_landing_uri" class="text"')?>
            </li>
            <li>
                <?php print form_label('Campaign ID','campaign_id')?>
                <?php print form_input('campaign_id',$this->validation->campaign_id,'id="campaign_id" class="text"')?>
            </li>
<!--
            <li>
                <?php print form_label('Default Campaign Dates','cpn_start')?>
                From <?php print form_input('cpn_start',$this->validation->cpn_start,'id="cpn_start" class="text"')?>
                To <?php print form_input('cpn_end',$this->validation->cpn_end,'id="cpn_end" class="text"')?>
            </li>
            <li>
                <?php print form_label('Time Range','cpn_time_start')?>
                From <?php print form_input('cpn_time_start',$this->validation->cpn_time_start,'id="cpn_time_start" class="text"')?>
                To <?php print form_input('cpn_time_end',$this->validation->cpn_time_end,'id="cpn_time_end" class="text"')?>
								<?php print form_checkbox('allday',1,$this->validation->set_checkbox('allday',1),'id="allday"')?> All day
            </li>
            <li>
                <?php print form_label('In-Schedule Color','color')?>
                <?php print form_input('color',$this->validation->color,'id="color" class="iColorPicker" class="text"')?>
            </li>
-->
            <li>
                <?php print form_label('Source','cpn_source')?>
                <?php print form_dropdown('cpn_source',$this->config->item('campaign_sources'),$this->validation->cpn_source);?>
            </li>
            <li>
                <?php print form_label('Active','active')?>
                <?php print $this->lang->line('general_yes')?> <?php print form_radio('active','1',$this->validation->set_radio('active','1'),'id="active"')?>
                <?php print $this->lang->line('general_no')?> <?php print form_radio('active','0',$this->validation->set_radio('active','0'))?>
            </li>
            <li>
                <table>
                    <thead>
                        <td><?php print form_label('Upload Files','')?></td>
                        <td style="text-align:center;padding:3px;">Sizes</td>
                        <td>Files</td>
                        <td style="text-align:center;padding:3px;">Master</td>
                        <td style="text-align:center;padding:3px;">Create from Master</td>
                    </thead>
                    <?php
                        //print_r($sizes);
                        if($sizes->num_rows() > 0){
                            $sizes = $sizes->result();
                            foreach($sizes as $size){
                                //print $this->config->item('public_folder').'ad/'.$this->validation->id.'_'.$size->width.'_'.$size->height.'.jpg';
                                $picture = (file_exists($this->config->item('public_folder').'ad/'.$this->validation->id.'_'.$size->width.'_'.$size->height.'.jpg'))?$this->validation->id.'_'.$size->width.'_'.$size->height.'.jpg':false;
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                            if($picture){
                                                print '<img src="'.base_url().'public/ad/'.$picture.'" />';
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align:right;padding:3px;"><?php print form_label($size->name.' [ '.$size->width.' x '.$size->height.' ]',$size->width.'_'.$size->height)?></td>
                                    <td ><?php print form_upload('upl_'.$size->width.'_'.$size->height); ?></td>
                                    <td  style="text-align:center;padding:3px;" ><?php print form_radio('master',$size->width.'_'.$size->height,$this->validation->set_radio('master','1'),'id="master"')?></td>
                                    <td  style="text-align:center;padding:3px;" ><?php print form_checkbox('from_master',$size->width.'_'.$size->height,0,'id="from_master"')?></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
            </li>
            
            
            <li class="submit">
                <?php print form_hidden('id',$this->validation->id)?>
                <div class="buttons">
	                <button type="submit" class="positive" name="submit" value="submit">
	                	<?php print  $this->bep_assets->icon('disk');?>
	                	<?php print $this->lang->line('general_save')?>
	                </button>

	                <a href="<?php print  site_url('ad')?>" class="negative">
	                	<?php print  $this->bep_assets->icon('cross');?>
	                	<?php print $this->lang->line('general_cancel')?>
	                </a>
	            </div>
            </li>
        </ol>
    </fieldset>
<?php print form_close()?>