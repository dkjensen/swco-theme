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
			'selector'        => '.site-branding',
			'render_callback' => '_s_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => '_s_customize_partial_blogdescription',
		) );

		$wp_customize->selective_refresh->add_partial( 'site_info', array(
			'selector'        => '.site-info',
			'render_callback' => '_s_customize_partial_site_info',
		) );
	}

	$custom_logo_args = get_theme_support( 'custom-logo' );

	$wp_customize->add_setting( 'custom_logo_alt', array(
		'theme_supports' => array( 'custom-logo' ),
		'transport'      => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'custom_logo_alt', array(
		'label'         => __( 'Color Logo' ),
		'section'       => 'title_tagline',
		'priority'      => 8,
		'height'        => $custom_logo_args[0]['height'],
		'width'         => $custom_logo_args[0]['width'],
		'flex_height'   => $custom_logo_args[0]['flex-height'],
		'flex_width'    => $custom_logo_args[0]['flex-width'],
		'button_labels' => array(
			'select'       => __( 'Select logo' ),
			'change'       => __( 'Change logo' ),
			'remove'       => __( 'Remove' ),
			'default'      => __( 'Default' ),
			'placeholder'  => __( 'No logo selected' ),
			'frame_title'  => __( 'Select logo' ),
			'frame_button' => __( 'Choose logo' ),
		),
	) ) );

	$wp_customize->selective_refresh->add_partial( 'custom_logo_alt', array(
		'settings'            => array( 'custom_logo_alt' ),
		'selector'            => '.custom-logo-link-alt',
		'render_callback'     => array( $wp_customize, '_render_custom_logo_partial' ),
		'container_inclusive' => true,
	) );

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
	 * Header
	 */
	$wp_customize->add_section( '_s_header', array(
        'title'    => __( 'Header', '_s' ),
        'priority' => 140,
    ) );
    
    $wp_customize->add_setting( 'header_text_color', array(
		'default' 			=> '1',
		'capability'     	=> 'edit_theme_options',
	) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
		'label' => 'Text Color',
		'section' => '_s_header',
		'settings' => 'header_text_color',
	) ) );

    $wp_customize->add_setting( 'header_background_color', array(
		'default' 			=> '1',
		'capability'     	=> 'edit_theme_options',
	) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label' => 'Background Color',
		'section' => '_s_header',
		'settings' => 'header_background_color',
	) ) );

	$wp_customize->add_setting( 'header_layout', array(
		'default' 			=> 'default',
		'capability'     	=> 'edit_theme_options',
	) );
	
	$wp_customize->add_control( '_s_header_layout', array(
		'label' 		=> __( 'Header Layout', '_s' ),
		'section' 		=> '_s_header',
		'settings' 		=> 'header_layout',
		'type'			=> 'radio',
		'choices'		=> array(
			'default'		=> __( 'Default', '_s' ),
			'inline'		=> __( 'Inline', '_s' ),
			'split'			=> __( 'Split', '_s' ),
		)
	) );

	/**
	 * Footer
	 */
	$wp_customize->add_section( '_s_footer', array(
        'title'    => __( 'Footer', '_s' ),
        'priority' => 150,
    ) );

    $wp_customize->add_setting( 'footer_text_color', array(
		'default' 			=> '1',
		'capability'     	=> 'edit_theme_options',
	) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
		'label' => 'Text Color',
		'section' => '_s_footer',
		'settings' => 'footer_text_color',
	) ) );

    $wp_customize->add_setting( 'footer_background_color', array(
		'default' 			=> '1',
		'capability'     	=> 'edit_theme_options',
	) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_color', array(
		'label' => 'Background Color',
		'section' => '_s_footer',
		'settings' => 'footer_background_color',
	) ) );

	$wp_customize->add_setting( 'site_info', array(
		'default' 			=> '',
		'capability'     	=> 'edit_theme_options',
		'transport'			=> 'postMessage',
	) );
	
	$wp_customize->add_control( '_s_footer_site_info', array(
		'label' 		=> __( 'Footer Site Info', '_s' ),
		'section' 		=> '_s_footer',
		'settings' 		=> 'site_info',
		'type'			=> 'textarea',
	) );

	$wp_customize->add_setting( 'footer_columns', array(
		'default' 			=> '1',
		'capability'     	=> 'edit_theme_options',
	) );
	
	$wp_customize->add_control( '_s_footer_columns', array(
		'label' 		=> __( 'Footer Columns', '_s' ),
		'section' 		=> '_s_footer',
		'settings' 		=> 'footer_columns',
		'type'			=> 'radio',
		'choices'		=> array(
			'1'				=> __( 'One Column', '_s' ),
			'2'				=> __( 'Two Columns', '_s' ),
			'3'				=> __( 'Three Columns', '_s' ),
			'4'				=> __( 'Four Columns', '_s' ),
			'5'				=> __( 'Five Columns', '_s' ),
			'6'				=> __( 'Six Columns', '_s' ),
		)
	) );
	
	$wp_customize->add_setting( 'link_color', array(
		'type' 				=> 'option',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label' => 'Link Color',
		'section' => 'colors',
		'settings' => 'link_color',
	) ) );

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

	$wp_customize->add_setting( 'cart_menu_dropdown', array(
        'default'        => 'show',
        'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( '_s_woocommerce_cart_menu_dropdown', array(
		'type'		 	=> 'radio',
		'label'      	=> __( 'Show Cart Dropdown', '_s' ),
        'section'    	=> '_s_woocommerce',
		'settings'   	=> 'cart_menu_dropdown',
		'choices'   	 => array(
			'show'				=> __( 'Show', '_s' ),
			'hide'				=> __( 'Hide', '_s' ),
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
 * Render the footer site info section
 *
 * @return void
 */
function _s_customize_partial_site_info() {
	print apply_filters( 'comment_text', get_theme_mod( 'site_info' ) );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _s_customize_preview_js() {
	wp_enqueue_script( '_s-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', '_s_customize_preview_js' );


/**
 * Render customizer dynamic CSS
 */
function _s_dynamic_css() {

    $header_background_color = get_theme_mod( 'header_background_color', 'transparent' );
    $header_text_color = get_theme_mod( 'header_text_color', 'inherit' );
    $footer_background_color = get_theme_mod( 'footer_background_color', 'transparent' );
    $footer_text_color = get_theme_mod( 'footer_text_color', 'inherit' );

    $css  = "";
    $css .= ".site-header{color: {$header_text_color}; background-color: {$header_background_color};}";
    $css .= ".site-footer{color: {$footer_text_color}; background-color: {$footer_background_color};}";

    wp_add_inline_style( '_s-style', $css );
}

add_action( 'wp_enqueue_scripts', '_s_dynamic_css', 60 );