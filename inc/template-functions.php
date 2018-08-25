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

	if( is_singular() && get_page_template_slug( get_queried_object_id() ) === 'templates/page-hero.php' ) {
		$classes[] = 'hero';
	}

	return $classes;
}
add_filter( 'body_class', '_s_body_classes' );

function _s_back_to_top() {
	?>
	<div class="back-top"><a href="#page" rel="nofollow"><span class="dashicons dashicons-arrow-up-alt2"></span></a></div>
	<script>
		(function($) {
			jQuery(document).ready(function() {
				$(window).scroll(function() {
					if( $(this).scrollTop() > 200 ) {
						$(".back-top").addClass('reveal');
					}else{
						$(".back-top").removeClass('reveal');
					}
				});
				
				$(".back-top").click(function() {
					$("body,html").animate({ scrollTop: 0 }, 800);
				});
			});
		})(jQuery);
	</script>
	<?php
}
//add_filter( 'wp_footer', '_s_back_to_top' );

/**
 * Add custom image sizes to dropdown
 *
 * @param array $sizes
 * @return array
 */
function _s_custom_image_sizes( $sizes ) {
	global $_wp_additional_image_sizes;

	if( empty( $_wp_additional_image_sizes ) )
		return $sizes;

	foreach ( $_wp_additional_image_sizes as $id => $data ) {
		if( ! isset( $sizes[$id] ) )
			$sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );
	}

	return $sizes;
}
add_filter( 'image_size_names_choose', '_s_custom_image_sizes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function _s_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', '_s_pingback_header' );


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