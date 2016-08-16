<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @kasimir-theme
 */

?>
	<div <?php post_class(); ?>>
		<div class="articlegrid-image" style="background-image: url(<?php echo kasimir_get_post_image_uri('kasimir-articlegrid-image'); ?>)">
			<a href="<?php the_permalink(); ?>"><span class="articlegrid-label">
				<?php the_title(); ?>
			</span>
			</a>
		</div>

	</div>