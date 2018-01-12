<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package _s
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _s_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', '_s_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function _s_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', '_s_pingback_header' );

/**
 * Displays the hero section for the hero page template
 */
function _s_hero_header() {
	if( is_page() && get_page_template_slug( get_queried_object_id() ) === 'templates/page-hero.php' ) {
		get_template_part( 'template-parts/hero/hero', '' );
	}
}
add_action( 'before_site_content', '_s_hero_header', 10 );


function _s_show_breadcrumbs() {
	_s_breadcrumbs();
}
add_action( 'before_site_main', '_s_show_breadcrumbs', 10 );


function _s_custom_logo( $logo, $blog_id ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if( empty( $custom_logo_id ) ) {
		$logo = sprintf( '<a href="%s" class="custom-logo-link" rel="home">%s</a>', esc_url( home_url( '/' ) ),  get_bloginfo( 'name' ) );
	}

	return $logo;
}
add_filter( 'get_custom_logo', '_s_custom_logo', 10, 2 );


function _s_page_content_title( $hide, $page ) {
	if( get_post_meta( get_the_ID(), 'hide_title', true ) ) {
		return true;
	}

	if( get_page_template_slug( $page->ID ) == 'templates/page-hero.php' ) {
		return true;
	}

	if( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_enabled() ) {
		return true;
	}

	return $hide;
}
add_filter( 'hide_page_content_title', '_s_page_content_title', 10, 2 );


add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );