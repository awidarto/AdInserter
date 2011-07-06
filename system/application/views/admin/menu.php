<!--
When creating a new menu item on the top-most level
Please ensure that you assign the LI a unique ID

Examples can be seen below for menu_bep_system
-->

<ul id="menu">
    <li id="menu_bep_home"><?php print anchor('admin',$this->bep_assets->icon('titles/32/dashboard'))?></li>
    <li id="menu_campaign"><?php print anchor('ad/admin/ad',$this->bep_assets->icon('titles/32/campaign'))?></li>
    <li id="menu_top_domain"><?php print anchor('ad/admin/domains',$this->bep_assets->icon('titles/32/top_domains'))?></li>
    <li id="menu_position"><?php print anchor('ad/admin/domains/position',$this->bep_assets->icon('titles/32/insert_position'))?></li>
    <li id="menu_widget"><?php print anchor('ad/admin/domains/widget',$this->bep_assets->icon('titles/32/widget_position'))?></li>
    <?php if(check('System',NULL,FALSE)):?>
    <li id="menu_bep_system"><span><?php print $this->bep_assets->icon('titles/32/system');?></span>
        <ul>
            <?php if(check('Members',NULL,FALSE)):?><li><?php print anchor('auth/admin/members',$this->bep_assets->icon('titles/32/member'))?></li><?php endif;?>
            <?php if(check('Access Control',NULL,FALSE)):?><li><?php print anchor('auth/admin/access_control',$this->bep_assets->icon('titles/32/access-control'))?></li><?php endif;?>
            <?php if(check('Settings',NULL,FALSE)):?><li><?php print anchor('admin/settings',$this->bep_assets->icon('titles/32/setting'))?></li><?php endif;?>
        </ul>
    </li>
    <?php endif;?>
</ul>
