<?php
    /**************************************************************************
     *  InMobi Ad Code
     *  Copyright mKhoj Solutions Pvt Ltd and all its subsidiaries. All rights reserved.
     **************************************************************************/

    /************************************************************************** 
     *  For better targeting, tell us where this ad is intended to 
     *  be placed on the page.
     *  Accepted Values are 'top', 'middle', 'bottom', or 'page',
     *  denoting top 20%, middle 60%, bottom 20% or the whole page
     *  length respectively.
     **************************************************************************/
    $mkhoj_plc  = 'page';

    /**************************************************************************
     *  Make the value of this parameter true if you are running some tests.
     *  This will make the ad code call the mKhoj sandbox.
     **************************************************************************/
    $mkhoj_test = false;

    /**************************************************************************
     *  For better targeting, track individual users by setting a persistent
     *  cookie/session in their browser. Set the cookie/session with following 
     *  properties
     *    - Cookie value : UUID or some other unique value
     *    - Path         : /
     *    - Expires      : 1 year
     *  On a request, if cookie/session value is not retrieved, set a new value.
     *  Set this value in the following variable.
     *  NB: This has to be done near the top of the page before any HTML body
     *      fragment goes out.
     **************************************************************************/
 
    $mkhoj_sessionid = '';

    /**************************************************************************
     *  ALL EDITABLE CODE FRAGMENTS ARE ABOVE THIS MESSAGE. DO NOT EDIT BELOW
     *  THIS UP TO NOAD SECTION.
     **************************************************************************/

    $mkhoj_siteid = '4028cba62fbf5039012fdd24748b00fa';
    if( !isset($mkhoj_mkids) ) $mkhoj_mkids  = '';

    $mkhoj_pdata  = array( 
        'mk-siteid=' . $mkhoj_siteid,
        'mk-carrier=' . rawurlencode($_SERVER['REMOTE_ADDR']),
        'mk-version=el-QEQE-CTATE-20090805',
        'mk-placement=' . $mkhoj_plc,
        'mk-sessionid=' . $mkhoj_sessionid,
        'mk-mkids=' . $mkhoj_mkids );

    $mkhoj_prot = 'http';
    if( !empty($_SERVER['HTTPS']) && ('on' === $_SERVER['HTTPS']) ) 
        $mkhoj_prot .= 's';
    array_push(  $mkhoj_pdata, 'h-page-url=' . rawurlencode($mkhoj_prot .
                 '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) );

    if( array_key_exists('HTTP_ACCEPT', $_SERVER) )
        array_push( $mkhoj_pdata, 'h-accept=' . rawurlencode( 
                                                  $_SERVER['HTTP_ACCEPT']) );
    if( array_key_exists('HTTP_REFERER', $_SERVER) )
        array_push( $mkhoj_pdata, 'h-referer=' . rawurlencode(
                                                 $_SERVER['HTTP_REFERER']) );
    if( array_key_exists('HTTP_USER_AGENT', $_SERVER) )
        array_push( $mkhoj_pdata, 'h-user-agent=' . rawurlencode(
                                              $_SERVER['HTTP_USER_AGENT']) );

    $mkhoj_jchar = chr( 26 );
    foreach( $_SERVER as $mkhoj_key => $mkhoj_val )
    {
        if(   0 === strpos($mkhoj_key, 'HTTP_X') )
        {
            $mkhoj_key = str_replace(array('HTTP_X_', '_'), 
                                     array('x-', '-'), $mkhoj_key);
            if( is_array($mkhoj_val) )
                $mkhoj_val = rawurlencode( join( $mkhoj_jchar, $mkhoj_val) );
            else
                $mkhoj_val = rawurlencode($mkhoj_val);
            array_push($mkhoj_pdata, strtolower($mkhoj_key) . '=' . $mkhoj_val);
        }
    }

    $mkhoj_post    = join( '&', $mkhoj_pdata );
    $mkhoj_url     = $mkhoj_test 
             ? 'http://w.sandbox.mkhoj.com/showad.asm'
             : 'http://w.mkhoj.com/showad.asm';
    $mkhoj_timeout = 12;

    $mkhoj_copt = array (
        CURLOPT_URL             => $mkhoj_url,
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_HEADER          => false,
        CURLOPT_HTTPPROXYTUNNEL => true,
        CURLOPT_POST            => true,
        CURLOPT_POSTFIELDS      => $mkhoj_post,
        CURLOPT_CONNECTTIMEOUT  => $mkhoj_timeout,
        CURLOPT_TIMEOUT         => $mkhoj_timeout,
        CURLOPT_HTTPHEADER      => array (
            'Content-Type: application/x-www-form-urlencoded',
            'X-mKhoj-SiteId: ' . $mkhoj_siteid )
        );
    $mkhoj_ch = curl_init();
    curl_setopt_array( $mkhoj_ch, $mkhoj_copt );

    $mkhoj_response = curl_exec($mkhoj_ch);

    curl_close($mkhoj_ch);

    if( null !== $mkhoj_response )
        echo( $mkhoj_response );

    /*************************************************************************
     *  THIS 'IF' BLOCK CONFIRMS IF THERE WASN'T ANY AD. USE THIS BLOCK FOR
     *  BACK-FILLING THIS PLACE OR ENTER SOME OTHER COMPATIBLE WAP HREF TAG
     *  HERE TO SHOW TEXT/URL. E.G. <a href="http://www.mkhoj.com">mKhoj</a>
     *************************************************************************/
    if( null == $mkhoj_response || preg_match('/^\<\!--.*--\>$/', $mkhoj_response) )
    {
    }
?>
