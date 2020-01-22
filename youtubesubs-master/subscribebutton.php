<?php
/*
Plugin Name: YouTube Subs
Plugin URI: https://anjaliv.sgedu.site/wordpress03/
Description: Display a Button of YouTube Subscription and show subscriber count
Version: 1.0.0
Author: Anjali Verma
Author URI: https://anjaliv.sgedu.site/wordpress03/
*/

// Exit if accessed directly
if(!defined('ABSPATH')){
  exit;
}

// Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/subscribebutton-scripts.php');

// Load Class
require_once(plugin_dir_path(__FILE__).'/includes/subscribebutton-class.php');

// Register Widget
function register_subscribebutton(){
  register_widget('Youtube_Subs_Widget');
}

// Hook in function
add_action('widgets_init', 'register_subscribebutton');