<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @kasimir-theme
 */

/**
 * Set up the WordPress core custom logo feature.
 *
 */
function kasimir_custom_logo_setup() {
 add_theme_support( 'custom-logo', array(
    'size' => 'kasimir-logo'
    ) );
}
add_action( 'after_setup_theme', 'kasimir_custom_logo_setup' );


if ( ! function_exists( 'kasimir_site_branding' ) ) :
/**
 * Custom Site branding, Logo
 *
 * @see kasimir_custom_header_setup().
 */
function kasimir_site_branding() {

	if ( !has_custom_logo() ) : // no custom Logo

		if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif;

  else : // has custom logo 

		the_custom_logo();

	endif;

	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) : ?>
		<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
	<?php endif;
}
endif; // kasimir_site_branding
