<?php
  // Add Scripts
  function wps_add_scripts(){
    // Add Main CSS
    wp_enqueue_style('wps-main-style', plugins_url(). '/SubscribeButton/css/style.css');
    // Add Main JS
    wp_enqueue_script('wps-main-script', plugins_url(). '/SubscribeButton/js/main.js');

    // Add Google Script
    wp_register_script('google', 'https://apis.google.com/js/platform.js');
    wp_enqueue_script('google');
  }

  add_action('wp_enqueue_scripts', ' wps_add_scripts');



  