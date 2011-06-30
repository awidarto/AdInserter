<h2><?php print $header?></h2>

<?php print form_open('ad/admin/domains/formpos/'.$this->validation->id,array('class'=>'horizontal'))?>
    <fieldset>
        <ol>
            <li>
                <?php print form_label('Top Level Host','toplevelhost')?>
                <?php print form_input('toplevelhost',$this->validation->toplevelhost,'id="domain" class="text"')?>
            </li>
            <li>
                <?php print form_label('Position','pos')?>
                <?php print form_dropdown('pos',array('none'=>'none','top'=>'top','bottom'=>'bottom','both'=>'both'),$this->validation->pos,'id="pos" class="text"')?>
            </li>
            <li class="submit">
                <?php print form_hidden('id',$this->validation->id)?>
                <div class="buttons">
	                <button type="submit" class="positive" name="submit" value="submit">
	                	<?php print  $this->bep_assets->icon('disk');?>
	                	<?php print $this->lang->line('general_save')?>
	                </button>

	                <a href="<?php print  site_url('ad/admin/domains/position')?>" class="negative">
	                	<?php print  $this->bep_assets->icon('cross');?>
	                	<?php print $this->lang->line('general_cancel')?>
	                </a>
	            </div>
            </li>
        </ol>
    </fieldset>
<?php print form_close()?>