<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); 
include 'inc/blueimp-template.php';
?>

<style>
	#container {
		opacity: 0;
		left: 100px;
		visibility: hidden;
	}
</style>
<?php include 'inc/blueimp-template.php'; ?>
	
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
			<div id="container"> 
			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', 'rowcategory' );
				
			// End the loop.
			endwhile;

			?> </div> <!-- #container -->
		<?php
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) );
			
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
			
		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>

<script src="<?php echo get_stylesheet_directory_uri() . '/js/freewall-call.js';?>" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/js/blueimp-call.js';?>" type="text/javascript"></script>