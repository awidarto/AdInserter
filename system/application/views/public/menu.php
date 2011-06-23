<?php if(preg_match( '/login/',current_url()) == false): ?>
<table  style="width:100%;">
    <tr>
        <td  style="text-align:left;border:none;">
            <?php if(is_user()): ?>
                You are logged in as <?php print $this->session->userdata('fullname').','.$this->session->userdata('company');?>
                <?php //print_r($this->session)?>
            <?php else: ?>
                You are not logged in
            <?php endif;?>
        </td>
        <td  style="text-align:right;border:none;">
            <ul id="menu" style="width:100%;float:right;margin:0px;">
                <?php if(is_user()): ?>
                    <li><?php print anchor('ad/dashboard','Dashboard',array('class'=>'icon_house'))?></li>
                    <li><?php print anchor('ad','Campaign',array('class'=>'icon_page'))?></li>
                    <li><?php print anchor('ad/reports','Reports',array('class'=>'icon_folder'))?></li>
                    <li><?php print anchor('auth/logout',$this->lang->line('userlib_logout'),array('class'=>'icon_key_go'))?></li>
                <?php else:?>
                    <li><?php print anchor('auth/register',$this->lang->line('userlib_register'),array('class'=>'icon_group'))?></li>
                    <li><?php print anchor('auth/login',$this->lang->line('userlib_login'),array('class'=>'icon_key'))?></li>
                <?php endif;?>
            </ul>
        </td>
    </tr>
</table>
    <div class="clear"></div>
<?php endif;?>
