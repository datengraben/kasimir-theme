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
	
	do_action( 'qm/debug', is_writable('/tmp'));

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


add_filter('edit_profile_url', 'my_edit_profile_url', 10, 3);
function my_edit_profile_url($url, $user_id, $scheme) {
	if ( current_user_can( 'activate_plugins' ) ) {
		return $url;
	}
    return home_url('/user/');
}



/** Erweitert den Inhalt um Quellen-Angaben für Leichte Sprache Inhalte */
function da_leichtesprache_inhalt_erweitern_am_ende($content) {
    // Prüfen, ob wir uns im Haupt-Loop befinden und ob der Inhalt ein einzelner Beitrag oder eine Seite ist.
    if (is_singular() && in_the_loop() && is_main_query()) {
        // Der Text, der ans Ende des Inhalts hinzugefügt werden soll

		if ( pll_current_language() == 'leichte-sprache' ) {
			$zusatztext = '<p> Bilder: © Lebenshilfe für Menschen mit geistiger Behinderung Bremen e.V.,'
				. 'Illustrator: Stefan Albers, Atelier Fleetinsel, 2013</p>'
				. '<p>Text: © Büro für Einfache und Leichte Sprache der Lebenshilfe Gießen e.V.,'
				. 'Übersetzerin: Anja Sandtner, 2024</p>';
			
			// Den Zusatztext ans Ende des Inhalts hängen
			$content .= $zusatztext;
		}
    }

    return $content;
}

// Den Filter-Hook 'the_content' verwenden, um die Funktion aufzurufen
add_filter('the_content', 'da_leichtesprache_inhalt_erweitern_am_ende');



/*****************************************/
/** UNGENUZT *****************************/
/*** HIER FOLGT EIN ABSCHNITT ************/
/*** INDEM ICH ETWAS AUSPROBIER HABE *****/
/*****************************************/

/**
 * Returns true if a user_id has a given role or capability
 * 
 * @param int $user_id
 * @param string $role_or_cap Role or Capability
 * 
 * @return boolean
 */
function my_has_role($user_id, $role_or_cap) {

    $u = new \WP_User( $user_id );
    //$u->roles Wrong way to do it as in the accepted answer.
    $roles_and_caps = $u->get_role_caps(); //Correct way to do it as wp do multiple checks to fetch all roles

    if( isset ( $roles_and_caps[$role_or_cap] ) and $roles_and_caps[$role_or_cap] === true ) 
       {
           return true;
       }
 }

/**
 * Das sollte nicht-admins auf die /dashboard Seite verweisen (funtkioniert aber nicht und wird auch nicht genutzt)
 */
function cb_prevent_subscriber() {
	
	$is_cb_manager = my_has_role( get_current_user_id(), 'subscriber' );
	
	if ( ! ( is_admin() || $is_cb_manager ) ) { 
		// || in_array('cb_manager', wp_get_current_user()->roles) ) ) { 
		// // in_array( 'subscriber', (array) $user->roles ) ) {
		    wp_redirect( home_url( '/dashboard' ), 302 );
		    exit();
			// exit( wp_safe_redirect( '/dashboard' ) );
	}
    //if( ! current_user_can( 'switch_themes' ) )
	//} 
}

// add_action( 'load-index.php', 'cb_prevent_subscriber');
// add_action( 'load-profile.php', 'cb_prevent_subscriber');
// add_action( 'load-user-edit.php', 'cb_prevent_subscriber');


/*****************************************/
/**************** ABSCHNITT END **********/
/*****************************************/


/**** BEGIN WARTUNGS_EMAIL *****/

function _generate_wartung( $itemName, $bookingUrl ) {
	
	$url = "";
	if ( isset( $bookingUrl ) ) {
		$url = "Buchungs URL:%20" . $bookingUrl . "%0D%0A%0D%0A";
	}
	
	return "<div id=\"cb_info_mail\" class=\"cb-notice\"> <p>Melde technische Probleme während der Fahrt via <a href=\"mailto:werkstatt@dasallrad.org?subject=Mangelmeldung%20bei%20" . $itemName . "&body=Hallo Werkstatt-Team, bei meiner Buchung von " . $itemName . " hatte ich folgendes Problem:%0D%0A%0D%0A" . $url . "Danke und Gruß\">Mail über unsere Vorlage.</a></p></div>";
}

