<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
$args = array(
	'post_parent' => $post->ID,
	'post_type'   => 'any', 
	'numberposts' => -1,
	'post_status' => 'any' 
); 
//print_r(get_children( $args )); 

$attachments = get_attached_media( '', $post->ID );
//print_r(catch_that_image()); 


if (catch_that_image()) {
	$url = catch_that_image();
} else {
	$url = wp_get_attachment_image_src ( get_post_thumbnail_id($post->ID),'large');
	$url = $url[0];
}


//$url = wp_get_attachment_image_src ( get_post_thumbnail_id($post->ID),'large')->0;
$src = wp_get_attachment_image_src ( get_post_thumbnail_id($post->ID),'full');
$ratio = $src[1]/$src[2];
$width = 300 *($src[1]/$src[2]);
?>
<a style="display:block" href="<?php echo get_permalink($post->ID) ?>">
  <div id="post-<?php echo $post->ID; ?>" class="item" style="background-size: cover;
    background-position: center; width: <?php echo $width ?>px; height: 300px; background-repeat: no-repeat; background-image:url('<?php echo $url ?>')">
</div>
</a>
<!-- #post-## -->

