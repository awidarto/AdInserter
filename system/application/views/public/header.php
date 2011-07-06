<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php print $this->bep_site->get_metatags(); ?>
	<title><?php print $header.' | '.$this->preference->item('site_name')?></title>
	<?php print $this->bep_site->get_variables()?>
	<?php print $this->bep_assets->get_header_assets();?>
	<?php print $this->bep_site->get_js_blocks()?>
	<?php if(preg_match( '/login/',current_url()) || uri_string() == ""): ?>    
        <style>
            #wrapper{
                background-color:#d4d3d3;
                margin:auto auto;
                margin-top:100px;
                width:780px;

                -moz-box-shadow: 0px 0px 15px #555; /* Firefox 3.6 and earlier */
                -webkit-box-shadow: 0px 0px 15px #555; /* Safari and Chrome */
                box-shadow: 0px 0px 15px #555;
            }

            #header{
                background: transparent;
            }

            #content{
                background-color:#b2b0b0;
                border-top: 2px double #b2b0b0;
                border-bottom: 2px double #b2b0b0;
                padding:10px;
            }

            table{
                margin:0px;
            }

            td {
                border:none;
            }
        </style>
    <?php endif;?>
    
    
</head>

<body>
<div id="wrapper">
    <?php print displayStatus();?>
    <script>
        $('.status_box').delay(1000).slideUp('slow','linear');
    </script>
    <div id="header">
        <h1><?php //print $this->preference->item('site_name')?>&nbsp;</h1>
    </div>