add_action( 'commonsbooking_before_item-single', 'da_add_reparatur_mail' );
function da_add_reparatur_mail() {
	global $templateData;
	$itemName = $templateData['post']->post_title;
	
	if ( is_user_logged_in() ) {
		echo _generate_wartung( $itemName, null );
	}
}

add_action( 'commonsbooking_before_booking-single', 'da_add_booking_reparatur_mail' );
function da_add_booking_reparatur_mail() {
	global $post;
	
	if (get_current_user_id() == $post->post_author) {
		
		$booking = new \CommonsBooking\Model\Booking( $post->ID );
		$bookingUrl = site_url() . "/cb_booking/" . $post->post_name . "/";
		
		echo _generate_wartung( $booking->getItem()->post_title, $bookingUrl );
	
	}
}
/**** END   WARTUNGS_EMAIL *****/


/**** BEGIN BELIEBTE ARTIKEL der letzten 30 tage ****/
/**
 * 
 */
function commonsbooking_popular_items() {

	// Entwicklung auskommentieren
	// delete_transient( 'dasallrad_popular_items' );
	
	if ( false === ( $featured = get_transient( 'dasallrad_popular_items' ) ) ) {
	
	$startTime = strtotime( '- 14 days' );
	$endTime   = strtotime( '+ 14 days' );
	
	$args = array(
			'post_type'   => \CommonsBooking\Wordpress\CustomPostType\Booking::$postType,
			// 'posts_per_page' => $perPage,
			// 'paged' => $page,
			'nopaging' => true,
			'orderby' => 'meta_value_num',
		    'meta_key' => \CommonsBooking\Model\Timeframe::REPETITION_START,
			// 'order' => 'ASC',
			'meta_query'  => array(
				'relation' => 'AND',
				array(
					'key'     => \CommonsBooking\Model\Timeframe::REPETITION_START,
					'value'   => $startTime,
					'compare' => '>=',
					'type'    => 'numeric',
				),
				array(
					'key'     => \CommonsBooking\Model\Timeframe::REPETITION_END,
					'value'   => $endTime,
					'compare' => '<=',
					'type'    => 'numeric',
				),
				/*array(
					'key'     => \CommonsBooking\Model\Timeframe::META_LOCATION_ID,
					'value'   => 21479,
					'compare' => '=',
				),*/
				/*array(
					'key'     => \CommonsBooking\Model\Timeframe::META_ITEM_ID,
					'value'   => 21799,
					'compare' => '=',
				),*/
				array(
					'key'     => 'type',
					'value'   => \CommonsBooking\Wordpress\CustomPostType\Timeframe::BOOKING_ID,
					'compare' => '=',
				),
			),
		); 
	
	$query = new WP_Query( $args );
	$models = array_map( function( $elem ) {
		return new \CommonsBooking\Model\Booking( $elem );
	}, $query->posts );
	
	// Counts bookings per Item
	$count_of_items = array();
		
	// Counts different user per booking per item
	$count_of_users_to_item = array();
	
	foreach ($models as $model) {

		$itemId = intval( get_post_meta( $model->ID, 'item-id', true ) );
		$userId = intval( $model->post_author );
		
		if ( ! array_key_exists( $itemId, $count_of_items ) ) {
			$count_of_items[ $itemId ] = 1;
			$count_of_users_to_item[ $itemId ] = array( $userId );
		} else {
			$count_of_items[ $itemId ] = $count_of_items[ $itemId ] + 1;
			if ( ! in_array( $userId, $count_of_users_to_item[ $itemId ] ) ) {
				array_push( $count_of_users_to_item[ $itemId ], $userId );
			}
		}
	}
		
	// Flatten userIds per Item (array) -> to get distinct user per item
	$result = array();
	foreach ($count_of_users_to_item as $item => $arrOfUsers) {
		$result[ $item ] = count( $arrOfUsers );
	}
	
	// Comparison function
	function cmp($a, $b) {
    	if ($a == $b) {
        	return 0;
    	}
    	return ($a > $b) ? -1 : 1;
	}
	
	// Sort by key
	$objs = new ArrayObject( $result );
	$objs->uasort('cmp');

		
	$maxResult = 5;
	$i = 1;
	$print = '';
	foreach ($objs as $id => $val) {
		if ($i <= $maxResult) {
			$item = new \CommonsBooking\Model\Item( $id );
			$item_name =  $item->post_title;			
		    $print .= '<figure class="cb-items-teaser wp-caption alignleft"><a href="'.get_permalink($item->ID).'">';
		    $print .= get_the_post_thumbnail($item->ID,'thumbnail');
		    $print .= '</a><figcaption class="wp-caption-text"><span class="green">' . $i . '. ' .$item_name.'</span></figcaption></figure>';
		}
		$i++;
	}
		
		// Put the results in a transient. Expire after 12 hours.
		set_transient( 'dasallrad_popular_items', $print, 72 * HOUR_IN_SECONDS );
		return $print;
	} else {
		return get_transient( 'dasallrad_popular_items' );
	}
}
add_shortcode( 'cb_popular_items', 'commonsbooking_popular_items');
/**** END   BELIEBTE ARTIKEL ****/

