<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @kasimir-theme
 */

?>

	</div><!-- #content -->

	<?php kasimir_do_sidebar( 'widgets-footer-top' ); ?>

	<?php kasimir_do_sidebar( 'widgets-footer-middle' ); ?>

	<?php kasimir_do_sidebar( 'widgets-footer-bottom' ); ?>

	<footer class="site-footer">
		<div class="wrap">

			<div class="site-info">
				<?php kasimir_do_copyright_text(); ?>
			</div>

		</div><!-- .wrap -->
	</footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
