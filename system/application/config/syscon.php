<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$dom = array();
for($i=1;$i<32;$i++){
    $dom[$i] = $i;
}

$moy = array();
for($i=1;$i<13;$i++){
    $moy[$i] = $i;
}

$vy = array();
for($i=2002;$i>1940;$i--){
    $vy[$i] = $i;
}

$ay = array();
for($i=2010;$i<2040;$i++){
    $ay[$i] = $i;
}

$config['days_of_month']= $dom;
$config['months_of_year']= $moy;
$config['valid_years']	= $vy;
$config['sys_valid_years']	= $ay;


$config['contestlevels'] = array(
        '0'=>'Penonton',
        '1'=>'Kontestan',
        '2'=>'Finalis',
    );
    
$config['public_folder']='/Applications/xampp/htdocs/adplatform/public/';

$config['video_host'] = 'http://119.235.27.194:8888/';
$config['use_lighttpd'] = true;

$config['age_id_limit'] = 17;

$config['user_hear_from'] = array(
        'facebook'=>'Facebook',
        'twitter'=>'Twitter',
        'forum'=>'Forum',
        'friend'=>'Dari Teman',
        'magazine'=>'Majalah',
        'poster'=>'Selebaran & Poster',
        'other'=>'Lainnya, harap sebutkan...'
    );

?>
