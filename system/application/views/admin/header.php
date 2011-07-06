<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php print $this->bep_site->get_metatags();?>
	<title><?php print $header.' | '.$this->preference->item('site_name');?></title>
	<?php print $this->bep_site->get_variables();?>
	<?php print $this->bep_assets->get_header_assets();?>
	<?php print $this->bep_site->get_js_blocks();?>
</head>
<body>
<div id="wrapper">

    <div id="header">
        <?php print displayStatus();?>
        <script>
            $('.status_box').delay(1000).slideUp('slow','linear');
        </script>
        <h1>&nbsp;</h1>
        <div id="info">
            <?php print anchor('',$this->bep_assets->icon('titles/32/view-website'))?>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php print anchor('auth/logout',$this->bep_assets->icon('titles/32/logout'))?>
        </div>
    </div>
    