<?php
/**
 * Fired when the plugin is uninstalled.
 * Removes all plugin options from the database.
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'netvio_calc_settings' );
flush_rewrite_rules();
