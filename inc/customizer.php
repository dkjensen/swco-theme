<?php
/**
 * _s Theme Customizer
 *
 * @package _s
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function _s_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => '_s_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => '_s_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_section( '_s_typography', array(
        'title'    => __( 'Typography', '_s' ),
        'priority' => 30,
	) );
	
	$wp_customize->add_setting( '_s_typography', array(
		'type' 				=> 'option',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	
	$wp_customize->add_section( '_s_woocommerce', array(
        'title'    => __( 'WooCommerce', '_s' ),
        'priority' => 120,
    ) );

	/**
	 * Shop Layout
	 */
    $wp_customize->add_setting( 'shop_layout', array(
        'default'        => 'sidebar-left',
        'capability'     => 'edit_theme_options',
	) );
	
    $wp_customize->add_control( '_s_woocommerce_shop_layout', array(
		'type'		 	=> 'radio',
		'label'      	=> __( 'Shop Layout', '_s' ),
		'description' 	=> __( 'Select the layout for the main WooCommerce shop page.', '_s' ),
        'section'    	=> '_s_woocommerce',
		'settings'   	=> 'shop_layout',
		'choices'    	=> array(
			'sidebar-none' 		=> __( 'No Sidebar', '_s' ),
			'sidebar-left'		=> __( 'Left Sidebar', '_s' ),
			'sidebar-right'		=> __( 'Right Sidebar', '_s' ),
		)
	) );
	
	/**
	 * Single Product Layout
	 */
	$wp_customize->add_setting( 'product_layout', array(
        'default'        => 'default',
        'capability'     => 'edit_theme_options',
	) );
	
    $wp_customize->add_control( '_s_woocommerce_product_layout', array(
		'type'		 	=> 'radio',
		'label'      	=> __( 'Single Product Template', '_s' ),
		'description' 	=> __( 'Default Template inherits from the \'Shop Layout\' option.', '_s' ),
        'section'    	=> '_s_woocommerce',
		'settings'   	=> 'product_layout',
		'choices'   	 => array(
			'default'			=> __( 'Default Template', '_s' ),
			'hero'				=> __( 'Hero Template', '_s' ),
		)
	) );
}
add_action( 'customize_register', '_s_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function _s_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function _s_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _s_customize_preview_js() {
	wp_enqueue_script( '_s-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', '_s_customize_preview_js' );