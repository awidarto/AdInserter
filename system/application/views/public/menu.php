<?php if(!(preg_match( '/login/',current_url()) || uri_string() == "")): ?>    
<table  style="width:100%;">
    <tr>
        <td  style="text-align:left;border:none;vertical-align:middle;font-size:12px;font-weight:bold;padding:10px;color:orange;">
            <?php if(is_user()): ?>
                You are logged in as <?php print $this->session->userdata('fullname').','.$this->session->userdata('company');?>
            <?php else: ?>
                You are not logged in
            <?php endif;?>
        </td>
        <td  style="text-align:right;border:none;">
            <ul id="menu" style="width:100%;float:right;margin:0px;">
                <?php if(is_user()): ?>
                    <li><?php print anchor('auth/logout',$this->lang->line('userlib_logout'),array('class'=>'icon_key_go'))?></li>
                    <li><?php print anchor('ad/reports','Reports',array('class'=>'icon_folder'))?></li>
                    <li><?php print anchor('ad','Campaign',array('class'=>'icon_page'))?></li>
                    <li><?php print anchor('ad/dashboard','Dashboard',array('class'=>'icon_house'))?></li>
                <?php else:?>
                    <li><?php print anchor('auth/login',$this->lang->line('userlib_login'),array('class'=>'icon_key'))?></li>
                    <li><?php print anchor('auth/register',$this->lang->line('userlib_register'),array('class'=>'icon_group'))?></li>
                <?php endif;?>
            </ul>
        </td>
    </tr>
</table>
    <div class="clear"></div>
<?php endif;?>
