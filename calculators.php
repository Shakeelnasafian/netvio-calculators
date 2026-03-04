<?php

/**
 * Plugin Name: Netvio-Calculators
 * Plugin URI:  https://github.com/Shakeelnasafian/netvio-calculators
 * Description: Create calculators and use shortcodes to display them on the frontend. Built with Alpine.js and Bootstrap.
 * Version:     2.0.0
 * Author:      Shakeel Ahmad
 * Author URI:  https://github.com/Shakeelnasafian
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: netvio-calculators
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plugin constants
define( 'NETVIO_CALC_VERSION', '2.0.0' );
define( 'NETVIO_CALC_FILE', __FILE__ );
define( 'NETVIO_CALC_PATH', plugin_dir_path( __FILE__ ) );
define( 'NETVIO_CALC_URL', plugin_dir_url( __FILE__ ) );
define( 'NETVIO_CALC_BASENAME', plugin_basename( __FILE__ ) );

// Autoload includes
require_once NETVIO_CALC_PATH . 'includes/class-plugin.php';
require_once NETVIO_CALC_PATH . 'includes/class-shortcode.php';

if ( is_admin() ) {
	require_once NETVIO_CALC_PATH . 'admin/class-admin.php';
}

// Activation hook
register_activation_hook( __FILE__, 'netvio_calc_activate' );
function netvio_calc_activate() {
	$template_dir = NETVIO_CALC_PATH . 'templates';
	if ( ! file_exists( $template_dir ) ) {
		wp_mkdir_p( $template_dir );
	}

	// Set default options on activation
	if ( false === get_option( 'netvio_calc_settings' ) ) {
		add_option( 'netvio_calc_settings', [
			'load_bootstrap'    => '1',
			'load_alpinejs'     => '1',
			'default_unit'      => 'metric',
			'primary_color'     => '#0d6efd',
			'result_color'      => '#198754',
			'card_max_width'    => '420',
			'disabled_calcs'    => [],
		] );
	}

	flush_rewrite_rules();
}

// Bootstrap the plugin
Netvio_Calculators_Plugin::get_instance();
