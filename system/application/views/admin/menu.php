<!--
When creating a new menu item on the top-most level
Please ensure that you assign the LI a unique ID

Examples can be seen below for menu_bep_system
-->

<ul id="menu">
    <li id="menu_bep_home"><?php print anchor('admin',$this->bep_assets->icon('titles/32/dashboard'))?></li>
    <?php if(check('System',NULL,FALSE)):?>
    <li id="menu_bep_system"><?php print $this->bep_assets->icon('titles/32/system');?></span>
        <ul>
            <?php if(check('Members',NULL,FALSE)):?><li><?php print anchor('auth/admin/members',$this->bep_assets->icon('titles/32/member'))?></li><?php endif;?>
            <?php if(check('Access Control',NULL,FALSE)):?><li><?php print anchor('auth/admin/access_control',$this->bep_assets->icon('titles/32/access-control'))?></li><?php endif;?>
            <?php if(check('Settings',NULL,FALSE)):?><li><?php print anchor('admin/settings',$this->bep_assets->icon('titles/32/setting'))?></li><?php endif;?>
        </ul>
    </li>
    <?php endif;?>
</ul>
