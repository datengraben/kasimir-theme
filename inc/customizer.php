<?php
/**
 * kasimir Theme Customizer.
 *
 * @kasimir-theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kasimir_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';


    // Add our Footer Customization section section.
    $wp_customize->add_section(
        'kasimir_footer_section',
        array(
            'title'    => esc_html__( 'Footer Customization', 'kasimir-theme' ),
            'priority' => 90,
        )
    );

    // Add our copyright text field.
    $wp_customize->add_setting(
        'kasimir_copyright_text',
        array(
            'default' => ''
        )
    );
    $wp_customize->add_control(
        'kasimir_copyright_text',
        array(
            'label'       => esc_html__( 'Copyright Text', 'kasimir-theme' ),
            'description' => esc_html__( 'The copyright text will be displayed beneath the menu in the footer.', 'kasimir-theme' ),
            'section'     => 'kasimir_footer_section',
            'type'        => 'text',
            'sanitize'    => 'html'
        )
    );
}
add_action( 'customize_register', 'kasimir_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kasimir_customize_preview_js() {
    wp_enqueue_script( 'kasimir_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'kasimir_customize_preview_js' );

/**
 * Sanitize our customizer text inputs.
 */
function kasimir_sanitize_customizer_text( $input ) {
    return sanitize_text_field( force_balance_tags( $input ) );
}

/**
 * Sanitize our customizer URL inputs.
 */
function kasimir_sanitize_customizer_url( $input ) {
    return esc_url( $input );
}
