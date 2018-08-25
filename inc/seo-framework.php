<?php
/**
 * SEO Framework
 * 
 * @package _s
 */

 
function _s_seo_framework_robots_meta( $meta ) {
    if( 'portfolio' == get_post_type() || is_post_type_archive( 'portfolio' ) ) {
        $meta['noindex'] = 'noindex';
        $meta['nofollow'] = 'nofollow';
    }

    return $meta;
}
add_filter( 'the_seo_framework_robots_meta_array', '_s_seo_framework_robots_meta' );


add_filter( 'the_seo_framework_seobox_output', function( $output ) {
    if( 'portfolio' == get_post_type() ) {
        return false;
    }

    return $output;
} );