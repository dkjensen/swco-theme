<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Theme Updater
 */

// Includes the files needed for the theme updater
if ( ! class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
        'remote_api_url' => 'https://seattlewebco.com', // Site where EDD is hosted
        'item_name'      => 'Seattle Web Co. WordPress Starter Theme', // Name of theme
        'theme_slug'     => 'swco-theme', // Theme slug
        'version'        => '1.0.0', // The current version of this theme
        'author'         => 'Seattle Web Co.', // The author of this theme
        'download_id'    => '', // Optional, used for generating a license renewal link
        'renew_url'      => '', // Optional, allows for a custom license renewal link,
        'beta'           => false, // Optional, set to true to opt into beta versions
    ),

	// Strings
	$strings = array(
		'theme-license'             => _x( ' License', 'part of the WordPress dashboard _s menu title', '_s' ),
		'enter-key'                 => __( 'Enter your theme license key.', '_s' ),
		'license-key'               => __( 'License Key', '_s' ),
		'license-action'            => __( 'License Action', '_s' ),
		'deactivate-license'        => __( 'Deactivate License', '_s' ),
		'activate-license'          => __( 'Activate License', '_s' ),
		'status-unknown'            => __( 'License status is unknown.', '_s' ),
		'renew'                     => __( 'Renew?', '_s' ),
		'unlimited'                 => __( 'unlimited', '_s' ),
		'license-key-is-active'     => __( 'License key is active.', '_s' ),
		'expires%s'                 => __( 'Expires %s.', '_s' ),
		'lifetime'                  => __( 'Lifetime License.', '_s' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', '_s' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', '_s' ),
		'license-key-expired'       => __( 'License key has expired.', '_s' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', '_s' ),
		'license-is-inactive'       => __( 'License is inactive.', '_s' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', '_s' ),
		'site-is-inactive'          => __( 'Site is inactive.', '_s' ),
		'license-status-unknown'    => __( 'License status is unknown.', '_s' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", '_s' ),
		'update-available'          => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', '_s' )
	)

);