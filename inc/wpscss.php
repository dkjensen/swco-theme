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

/*
$seo_default_colors = array(
	'color-text'	=> '#333333',
	'color-button'  => '#333333',
	'color-link' 	=> '#dddddd',
	'color-white'	=> '#ffffff',
	'color-outline'	=> '#eeeeee',
);

function seo_set_variables(){
    
    global $seo_default_colors;

    $variables = array();

    foreach( $seo_default_colors as $key => $value ) {
    	$variables[$key] = get_theme_mod( $key, $value );
    }

	return $variables;
}
//add_filter( 'wp_scss_variables', 'seo_set_variables' );
*/