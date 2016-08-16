<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @kasimir-theme
 */

get_header(); ?>

	<div class="wrap">
		<div class="primary content-area">
			<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();
	
				get_template_part( 'template-parts/content', get_post_format() );

				the_post_navigation();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- .primary -->

	</div><!-- .wrap -->
	
	</div><!-- .wrap (header.php) -->


	<div class="widget-footer">
		<div class="wrap">

			<?php get_sidebar(); ?>
		
		</div><!-- .wrap -->
	</div><!-- .widget-footer -->
<?php get_footer(); ?>