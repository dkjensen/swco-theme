<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _s
 */


if( ! function_exists( '_s_header_classes' ) ) :
	/**
	 * Outputs CSS classes for .site-header
	 *
	 * @param array $classes
	 */
	function _s_header_classes( $classes = [] ) {
		$classes[] = get_theme_mod( 'header_layout', 'default' );
		
		if( is_page() && get_page_template_slug( get_queried_object_id() ) === 'templates/page-hero.php' ) {
			$classes[] = 'hero';
		}

		echo implode( ' ', array_map( 'esc_attr', $classes ) );
	}

endif;

if ( ! function_exists( '_s_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function _s_posted_on() {
		$avatar = '<span class="author-avatar">' . get_avatar( get_the_author_meta( 'ID' ), 150 ) . '</span>';

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', '_s' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $avatar . $byline . '</span>'; // WPCS: XSS OK.

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="posted-on"><span class="dashicons dashicons-calendar-alt"></span> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';
	
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '_s' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( '_s_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function _s_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( '', 'list item separator', '_s' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">%1$s</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if( ! function_exists( '_s_breadcrumbs' ) ) :
	/**
	 * Displays the sites breadcrumbs
	 *
	 * @return void
	 */
	function _s_breadcrumbs() {
		if( get_theme_mod( 'breadcrumbs_enabled', true ) ) {
			if( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb( '<div class="breadcrumbs">', '</div>' );
			}elseif( function_exists( 'woocommerce_breadcrumb' ) ) {
				woocommerce_breadcrumb();
			}elseif( function_exists( 'bcn_display' ) ) {
				bcn_display( false, true, false, false );
			}
		}
	}	
endif;

if( ! function_exists( '_s_custom_logo_alt' ) ) :
	/**
	 * Displays the sites breadcrumbs
	 *
	 * @return void
	 */
	function _s_custom_logo_alt( $blog_id = 0 ) {
		$html = '';
		$switched_blog = false;
	
		if ( is_multisite() && ! empty( $blog_id ) && (int) $blog_id !== get_current_blog_id() ) {
			switch_to_blog( $blog_id );
			$switched_blog = true;
		}
	
		$custom_logo_alt_id = get_theme_mod( 'custom_logo_alt' );
	
		// We have a logo. Logo is go.
		if ( $custom_logo_alt_id ) {
			$custom_logo_alt_attr = array(
				'class'    => 'custom-alt-logo',
				'itemprop' => 'logo',
			);
	
			/*
			* If the logo alt attribute is empty, get the site title and explicitly
			* pass it to the attributes used by wp_get_attachment_image().
			*/
			$image_alt = get_post_meta( $custom_logo_alt_id, '_wp_attachment_image_alt', true );
			if ( empty( $image_alt ) ) {
				$custom_logo_alt_attr['alt'] = get_bloginfo( 'name', 'display' );
			}
	
			/*
			* If the alt attribute is not empty, there's no need to explicitly pass
			* it because wp_get_attachment_image() already adds the alt attribute.
			*/
			$html = sprintf( '<a href="%1$s" class="custom-logo-alt-link" rel="home" itemprop="url">%2$s</a>',
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image( $custom_logo_alt_id, 'full', false, $custom_logo_alt_attr )
			);
		}
	
		// If no logo is set but we're in the Customizer, leave a placeholder (needed for the live preview).
		elseif ( is_customize_preview() ) {
			$html = sprintf( '<a href="%1$s" class="custom-logo-alt-link" style="display:none;"><img class="custom-logo"/></a>',
				esc_url( home_url( '/' ) )
			);
		}
	
		if ( $switched_blog ) {
			restore_current_blog();
		}
	
		/**
		 * Filters the custom logo output.
		 *
		 * @since 4.5.0
		 * @since 4.6.0 Added the `$blog_id` parameter.
		 *
		 * @param string $html    Custom logo HTML output.
		 * @param int    $blog_id ID of the blog to get the custom logo for.
		 */
		print apply_filters( 'get_custom_logo_alt', $html, $blog_id );
	}	
endif;

if( ! function_exists( '_s_pagination' ) ) :
	/**
	 * Displays pagination
	 *
	 * @param integer $range
	 * @return void
	 */
	function _s_pagination( $range = 5 ) {
		global $wp_query;

		$pagination = array(
			'base'      => str_replace( 99999, '%#%', get_pagenum_link( 99999 ) ),
			'format'    => '?paged=%#%',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'next_text' => __( 'Next', '_s' ),
			'prev_text' => __( 'Previous', '_s' ),
		);
		echo '<div class="pagination primary-links gcol-12">' . paginate_links( $pagination ) . '</div>';
	}
endif;