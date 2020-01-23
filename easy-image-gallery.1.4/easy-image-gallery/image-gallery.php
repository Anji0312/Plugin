<?php
/*
Plugin Name: Discover Image
Plugin URI: https://anjaliv.sgedu.site/wordpress03/
Description: An easy to use image gallery with drag & drop re-ordering
Version: 1.4
Author: Anjali Verma
Author URI: https://anjaliv.sgedu.site/wordpress03/
Text Domain: image-gallery
License: GPL-2.0+
License URI: http://www.opensource.org/licenses/gpl-license.php
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Image_Gallery' ) ) {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	*/
	class Image_Gallery {

		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
			add_action( 'plugins_loaded', array( $this, 'constants' ));
			add_action( 'plugins_loaded', array( $this, 'includes' ) );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'Image_Gallery_plugin_action_links' );
		}

		/**
		 * Internationalization
		 *
		 * @since 1.0
		*/
		public function load_textdomain() {
			load_plugin_textdomain( 'image-gallery', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}


		/**
		 * Constants
		 *
		 * @since 1.0
		*/
		public function constants() {

			if ( !defined( 'Image_Gallery_DIR' ) )
				define( 'Image_Gallery_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

			if ( !defined( 'Image_Gallery_URL' ) )
			    define( 'Image_Gallery_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

			if ( ! defined( 'Image_Gallery_VERSION' ) )
			    define( 'Image_Gallery_VERSION', '1.2' );

			if ( ! defined( 'Image_Gallery_INCLUDES' ) )
			    define( 'Image_Gallery_INCLUDES', Image_Gallery_DIR . trailingslashit( 'includes' ) );

		}

		/**
		* Loads the initial files needed by the plugin.
		*
		* @since 1.0
		*/
		public function includes() {

			require_once( Image_Gallery_INCLUDES . 'template-functions.php' );
			require_once( Image_Gallery_INCLUDES . 'scripts.php' );
			require_once( Image_Gallery_INCLUDES . 'metabox.php' );
			require_once( Image_Gallery_INCLUDES . 'admin-page.php' );
			require_once( Image_Gallery_INCLUDES . 'gutenberg-block/plugin.php' );
		}

	}
}

$Image_Gallery = new Image_Gallery();
