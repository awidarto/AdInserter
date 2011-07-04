<h2><?php print $header?></h2>
<?php print form_open_multipart('ad/audience/'.$this->validation->id,array('class'=>'horizontal'))?>
    <fieldset>
        <ol>
            <li>
                <?php print form_label('Domain / URL','domain')?>
                <ul>
                    <li><?php print form_radio('domain','all',$this->validation->set_radio('domain','all'),'id="domain"')?>All domains</li>
                    <li><?php print form_radio('domain','top',$this->validation->set_radio('domain','top'),'id="domain"')?>Top domains
                        <ul>
                            <?php foreach($top_domains->result_array() as $d):?>
                                <li><?php print $d['domain'];?></li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    <li><?php print form_radio('domain','specific',$this->validation->set_radio('domain','specific'),'id="domain"')?>Specific domains <span class="annotation">( multiple domain, separated by comma )</span><br />
                        <ul>
                            <li><textarea name="url_specific" id="url_specific" style="width:300px;height:100px;"><?=$this->validation->url_specific?></textarea></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <?php print form_label('Browser / Device','browser')?>
                <ul>
                    <li><?php print form_radio('browser','all',$this->validation->set_radio('browser','all'),'id="browser"')?>All browsers</li>
                    <li><?php print form_radio('browser','specific',$this->validation->set_radio('browser','specific'),'id="browser"')?>Specific browsers <span class="annotation">( multiple browser, separated by comma )
                        <ul>
                            <li><textarea name="browser_specific" id="browser_specific" style="width:300px;height:100px;"><?=$this->validation->browser_specific?></textarea></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <?php print form_label('Impressions ( x 1000 )','order_impression')?>
                <?php print form_input('order_impression',$this->validation->order_impression,'id="order_impression" class="text"')?>
                <span class="actual">Actual Impressions : <?=$campaign['actual_impression']?></span>
            </li>
            <li>
                <?php print form_label('Clicks','order_click')?>
                <?php print form_input('order_click',$this->validation->order_click,'id="order_click" class="text"')?>
                <span class="actual">Actual Clicks : <?=$campaign['actual_click']?></span>
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