add_action( 'commonsbooking_after_booking-single', 'dasallrad_erste_buchung' );
function dasallrad_erste_buchung() {
	
	global $post;
	
	// If its the first booking for a user
	$numberOfSuccessfulBookings = (new WP_Query(
		array(
			'author' 	=> get_current_user_id(),
			'post_status'   => array( 'confirmed' ),
			'post_type'   => \CommonsBooking\Wordpress\CustomPostType\Booking::$postType,
			'meta_query'    => array(
				'relation'  => 'AND',
				array(
					'key'     => \CommonsBooking\Model\Timeframe::REPETITION_END,
					'value'   => strtotime( 'now' ),
					'compare' => '<=',
					'type'    => 'numeric',
				)
			)
		)
	))->found_posts;
	
	$booking = new \CommonsBooking\Model\Booking( $post->ID );	
	$result = new WP_Query(
		array(
			'post_type'   => \CommonsBooking\Wordpress\CustomPostType\Item::$postType,
			'tax_query' => array(
				array(
					'taxonomy' => 'cb_items_category',
					'field' => 'slug',
					'terms' => 'herausfordernd'
				)
			),
			'post__in'  => array( $booking->getItem()->ID )
		)
	);
	$isItemChallenging = $result->found_posts > 0;
	
	if ( $numberOfSuccessfulBookings == 0 || $isItemChallenging ) {
	
	echo "<div class=\"cb-notice\" style=\"padding-bottom: 10px;\">";
	echo "<p style=\"margin-top: 15px; margin-bottom: 5px;\">Hinweise:</p>";
	
	// Make them aware of general info for the booking process
	if ( $numberOfSuccessfulBookings == 0 ) {
		echo "<p style=\"font-weight: 100; font-size: 1rem; margin-bottom: 5px;\"><span style=\"font-size: 1.5rem; margin-right: 5px;\">🐣</span>Das ist deine erste Buchung, denke daran die <a href=\"https://dasallrad.org\">Leihvereinbarung</a> zu lesen.</p>";
	} 
	
	//  And optionally, make the aware of specialities for this item 
	if ( $isItemChallenging ) {
		echo "<p style=\"font-weight: 100; font-size: 1rem; margin-bottom: 5px;\"><span style=\"font-size: 1.8rem; margin-right: 5px;\">🦏</span>Du hast ein ALLrad gewählt, welches herausfordernd in der Bedienung ist! Achte auf eine sichere Fahrweise.</p>";
	}
	
	echo "</div>";
		
	}
}


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
