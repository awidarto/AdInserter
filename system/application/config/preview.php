<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['ghostscript_binary'] = '/opt/local/bin/gs';
$config['wvHtml_binary'] = '/opt/local/bin/wvHtml';
$config['wvPS_binary'] = '/opt/local/bin/wvPS';
$config['wvPDF_binary'] = '/opt/local/bin/wvPDF';

$config['pdf2jpeg_cmd'] = ' -dBATCH -dNOPAUSE -sDEVICE=jpeg -r150x150 -sOutputFile=%s %s';
$config['word2pdf_cmd'] = ' %s %s';
?>