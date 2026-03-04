<?php
/**
 * Admin functionality for Netvio Calculators.
 * Registers menus, handles settings, and renders admin pages.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Netvio_Calculators_Admin {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'register_menus' ] );
		add_action( 'admin_init', [ $this, 'register_settings' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );
		add_filter( 'plugin_action_links_' . NETVIO_CALC_BASENAME, [ $this, 'add_plugin_action_links' ] );
	}

	// ──────────────────────────────────────────────────────────────────────────
	// Menu Registration
	// ──────────────────────────────────────────────────────────────────────────

	public function register_menus(): void {
		add_menu_page(
			__( 'Netvio Calculators', 'netvio-calculators' ),
			__( 'Calculators', 'netvio-calculators' ),
			'manage_options',
			'netvio-calculators',
			[ $this, 'page_dashboard' ],
			'dashicons-calculator',
			30
		);

		add_submenu_page(
			'netvio-calculators',
			__( 'Dashboard', 'netvio-calculators' ),
			__( 'Dashboard', 'netvio-calculators' ),
			'manage_options',
			'netvio-calculators',
			[ $this, 'page_dashboard' ]
		);

		add_submenu_page(
			'netvio-calculators',
			__( 'All Calculators', 'netvio-calculators' ),
			__( 'All Calculators', 'netvio-calculators' ),
			'manage_options',
			'netvio-calculators-list',
			[ $this, 'page_calculators' ]
		);

		add_submenu_page(
			'netvio-calculators',
			__( 'Settings', 'netvio-calculators' ),
			__( 'Settings', 'netvio-calculators' ),
			'manage_options',
			'netvio-calculators-settings',
			[ $this, 'page_settings' ]
		);
	}

	// ──────────────────────────────────────────────────────────────────────────
	// Assets
	// ──────────────────────────────────────────────────────────────────────────

	public function enqueue_admin_assets( string $hook ): void {
		// Only load on our admin pages
		if ( strpos( $hook, 'netvio-calculators' ) === false ) {
			return;
		}

		wp_enqueue_style(
			'netvio-admin',
			NETVIO_CALC_URL . 'admin/assets/admin.css',
			[],
			NETVIO_CALC_VERSION
		);

		wp_enqueue_style(
			'netvio-bootstrap-admin',
			'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
			[],
			'5.3.0'
		);

		wp_enqueue_script(
			'netvio-admin',
			NETVIO_CALC_URL . 'admin/assets/admin.js',
			[],
			NETVIO_CALC_VERSION,
			true
		);
	}

	// ──────────────────────────────────────────────────────────────────────────
	// Settings API
	// ──────────────────────────────────────────────────────────────────────────

	public function register_settings(): void {
		register_setting(
			'netvio_calc_settings_group',
			'netvio_calc_settings',
			[ $this, 'sanitize_settings' ]
		);

		// Section: Assets
		add_settings_section(
			'netvio_section_assets',
			__( 'Asset Loading', 'netvio-calculators' ),
			function() {
				echo '<p>' . esc_html__( 'Control which external libraries are loaded by the plugin.', 'netvio-calculators' ) . '</p>';
			},
			'netvio_calc_settings_page'
		);

		add_settings_field( 'load_bootstrap',   __( 'Load Bootstrap CSS', 'netvio-calculators' ),  [ $this, 'field_checkbox' ], 'netvio_calc_settings_page', 'netvio_section_assets', [ 'id' => 'load_bootstrap',   'description' => __( 'Uncheck if your theme already loads Bootstrap 5.', 'netvio-calculators' ) ] );
		add_settings_field( 'load_alpinejs',    __( 'Load Alpine.js', 'netvio-calculators' ),       [ $this, 'field_checkbox' ], 'netvio_calc_settings_page', 'netvio_section_assets', [ 'id' => 'load_alpinejs',    'description' => __( 'Uncheck if Alpine.js is already loaded by another plugin.', 'netvio-calculators' ) ] );

		// Section: Appearance
		add_settings_section(
			'netvio_section_appearance',
			__( 'Appearance', 'netvio-calculators' ),
			function() {
				echo '<p>' . esc_html__( 'Customize calculator colors and layout.', 'netvio-calculators' ) . '</p>';
			},
			'netvio_calc_settings_page'
		);

		add_settings_field( 'primary_color',   __( 'Primary Color', 'netvio-calculators' ),      [ $this, 'field_color' ],    'netvio_calc_settings_page', 'netvio_section_appearance', [ 'id' => 'primary_color',   'description' => __( 'Heading and button color.', 'netvio-calculators' ) ] );
		add_settings_field( 'result_color',    __( 'Result Color', 'netvio-calculators' ),        [ $this, 'field_color' ],    'netvio_calc_settings_page', 'netvio_section_appearance', [ 'id' => 'result_color',    'description' => __( 'Color used for result text.', 'netvio-calculators' ) ] );
		add_settings_field( 'card_max_width',  __( 'Card Max Width (px)', 'netvio-calculators' ), [ $this, 'field_number' ],   'netvio_calc_settings_page', 'netvio_section_appearance', [ 'id' => 'card_max_width',  'description' => __( 'Maximum width of each calculator card.', 'netvio-calculators' ), 'min' => 300, 'max' => 1200 ] );

		// Section: Defaults
		add_settings_section(
			'netvio_section_defaults',
			__( 'Defaults', 'netvio-calculators' ),
			null,
			'netvio_calc_settings_page'
		);

		add_settings_field( 'default_unit',    __( 'Default Unit System', 'netvio-calculators' ), [ $this, 'field_select' ],   'netvio_calc_settings_page', 'netvio_section_defaults', [
			'id'      => 'default_unit',
			'options' => [ 'metric' => __( 'Metric (kg, cm)', 'netvio-calculators' ), 'imperial' => __( 'Imperial (lbs, ft/in)', 'netvio-calculators' ) ],
		] );

		// Section: Manage Calculators
		add_settings_section(
			'netvio_section_calculators',
			__( 'Enable / Disable Calculators', 'netvio-calculators' ),
			function() {
				echo '<p>' . esc_html__( 'Uncheck any calculator to prevent it from rendering on the frontend.', 'netvio-calculators' ) . '</p>';
			},
			'netvio_calc_settings_page'
		);

		add_settings_field(
			'disabled_calcs',
			__( 'Active Calculators', 'netvio-calculators' ),
			[ $this, 'field_calculator_toggles' ],
			'netvio_calc_settings_page',
			'netvio_section_calculators'
		);
	}

	public function sanitize_settings( $input ): array {
		$clean = [];
		$clean['load_bootstrap']  = ! empty( $input['load_bootstrap'] ) ? '1' : '0';
		$clean['load_alpinejs']   = ! empty( $input['load_alpinejs'] ) ? '1' : '0';
		$clean['primary_color']   = sanitize_hex_color( $input['primary_color'] ?? '#0d6efd' ) ?: '#0d6efd';
		$clean['result_color']    = sanitize_hex_color( $input['result_color'] ?? '#198754' ) ?: '#198754';
		$clean['card_max_width']  = max( 300, min( 1200, absint( $input['card_max_width'] ?? 420 ) ) );
		$clean['default_unit']    = in_array( $input['default_unit'] ?? 'metric', [ 'metric', 'imperial' ], true ) ? $input['default_unit'] : 'metric';

		// Disabled calculators: everything checked means not in disabled list
		$registry = Netvio_Calculators_Shortcode::get_registry();
		$disabled = [];
		foreach ( array_keys( $registry ) as $key ) {
			if ( empty( $input['enabled_calcs'][ $key ] ) ) {
				$disabled[] = $key;
			}
		}
		$clean['disabled_calcs'] = $disabled;

		return $clean;
	}

	// ──────────────────────────────────────────────────────────────────────────
	// Field Renderers
	// ──────────────────────────────────────────────────────────────────────────

	public function field_checkbox( array $args ): void {
		$settings = Netvio_Calculators_Plugin::get_settings();
		$id       = $args['id'];
		$value    = $settings[ $id ] ?? '1';
		printf(
			'<input type="checkbox" id="%1$s" name="netvio_calc_settings[%1$s]" value="1" %2$s>',
			esc_attr( $id ),
			checked( $value, '1', false )
		);
		if ( ! empty( $args['description'] ) ) {
			echo ' <label for="' . esc_attr( $id ) . '">' . esc_html( $args['description'] ) . '</label>';
		}
	}

	public function field_color( array $args ): void {
		$settings = Netvio_Calculators_Plugin::get_settings();
		$id       = $args['id'];
		$value    = $settings[ $id ] ?? '#000000';
		printf(
			'<input type="color" id="%1$s" name="netvio_calc_settings[%1$s]" value="%2$s"> <span class="description">%3$s</span>',
			esc_attr( $id ),
			esc_attr( $value ),
			esc_html( $args['description'] ?? '' )
		);
	}

	public function field_number( array $args ): void {
		$settings = Netvio_Calculators_Plugin::get_settings();
		$id       = $args['id'];
		$value    = $settings[ $id ] ?? 420;
		printf(
			'<input type="number" id="%1$s" name="netvio_calc_settings[%1$s]" value="%2$s" min="%3$s" max="%4$s" class="small-text"> <span class="description">%5$s</span>',
			esc_attr( $id ),
			esc_attr( $value ),
			esc_attr( $args['min'] ?? 0 ),
			esc_attr( $args['max'] ?? 9999 ),
			esc_html( $args['description'] ?? '' )
		);
	}

	public function field_select( array $args ): void {
		$settings = Netvio_Calculators_Plugin::get_settings();
		$id       = $args['id'];
		$current  = $settings[ $id ] ?? '';
		echo '<select id="' . esc_attr( $id ) . '" name="netvio_calc_settings[' . esc_attr( $id ) . ']">';
		foreach ( $args['options'] as $val => $label ) {
			printf( '<option value="%s" %s>%s</option>', esc_attr( $val ), selected( $current, $val, false ), esc_html( $label ) );
		}
		echo '</select>';
	}

	public function field_calculator_toggles(): void {
		$settings  = Netvio_Calculators_Plugin::get_settings();
		$disabled  = (array) ( $settings['disabled_calcs'] ?? [] );
		$registry  = Netvio_Calculators_Shortcode::get_registry();
		$by_cat    = [];

		foreach ( $registry as $key => $info ) {
			$by_cat[ $info['category'] ][] = [ 'key' => $key, 'label' => $info['label'] ];
		}

		foreach ( $by_cat as $category => $calcs ) {
			echo '<div class="netvio-toggle-group">';
			echo '<strong>' . esc_html( $category ) . '</strong><br>';
			foreach ( $calcs as $calc ) {
				$checked = ! in_array( $calc['key'], $disabled, true );
				printf(
					'<label class="netvio-toggle-label"><input type="checkbox" name="netvio_calc_settings[enabled_calcs][%1$s]" value="1" %2$s> %3$s</label>',
					esc_attr( $calc['key'] ),
					checked( $checked, true, false ),
					esc_html( $calc['label'] )
				);
			}
			echo '</div>';
		}
	}

	// ──────────────────────────────────────────────────────────────────────────
	// Plugin action links
	// ──────────────────────────────────────────────────────────────────────────

	public function add_plugin_action_links( array $links ): array {
		$settings_link = '<a href="' . esc_url( admin_url( 'admin.php?page=netvio-calculators-settings' ) ) . '">' . esc_html__( 'Settings', 'netvio-calculators' ) . '</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}

	// ──────────────────────────────────────────────────────────────────────────
	// Page Renderers
	// ──────────────────────────────────────────────────────────────────────────

	public function page_dashboard(): void {
		require_once NETVIO_CALC_PATH . 'admin/views/page-dashboard.php';
	}

	public function page_calculators(): void {
		require_once NETVIO_CALC_PATH . 'admin/views/page-calculators.php';
	}

	public function page_settings(): void {
		require_once NETVIO_CALC_PATH . 'admin/views/page-settings.php';
	}
}

new Netvio_Calculators_Admin();
