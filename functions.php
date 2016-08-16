<?php
/**
 * kasimir functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @kasimir-theme
 */

if ( ! function_exists( 'kasimir_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kasimir_setup() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on kasimir, use a find and replace
	 * to change 'kasimir-theme' to the name of your theme in all the template files.
	 * You will also need to update the Gulpfile with the new text domain
	 * and matching destination POT file.
	 */
	load_theme_textdomain( 'kasimir-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'kasimir-theme' ),
	) );

	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add styles to the post editor
	add_editor_style( array( 'editor-style.css', kasimir_font_url() ) );

	// add image size for logo
	add_image_size('kasimir-logo', 160, 140);
	add_image_size('kasimir-content-image', 720, 400);
	add_image_size('kasimir-articlegrid-image', 210, 210);

}
endif; // kasimir_setup
add_action( 'after_setup_theme', 'kasimir_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kasimir_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kasimir_content_width', 640 );
}
add_action( 'after_setup_theme', 'kasimir_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kasimir_widgets_init() {

	// Define sidebars
	$sidebars = array(
		'widgets-left'  => esc_html__( 'Widgets left column (below navigation)', 'kasimir-theme' ),
		'widgets-footer-top'  => esc_html__( 'Widgets footer (top)', 'kasimir-theme' ),
		'widgets-footer-middle'  => esc_html__( 'Widgets footer (middle - 1 line)', 'kasimir-theme' ),
		'widgets-footer-bottom'  => esc_html__( 'Widgets footer (bottom)', 'kasimir-theme' ),
	);

	// Loop through each sidebar and register
	foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
		register_sidebar( array(
			'name'          => $sidebar_name,
			'id'            => $sidebar_id,
			'description'   => sprintf ( esc_html__( 'Widget area for %s', 'kasimir-theme' ), $sidebar_name ),
			'before_widget' => '<aside class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

}
add_action( 'widgets_init', 'kasimir_widgets_init' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom shortcodes for this theme.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load styles and scripts.
 */
require get_template_directory() . '/inc/scripts.php';
