<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * Scripts
 *
 * @since 1.0
 */
function Image_Gallery_scripts() {

	global $post;

	// return if post object is not set
	if ( !isset( $post->ID ) )
		return;

	// JS
	wp_register_script( 'pretty-photo', Image_Gallery_URL . 'includes/lib/prettyphoto/jquery.prettyPhoto.js', array( 'jquery' ), Image_Gallery_VERSION, true );
	wp_register_script( 'fancybox', Image_Gallery_URL . 'includes/lib/fancybox/jquery.fancybox.min.js', array( 'jquery' ), Image_Gallery_VERSION, true );
	wp_register_script( 'luminous', Image_Gallery_URL . 'includes/lib/luminous/dist/Luminous.min.js', array( 'jquery' ), Image_Gallery_VERSION, false );

	// CSS
	wp_register_style( 'pretty-photo', Image_Gallery_URL . 'includes/lib/prettyphoto/prettyPhoto.css', '', Image_Gallery_VERSION, 'screen' );
	wp_register_style( 'fancybox', Image_Gallery_URL . 'includes/lib/fancybox/jquery.fancybox.min.css', '', Image_Gallery_VERSION, 'screen' );

	// create a new 'css/easy-image-gallery.css' in your child theme to override CSS file completely
	if ( file_exists( get_stylesheet_directory() . '/css/easy-image-gallery.css' ) )
		wp_register_style( 'easy-image-gallery', get_stylesheet_directory_uri() . '/css/easy-image-gallery.css', '', Image_Gallery_VERSION, 'screen' );
	else
		wp_register_style( 'easy-image-gallery', Image_Gallery_URL . 'includes/css/easy-image-gallery.css', '', Image_Gallery_VERSION, 'screen' );

	// post type is not allowed, return
	if ( ! Image_Gallery_allowed_post_type() )
		return;

	// needs to load only when there is a gallery
	if ( Image_Gallery_is_gallery() )
		wp_enqueue_style( 'easy-image-gallery' );

	$linked_images = true;
	$gutenberg_galleries = Image_Gallery_if_gutenberg_block();

	if ( ! empty( $gutenberg_galleries ) ) {
		foreach( $gutenberg_galleries as $value ) {
			// CSS
			wp_enqueue_style( $value );

			// JS
			wp_enqueue_script( $value );
		}
	}

	// only load the JS if gallery images are linked or the featured image is linked
	if ( $linked_images ) {

		$lightbox = Image_Gallery_get_lightbox();

		// Scripts that we need to remove for proper plugin functionality
		wp_dequeue_script( 'magnific-popup' ); // OceanWP theme
		wp_dequeue_script( 'oceanwp-lightbox' ); // OceanWP theme

		switch ( $lightbox ) {
				
				case 'prettyphoto':
					
					// CSS
					wp_enqueue_style( 'pretty-photo' );

					// JS
					wp_enqueue_script( 'pretty-photo' );

				break;
				
				case 'fancybox':

					// CSS
					wp_enqueue_style( 'fancybox' );

					// JS
					wp_enqueue_script( 'fancybox' );

				break;

				case 'luminous':

					// JS
					wp_enqueue_script( 'luminous' );

				break;

				default:
					

					break;
			}

		// allow developers to load their own scripts here
		do_action( 'Image_Gallery_scripts' );

	}

}
add_action( 'wp_enqueue_scripts', 'Image_Gallery_scripts', 20 );

/**
 * Checking if we have the Easy Image Gallery Gutenberg block in the post content
 *
 * @since 1.4.0
 */
function Image_Gallery_if_gutenberg_block() {
	global $post;

	if ( ! function_exists( 'has_blocks' ) ) {
		return false;
	}

	$arr_lightboxes = array();

	if ( has_blocks( $post->post_content ) ) {
		$blocks = parse_blocks( $post->post_content );
		$arr_attrs = array_column( $blocks, 'attrs' );

		if( in_array( 'devrix/easy-image-gallery-block', array_column( $blocks, 'blockName' ) ) ) {
			$arr_lightboxes = array_column( $arr_attrs, 'lightbox_option' );
		}
	}

	return array_unique( $arr_lightboxes );
}


/**
 * JS
 *
 * @since 1.0
 */
function Image_Gallery_js() {

	if ( ! Image_Gallery_allowed_post_type() || ! Image_Gallery_is_gallery() )
		return;

	if ( is_singular() ) : ?>

		<?php

			$lightbox = Image_Gallery_get_lightbox();

			switch ( $lightbox ) {
				
				case 'prettyphoto': ob_start(); ?>
					
					<script>
					  jQuery(document).ready(function() {
					    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
					    	social_tools : false,
					    	show_title : false
					    });
					  });
					</script>

					<?php 
						$js = ob_get_clean();
						echo apply_filters( 'Image_Gallery_prettyphoto_js', $js );
					?>

				<?php break;
				
				case 'fancybox': ob_start(); ?>

					<script>
						jQuery(document).ready(function() {

							jQuery("a.eig-popup:not([rel])").attr('rel', 'fancybox').fancybox({
								'transitionIn'	:	'elastic',
								'transitionOut'	:	'elastic',
								'speedIn'		:	200,
								'speedOut'		:	200,
								'overlayShow'	:	false
							});

						});
					</script>

					<?php 
						$js = ob_get_clean();
						echo apply_filters( 'Image_Gallery_fancybox_js', $js );
					?>

				<?php break;


				default:
					
					break;
			}

			// allow developers to add/modify JS 
			do_action( 'Image_Gallery_js', $lightbox );
		?>

    <?php endif; ?>

<?php }
add_action( 'wp_footer', 'Image_Gallery_js', 20 );


function Image_Gallery_admin_scripts() {
    wp_enqueue_script( 'repeatable-fields', Image_Gallery_URL . 'includes/lib/repeatable-fields.js', array('jquery', 'jquery-ui-core') );
    wp_enqueue_style( 'Image_Gallery_admin_css', Image_Gallery_URL . 'includes/css/easy-image-gallery-admin.css' );
}

add_action( 'admin_head', 'Image_Gallery_admin_scripts' );