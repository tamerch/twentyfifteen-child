<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteenchild_scripts() {
	wp_enqueue_script( 'freewall', get_stylesheet_directory_uri() . '/js/freewall/freewall.js', array(), '20141010', true );
	wp_enqueue_script( 'blueimp', get_stylesheet_directory_uri() . '/js/blueimp/blueimp-gallery.js', array(), '20141010', true );
	wp_enqueue_script( 'blueimp-indicator', get_stylesheet_directory_uri() . '/js/blueimp/blueimp-gallery-indicator.js', array(), '20141010', true );
	
	wp_enqueue_style( 'style-blueimp', get_stylesheet_directory_uri() . '/css/blueimp/blueimp-gallery.css' );
	wp_enqueue_style( 'style-blueimp-indicator', get_stylesheet_directory_uri() . '/css/blueimp/blueimp-gallery-indicator.css' );
	}
add_action( 'wp_enqueue_scripts', 'twentyfifteenchild_scripts' );

add_filter( 'get_the_archive_title', function ( $title ) {
    if( is_category() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
});

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  $output = preg_match_all('/<img.+width=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img_width = $matches [1] [0];
  $output = preg_match_all('/<img.+height=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img_height = $matches [1] [0];
  
  if(empty($first_img)){ //Defines a default image
    $first_img = null;
  }
  $size = getimagesize($first_img);
  $out = array(0 => $first_img , 1 => $size[0] , 2 => $size[1] );
  return $out;
}