<?php
/**
 * Add custom height option for rows
 *
 * @param array $form
 * @param string $id
 * @return array
 */
function _s_bb_plugin_module_settings( $form, $id ) {
	if( 'row' == $id ) {
		$form['tabs']['style']['sections']['general']['fields']['full_height']['options']['hero'] = __( 'Hero', 'fl-builder' );
		$form['tabs']['style']['sections']['general']['fields']['full_height']['toggle']['hero']['fields'] = array( 'content_alignment' );
	}
	return $form;
}
add_filter( 'fl_builder_register_settings_form', '_s_bb_plugin_module_settings', 10, 2 );


/**
 * Add custom row classes for hero height
 *
 * @param array $attrs
 * @param object $row
 * @return array
 */
function _s_bb_plugin_row_attributes( $attrs, $row ) {
	if ( ! empty( $row->settings->full_height ) && 'hero' == $row->settings->full_height ) {
		$attrs['class'][] = 'fl-row-full-height fl-row-hero-height';
		if ( isset( $row->settings->content_alignment ) ) {
			$attrs['class'][] = 'fl-row-align-' . $row->settings->content_alignment;
		}
	}
	return $attrs;
}
add_filter( 'fl_builder_row_attributes', '_s_bb_plugin_row_attributes', 10, 2 );


/**
 * Add smooth scroll to anchor links on separate page
 *
 * @return void
 */
function _s_bb_plugin_smooth_scroll_mod() {
	?>

	<script>
		jQuery(document).ready(function($) {
			if (location.hash){
				setTimeout(function(){
					$('html, body').scrollTop(0).show();
					FLBuilderLayout._scrollToElement( $( location.hash ) );
				}, 0);
			}else{
				$('html, body').show();
			}
		});
	</script>

	<?php
}
add_action( 'wp_footer', '_s_bb_plugin_smooth_scroll_mod' );


function _s_bb_plugin_hide_title( $hide, $_post ) {
    if( FLBuilderModel::is_builder_enabled( $_post->ID ) ) {
        return true;
    }
    return $hide;
}
add_filter( 'hide_page_content_title', '_s_bb_plugin_hide_title', 10, 2 );