<?php 
/**
 * Shortcodes.
 *
 * @kasimir-theme
 */



// [article_list foo="foo-value"]
function kasimir_article_list_shortcode( $atts ) {
    
    $a = shortcode_atts( array(
        'template' => 'content',
		'post_type' => 'post',
		'orderby' => 'date',
		'category_name' => '',
		'posts_per_page' => 3,
    	), $atts );

    $template = array_shift( $a );

    return kasimir_do_article_list( $template, $a );
}
add_shortcode( 'article_list', 'kasimir_article_list_shortcode' );

?>