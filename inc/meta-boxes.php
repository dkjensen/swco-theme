<?php
/**
 * Post and term meta
 * 
 * @package _s
 */

 
function _s_meta_boxes() {
    global $post;

    add_meta_box( 'page_options', __( 'Page Options', '_s' ), '_s_page_options', 'page', 'side' );
}
add_action( 'add_meta_boxes', '_s_meta_boxes' );


/**
 * Callback for page options meta box
 */
function _s_page_options() {
    global $post;
    ?>

    <p><label for="hide_title"><input type="checkbox" name="hide_title" id="hide_title" value="1" <?php checked( 1, get_post_meta( $post->ID, 'hide_title', true ) ); ?> /> <?php _e( 'Hide Title', '_s' ); ?></label></p>

    <?php
}


function _s_save_meta_boxes( $post_id, $post, $update ) {
    if( defined( 'DOING_AJAX' ) && DOING_AJAX ) 
        return;

    if( 'page' !== get_post_type( $post_id ) )
        return;
        
    update_post_meta( $post_id, 'hide_title', ( isset( $_POST['hide_title'] ) ? (int) $_POST['hide_title'] : 0 ) );
}
add_action( 'save_post', '_s_save_meta_boxes', 10, 3 );

