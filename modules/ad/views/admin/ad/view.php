<h2><?php print  $header;?></h2>

<div class="buttons">                
	<a href="<?php print  site_url('ad/admin/ad/form')?>">
    <?php print  $this->bep_assets->icon('add');?>
    Create New Campaign
    </a>
</div><br/><br/>
<style>
    th {padding:2px 3px;}
</style>
<?php print form_open('ad/admin/ad/delete')?>
<table class="data_grid" cellspacing="0">
    <thead>
        <tr>
            <th width=5%><?php print $this->lang->line('general_id')?></th>
            <th>Campaign ID</th>
            <th>Title</th>
            <th>Landing URL</th>
            <th>Created</th>
            <th width=5% class="middle"><?php print $this->lang->line('userlib_active')?></th> 
            <th width=5% class="middle">Schedule</th> 
            <th width=5% class="middle">Audience</th> 
            <th width=5% class="middle"><?php print $this->lang->line('general_edit')?></th>
            <th width=10%><?php print form_checkbox('all','select',FALSE)?><?php print $this->lang->line('general_delete')?></th>        
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan=9>&nbsp;</td>
            <td class="submit">
                <div class="button">
                    <button type="submit" class="negative" name="submit" value="submit" onClick="return confirm('<?=$this->lang->line('userlib_delete_user_confirm');?>');" >
                    	<?php print  $this->bep_assets->icon('cross');?>
                    	<?php print $this->lang->line('general_delete');?>
                    </button>
                </div>
            </td>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach($members->result_array() as $row):
            // Check if this user account belongs to the person logged in
            // if so don't allow them to delete it, also if it belongs to the main
            // admin user don't allow them to delete it
            $delete  = ($row['user_id'] == $this->session->userdata('id') || $this->session->userdata('id') == 1) ? form_checkbox('select[]',$row['id'],FALSE) : '&nbsp;';  
			
			$active =  ($row['active']?'tick':'cross');   
        ?>
        <tr>
            <td><?php print $row['id']?></td>
            <td><?php print $row['campaign_id']?></td>
            <td><?php print $row['cpn_name']?></td>
            <td><?php print $row['cpn_landing_uri']?></td>
            <td><?php print date('d M Y',strtotime($row['datecreated']))?></td>
            <td class="middle"><?php print $this->bep_assets->icon($active);?></td>
            <td class="middle"><a href="<?php print site_url('ad/admin/ad/schedule/'.$row['id'].'/update')?>"><?php print $this->bep_assets->icon('application');?></a></td>
            <td class="middle"><a href="<?php print site_url('ad/admin/ad/audience/'.$row['id'])?>"><?php print $this->bep_assets->icon('user');?></a></td>
            <td class="middle"><a href="<?php print site_url('ad/admin/ad/form/'.$row['id'])?>"><?php print $this->bep_assets->icon('pencil');?></a></td>
            <td><?php print $delete?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php print form_close()?>
