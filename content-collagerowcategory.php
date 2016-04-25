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

$url_full = wp_get_attachment_image_src ( get_post_thumbnail_id($post->ID),'large');
$url_full = $url_full[0];

/*print_r("url_full : ".$url_full);
echo "<br>";
print_r("catch url_full : ".catch_that_image());
echo "<br>";
print_r("not url_full : ".!$url_full);
echo "<br>";*/

if (!$url_full && catch_that_image()) {
	$img = catch_that_image();
	$url = $img[0];
	$url_full = $url;
} else {
	$url = wp_get_attachment_image_src ( get_post_thumbnail_id($post->ID),'large');
	$url = $url[0];
	$img = wp_get_attachment_image_src ( get_post_thumbnail_id($post->ID),'full');
	$url_full = $img[0];
}


//$url = wp_get_attachment_image_src ( get_post_thumbnail_id($post->ID),'large')->0;
//$img = wp_get_attachment_image_src ( get_post_thumbnail_id($post->ID),'full');
$ratio = $img[1]/$img[2];
$width = 300 *($img[1]/$img[2]);
$width = "200px";
$height = "200px";
?>
<img src="<?php echo $url_full; ?>" alt="Bananas">

