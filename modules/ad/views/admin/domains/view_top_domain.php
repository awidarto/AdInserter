<h2><?php print $header?></h2>

<div class="buttons">                
	<a href="<?php print  site_url('ad/admin/domains/form')?>">
    <?php print  $this->bep_assets->icon('add');?>
    Add Domain
    </a>
</div><br/><br/>

<?php print form_open('ad/admin/domains/delete')?>
<table class="data_grid" cellspacing="0">
    <thead>
        <tr>
            <th width=5%><?php print $this->lang->line('general_id')?></th>
            <th>Top Domains</th>
            <th width=5% class="middle"><?php print $this->lang->line('general_edit')?></th>
            <th width=10%><?php print form_checkbox('all','select',FALSE)?><?php print $this->lang->line('general_delete')?></th>        
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan=3>&nbsp;</td>
            <td><?php print form_submit('delete',$this->lang->line('general_delete'),'onClick="return confirm(\'Are you sure to delete these domain ?\');"')?></td>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach($members->result_array() as $row):
            $delete  = form_checkbox('select[]',$row['id'],FALSE);  
        ?>
        <tr>
            <td><?php print $row['id']?></td>
            <td><?php print $row['domain']?></td>
            <td class="middle"><a href="<?php print site_url('ad/admin/domains/form/'.$row['id'])?>"><?php print $this->bep_assets->icon('pencil');?></a></td>
            <td><?php print $delete?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php print form_close()?>