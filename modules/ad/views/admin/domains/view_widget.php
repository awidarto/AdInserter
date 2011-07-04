<h2><?php print $header?></h2>

<div class="buttons">                
	<a href="<?php print  site_url('ad/admin/domains/formwidget')?>">
    <?php print  $this->bep_assets->icon('add');?>
    Add Widget Position Rule
    </a>
</div><br/><br/>

<?php print form_open('ad/admin/domains/delwidget')?>
<table class="data_grid" cellspacing="0">
    <thead>
        <tr>
            <th width=5%><?php print $this->lang->line('general_id')?></th>
            <th>Top Level Host</th>
            <th>Widget Position</th>
            <th width=5% class="middle"><?php print $this->lang->line('general_edit')?></th>
            <th width=10%><?php print form_checkbox('all','select',FALSE)?><?php print $this->lang->line('general_delete')?></th>        
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan=4>&nbsp;</td>
            <td><?php print form_submit('delete',$this->lang->line('general_delete'),'onClick="return confirm(\'Are you sure to delete these entry ?\');"')?></td>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach($members->result_array() as $row):
            $delete  = form_checkbox('select[]',$row['id'],FALSE);  
        ?>
        <tr>
            <td><?php print $row['id']?></td>
            <td><?php print $row['toplevelhost']?></td>
            <td><?php print $row['pos']?></td>
            <td class="middle"><a href="<?php print site_url('ad/admin/domains/formwidget/'.$row['id'])?>"><?php print $this->bep_assets->icon('pencil');?></a></td>
            <td><?php print $delete?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php print form_close()?>