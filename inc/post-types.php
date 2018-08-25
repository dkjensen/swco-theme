<?php
/**
 * Post types
 * 
 * @package _s
 */

 
function _s_post_types() {
    register_post_type( 'portfolio', array(
        'labels'                => array(
            'name'               => _x( 'Portfolio Items', 'post type general name', 'your-plugin-textdomain' ),
            'singular_name'      => _x( 'Portfolio Item', 'post type singular name', 'your-plugin-textdomain' ),
            'menu_name'          => _x( 'Portfolio', 'admin menu', 'your-plugin-textdomain' ),
            'name_admin_bar'     => _x( 'Portfolio Item', 'add new on admin bar', 'your-plugin-textdomain' ),
            'add_new'            => _x( 'Add New', 'portfolio item', 'your-plugin-textdomain' ),
            'add_new_item'       => __( 'Add New Portfolio Item', 'your-plugin-textdomain' ),
            'new_item'           => __( 'New Portfolio Item', 'your-plugin-textdomain' ),
            'edit_item'          => __( 'Edit Portfolio Item', 'your-plugin-textdomain' ),
            'view_item'          => __( 'View Portfolio Item', 'your-plugin-textdomain' ),
            'all_items'          => __( 'All Portfolio Items', 'your-plugin-textdomain' ),
            'search_items'       => __( 'Search Portfolio Items', 'your-plugin-textdomain' ),
            'parent_item_colon'  => __( 'Parent Portfolio Items:', 'your-plugin-textdomain' ),
            'not_found'          => __( 'No portfolio items found.', 'your-plugin-textdomain' ),
            'not_found_in_trash' => __( 'No portfolio items found in Trash.', 'your-plugin-textdomain' )
        ),
        'public'                => true,
        'show_ui'               => true,
        'has_archive'           => false,
        'hierarchical'          => false,
        'publicly_queryable'    => false,
        'menu_icon'             => 'dashicons-images-alt2',
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'            => array( 'category' )
    ) );
}
add_action( 'init', '_s_post_types' );