
<?php
/*
Plugin Name: Subscribe Button
Plugin URI: https://anjaliv.sgedu.site/wordpress03/
Description: Display subcribe button and count
Version: 1.0.0
Author: Anjali Verma
Author URI: https://anjaliv.sgedu.site/wordpress03/
*/

// Exit if accessed directly
if(!defined('ABSPATH')){
    exit;

}

//Class
require_once(plugin_dir_path(__FILE__).'/includes/Subs_Scripts.php');


//Script
require_once(plugin_dir_path(__FILE__).'/includes/Subs_Class.php');

//Register
function register_subs(){
    register_widget('Subscribe_Button_Widget');
}


//Hook in Function
add_action('widgets_init','register_subs');