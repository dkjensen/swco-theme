<?php
/**
 * WP-SCSS
 *
 * @link https://github.com/ConnectThink/WP-SCSS
 *
 * @package _s
 */

/**
 * Define the default options for the WP-SCSS plugin
 *
 * @param mixed  $default The default value to return if the option does not exist
 *                        in the database.
 * @param string $option  Option name.
 * @param bool   $passed_default Was `get_option()` passed a default value?
 * 
 * @return mixed
 */
function _s_wpscss_options_defaults( $default, $option, $passed_default ) {
	if( empty( $default ) ) {
		$default = array(
			'scss_dir'	=> '/sass/custom/',
			'css_dir'   => '/',
			'compiling_options' => 'Leafo\ScssPhp\Formatter\Compressed',
			'errors'    => 'hide',
			'enqueue'   => 0
		);
	}

	return $default;
}
add_filter( 'default_option_wpscss_options', '_s_wpscss_options_defaults', 10, 3 );

/**
 * Variables from customizer to replace
 *
 * @return array
 */
function _s_wpscss_variables() {
    
    $default_variables = array(
		'color__link'	=> 'royalblue',
	);

    $variables = array();

    foreach( $default_variables as $key => $value ) {
    	$variables[$key] = get_theme_mod( $key, $value );
    }

	return $variables;
}
add_filter( 'wp_scss_variables', '_s_wpscss_variables' );

if ( is_customize_preview() && ! defined( 'WP_SCSS_ALWAYS_RECOMPILE' ) ) {
	define( 'WP_SCSS_ALWAYS_RECOMPILE', true );
}