<?php
/*
Template Name: Home page
*/

/**
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @kasimir-theme
 */

get_header(); ?>


		<div class="primary content-area">
			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- .primary -->

	</div><!-- .wrap -->

	
	</div><!-- .wrap (header.php) -->

<?php get_footer(); ?>