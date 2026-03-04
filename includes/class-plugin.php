<?php
/**
 * Main plugin bootstrap class.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Netvio_Calculators_Plugin {

	/** @var self|null Singleton instance */
	private static $instance = null;

	public static function get_instance(): self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_assets' ] );
	}

	public function load_textdomain(): void {
		load_plugin_textdomain(
			'netvio-calculators',
			false,
			dirname( NETVIO_CALC_BASENAME ) . '/languages'
		);
	}

	/**
	 * Enqueue frontend assets — only on pages/posts that use the [calculator] shortcode.
	 */
	public function enqueue_frontend_assets(): void {
		global $post;

		// Only load assets if the shortcode is present on this page.
		if ( ! is_a( $post, 'WP_Post' ) || ! has_shortcode( $post->post_content, 'calculator' ) ) {
			return;
		}

		$settings = $this->get_settings();

		if ( ! empty( $settings['load_bootstrap'] ) ) {
			wp_enqueue_style(
				'netvio-bootstrap',
				'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
				[],
				'5.3.0'
			);
		}

		wp_enqueue_style(
			'netvio-calculators',
			NETVIO_CALC_URL . 'assets/calculators.css',
			[],
			NETVIO_CALC_VERSION
		);

		// Inline dynamic CSS from settings
		$primary = sanitize_hex_color( $settings['primary_color'] ?? '#0d6efd' );
		$result  = sanitize_hex_color( $settings['result_color'] ?? '#198754' );
		$width   = absint( $settings['card_max_width'] ?? 420 );

		$inline_css = "
			.calculators-plugin { max-width: {$width}px; }
			.calculators-plugin h3, .calculators-plugin .card-title { color: {$primary}; }
			.calculators-plugin .btn-primary { background: {$primary}; border-color: {$primary}; }
			.calculators-plugin .result { color: {$result}; }
		";
		wp_add_inline_style( 'netvio-calculators', $inline_css );

		if ( ! empty( $settings['load_alpinejs'] ) ) {
			wp_enqueue_script(
				'netvio-alpinejs',
				'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
				[],
				'3',
				true
			);
		}
	}

	/**
	 * Return plugin settings with defaults.
	 */
	public static function get_settings(): array {
		$defaults = [
			'load_bootstrap'  => '1',
			'load_alpinejs'   => '1',
			'default_unit'    => 'metric',
			'primary_color'   => '#0d6efd',
			'result_color'    => '#198754',
			'card_max_width'  => '420',
			'disabled_calcs'  => [],
		];
		$saved = get_option( 'netvio_calc_settings', [] );
		return wp_parse_args( $saved, $defaults );
	}
}
