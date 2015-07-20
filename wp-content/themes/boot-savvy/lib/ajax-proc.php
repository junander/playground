<?php

//mimic the actual admin-ajax
define('DOING_AJAX', true);

// Require an action parameter
if (empty($_REQUEST['action']))
    die('0');

//ini_set('html_errors', 0);

//make sure we skip most of the loading which we might not need
//http://core.trac.wordpress.org/browser/branches/3.4/wp-settings.php#L99
//define('SHORTINIT', true);

//make sure you update this line 
//to the relative location of the wp-load.php
require_once('../../../../wp-load.php');

//Typical headers
header('Content-Type: text/html');
send_nosniff_header();

//Disable caching
header('Cache-Control: no-cache');
header('Pragma: no-cache');

//Include only the files and function we need
/*require( ABSPATH . WPINC . '/meta.php' );
require( ABSPATH . WPINC . '/post.php' );
require( ABSPATH . WPINC . '/capabilities.php' );
require( ABSPATH . WPINC . '/user.php' );
require( ABSPATH . WPINC . '/pluggable.php' );
require( ABSPATH . WPINC . '/formatting.php' );

define( 'WP_CONTENT_URL', ABSPATH . 'wp-content' );
require( ABSPATH . WPINC . '/link-template.php' );
require( ABSPATH . WPINC . '/theme.php' );
wp_plugin_directory_constants();*/

require_once( 'ajax-funcs.php');
//require_once( get_stylesheet_directory_uri(). '/lib/post-funcs.php');


$action = esc_attr(trim($_GET['action']));

//A bit of security
$allowed_actions = array(
    '',
);

if(in_array($action, $allowed_actions)){
    if(is_user_logged_in())
        do_action('MY_AJAX_HANDLER_'.$action);
    else
        do_action('MY_AJAX_HANDLER_nopriv_'.$action);
    die('end');                            
}
else{
    die('-1');
} 