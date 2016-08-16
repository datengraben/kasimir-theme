<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @kasimir-theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php global $is_IE; if ( $is_IE ) : ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php endif; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<span class="svg-defs"><?php kasimir_include_svg_icons(); ?></span>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'kasimir-theme' ); ?></a>

	<div id="content" class="site-content">

	<div class="wrap">
	
	<div class="secondary navigation-area">
				<div class="site-branding">
				<?php kasimir_site_branding(); ?> 
			</div><!-- .site-branding -->
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="menu-toggle-text"><?php esc_html_e( 'Menu', 'kasimir-theme' ); ?></span></button>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_class'     => 'primary-menu menu dropdown'
				) );
			?>
		</nav><!-- #site-navigation -->

	<?php if ( is_active_sidebar( 'widgets-left' ) ) : ?>
		<div id="widgets-left" class="widgets-left widget-area" role="complementary">
			<?php dynamic_sidebar( 'widgets-left' ); ?>
		</div><!-- #primary-sidebar -->
	<?php endif; ?>


	</div>

