<?php
/**
 * Registers the [calculator] shortcode and maintains the calculator registry.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Netvio_Calculators_Shortcode {

	/**
	 * Master registry of all calculators.
	 * Key   = shortcode type attribute value.
	 * Value = [ 'file' => template filename, 'label' => human name, 'category' => category ]
	 */
	public static function get_registry(): array {
		return [
			// ── Body Measurements ─────────────────────────────────────────
			'bmi'                 => [ 'file' => 'bmi-calculator.php',                  'label' => 'BMI Calculator',                    'category' => 'Body Measurements' ],
			'bmi-kids'            => [ 'file' => 'bmi-kids-calculator.php',             'label' => 'BMI Calculator (Kids)',             'category' => 'Body Measurements' ],
			'body-fat'            => [ 'file' => 'body-fat-calculator.php',             'label' => 'Body Fat Calculator',               'category' => 'Body Measurements' ],
			'army-body-fat'       => [ 'file' => 'army-body-fat-calculator.php',        'label' => 'Army Body Fat Calculator',          'category' => 'Body Measurements' ],
			'lean-body-mass'      => [ 'file' => 'lean-body-mass-calculator.php',       'label' => 'Lean Body Mass Calculator',         'category' => 'Body Measurements' ],
			'body-surface-area'   => [ 'file' => 'body-surface-area-calculator.php',    'label' => 'Body Surface Area Calculator',      'category' => 'Body Measurements' ],
			'waist-hip-ratio'     => [ 'file' => 'waist-hip-ratio-calculator.php',      'label' => 'Waist to Hip Ratio Calculator',     'category' => 'Body Measurements' ],
			'body-type'           => [ 'file' => 'body-type-calculator.php',            'label' => 'Body Type Calculator',              'category' => 'Body Measurements' ],
			'ponderal-index'      => [ 'file' => 'ponderal-index-calculator.php',       'label' => 'Ponderal Index Calculator',         'category' => 'Body Measurements' ],

			// ── Fitness ───────────────────────────────────────────────────
			'ideal-weight'        => [ 'file' => 'ideal-weight-calculator.php',         'label' => 'Ideal Weight Calculator',           'category' => 'Fitness' ],
			'healthy-weight'      => [ 'file' => 'healthy-weight-calculator.php',       'label' => 'Healthy Weight Calculator',         'category' => 'Fitness' ],
			'calories-burned'     => [ 'file' => 'calories-burned-calculator.php',      'label' => 'Calories Burned Calculator',        'category' => 'Fitness' ],
			'one-rep-max'         => [ 'file' => 'one-rep-max-calculator.php',          'label' => 'One Rep Max Calculator',            'category' => 'Fitness' ],
			'target-heart-rate'   => [ 'file' => 'target-heart-rate-calculator.php',    'label' => 'Target Heart Rate Calculator',      'category' => 'Fitness' ],
			'pace'                => [ 'file' => 'pace-calculator.php',                 'label' => 'Pace Calculator',                   'category' => 'Fitness' ],
			'running-speed'       => [ 'file' => 'running-speed-calculator.php',        'label' => 'Running Speed Calculator',          'category' => 'Fitness' ],

			// ── Nutrition & Metabolic ─────────────────────────────────────
			'tdee'                => [ 'file' => 'tdee-calculator.php',                 'label' => 'TDEE Calculator',                   'category' => 'Nutrition & Metabolic' ],
			'bmr'                 => [ 'file' => 'bmr-calculator.php',                  'label' => 'BMR Calculator',                    'category' => 'Nutrition & Metabolic' ],
			'bee'                 => [ 'file' => 'bee-calculator.php',                  'label' => 'BEE Calculator',                    'category' => 'Nutrition & Metabolic' ],
			'harris-benedict'     => [ 'file' => 'harris-benedict-calculator.php',      'label' => 'Harris-Benedict Calculator',        'category' => 'Nutrition & Metabolic' ],
			'macro'               => [ 'file' => 'macro-calculator.php',                'label' => 'Macro Calculator',                  'category' => 'Nutrition & Metabolic' ],
			'carbohydrate'        => [ 'file' => 'carbohydrate-calculator.php',         'label' => 'Carbohydrate Calculator',           'category' => 'Nutrition & Metabolic' ],
			'protein'             => [ 'file' => 'protein-calculator.php',              'label' => 'Protein Calculator',                'category' => 'Nutrition & Metabolic' ],
			'fat-intake'          => [ 'file' => 'fat-intake-calculator.php',           'label' => 'Fat Intake Calculator',             'category' => 'Nutrition & Metabolic' ],
			'fiber'               => [ 'file' => 'fiber-calculator.php',                'label' => 'Fiber Calculator',                  'category' => 'Nutrition & Metabolic' ],
			'gfr'                 => [ 'file' => 'gfr-calculator.php',                  'label' => 'GFR Calculator',                    'category' => 'Nutrition & Metabolic' ],
			'water-intake'        => [ 'file' => 'water-intake-calculator.php',         'label' => 'Water Intake Calculator',           'category' => 'Nutrition & Metabolic' ],
			'calorie-deficit'     => [ 'file' => 'calorie-deficit-calculator.php',      'label' => 'Calorie Deficit Calculator',        'category' => 'Nutrition & Metabolic' ],

			// ── Pregnancy & Women's Health ────────────────────────────────
			'pregnancy'           => [ 'file' => 'pregnancy-calculator.php',            'label' => 'Pregnancy Calculator',              'category' => "Pregnancy & Women's Health" ],
			'pregnancy-weight-gain' => [ 'file' => 'pregnancy-weight-gain-calculator.php', 'label' => 'Pregnancy Weight Gain Calculator', 'category' => "Pregnancy & Women's Health" ],
			'pregnancy-conception'  => [ 'file' => 'pregnancy-conception-calculator.php',  'label' => 'Pregnancy Conception Calculator', 'category' => "Pregnancy & Women's Health" ],
			'due-date'            => [ 'file' => 'due-date-calculator.php',             'label' => 'Due Date Calculator',               'category' => "Pregnancy & Women's Health" ],
			'conception'          => [ 'file' => 'conception-calculator.php',           'label' => 'Conception Calculator',             'category' => "Pregnancy & Women's Health" ],
			'period'              => [ 'file' => 'period-calculator.php',               'label' => 'Period Calculator',                 'category' => "Pregnancy & Women's Health" ],
			'ovulation'           => [ 'file' => 'ovulation-calculator.php',            'label' => 'Ovulation Calculator',              'category' => "Pregnancy & Women's Health" ],

			// ── General Health ────────────────────────────────────────────
			'bac'                 => [ 'file' => 'bac-calculator.php',                  'label' => 'Blood Alcohol Content (BAC) Calculator', 'category' => 'General Health' ],
			'age'                 => [ 'file' => 'age-calculator.php',                  'label' => 'Age Calculator',                    'category' => 'General Health' ],
			'sleep'               => [ 'file' => 'sleep-calculator.php',                'label' => 'Sleep Calculator',                  'category' => 'General Health' ],
		];
	}

	public static function init(): void {
		add_shortcode( 'calculator', [ __CLASS__, 'render' ] );
	}

	public static function render( $atts ): string {
		$atts = shortcode_atts( [ 'type' => 'bmi' ], $atts, 'calculator' );
		$type = sanitize_key( $atts['type'] );

		$registry = self::get_registry();
		$settings = Netvio_Calculators_Plugin::get_settings();

		// Check if calculator is disabled in settings
		$disabled = (array) ( $settings['disabled_calcs'] ?? [] );
		if ( in_array( $type, $disabled, true ) ) {
			return '<div class="alert alert-warning">' . esc_html__( 'This calculator is currently disabled.', 'netvio-calculators' ) . '</div>';
		}

		ob_start();

		if ( isset( $registry[ $type ] ) ) {
			$template = NETVIO_CALC_PATH . 'templates/' . $registry[ $type ]['file'];
			if ( file_exists( $template ) ) {
				include $template;
			} else {
				echo '<div class="alert alert-danger">' . esc_html__( 'Calculator template not found.', 'netvio-calculators' ) . '</div>';
			}
		} else {
			echo '<div class="alert alert-warning">' . esc_html__( 'Unknown calculator type.', 'netvio-calculators' ) . '</div>';
		}

		return ob_get_clean();
	}
}

Netvio_Calculators_Shortcode::init();
