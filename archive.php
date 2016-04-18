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

get_header(); ?>

<style>
	#container {
		width: 80%;
		opacity: 0;
		/*padding: 1% 7.6923%;*/
		left: 100px;
		visibility: hidden;
		margin: 0 12%;
	}
	  
	#container a {
		-webkit-transition: all 0.3s ease !important;;
		-moz-transition: all 0.3s ease !important;;
		-ms-transition: all 0.3s ease !important;
		-o-transition: all 0.3s ease !important;
		transition: all 0.3s ease !important;
	}
	
	#container:hover > a {
		opacity: 0.5 !important;
	}

	#container:hover > a:hover {
		opacity: 1 !important;
	}
</style>
	<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
	<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
		<div class="slides"></div>
		<h3 class="title"></h3>
		<a class="prev">‹</a>
		<a class="next">›</a>
		<a class="close">×</a>
		<a class="play-pause"></a>
		<ol class="indicator"></ol>
	</div>
	
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
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
			
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) );
			?> </div> <!-- #container -->
		<?php
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
			
		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>

<script type="text/javascript">
(function($){
	$(document).ready(function() {
		// fire freewall first
		var wall = new freewall("#container");
		wall.reset({
			fixSize: 0,
			gutterY: 10,
			gutterX: 10,
			animate: 0,
			keepOrder: 1,
		})
		wall.fitWidth();
		
		// then animate all div
		$( "#container" ).css({
			opacity: "0",
			left: "+100",
			visibility: "visible"});
		$( "#container" ).animate({
			opacity: "1",
			left: "0",
		  }, 1000, function() {
			// Animation complete -> reset freewall and add onResize Option
			$(function() {
				$("#container").each(function() {
					var wall = new freewall(this);
					wall.reset({
						fixSize: 0,
						gutterY: 10,
						gutterX: 10,
						keepOrder: 1,
						onResize: function() {
							wall.fitWidth();
						}
					})
					wall.fitWidth();
				});
				$(window).trigger("resize");
			});
		});
	});
})( jQuery );
</script>

<script>
document.getElementById('container').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
	//var target = event.target.parentNode.children[0] || event.srcElement,
        //link = target.src ? target.parentNode : target,
        link = target.parentNode,
		options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};
</script>

