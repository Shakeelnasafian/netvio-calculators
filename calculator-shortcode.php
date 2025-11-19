<?php
// calculator-shortcode.php

function netvio_calculator_shortcode($atts)
{
    // Define available calculators and their templates
    static $calculators = [
        'bmi' => 'bmi-calculator.php',
        'ideal-weight' => 'ideal-weight-calculator.php',
        'pace' => 'pace-calculator.php',
        'army-body-fat' => 'army-body-fat-calculator.php',
        'lean-body-mass' => 'lean-body-mass-calculator.php',
        'healthy-weight' => 'healthy-weight-calculator.php',
        'calories-burned' => 'calories-burned-calculator.php',
        'one-rep-max' => 'one-rep-max-calculator.php',
        'target-heart-rate' => 'target-heart-rate-calculator.php',
        'pregnancy' => 'pregnancy-calculator.php',
        'pregnancy-weight-gain' => 'pregnancy-weight-gain-calculator.php',
        'pregnancy-conception' => 'pregnancy-conception-calculator.php',
        'due-date' => 'due-date-calculator.php',
        'conception' => 'conception-calculator.php',
        'period' => 'period-calculator.php',
        'macro' => 'macro-calculator.php',
        'carbohydrate' => 'carbohydrate-calculator.php',
        'protein' => 'protein-calculator.php',
        'fat-intake' => 'fat-intake-calculator.php',
        'tdee' => 'tdee-calculator.php',
        'gfr' => 'gfr-calculator.php',
        'body-type' => 'body-type-calculator.php',
        'body-surface-area' => 'body-surface-area-calculator.php',
        'bac' => 'bac-calculator.php',
        'bmi-kids' => 'bmi-kids-calculator.php',
        'body-fat' => 'body-fat-calculator.php',
        'waist-hip-ratio' => 'waist-hip-ratio-calculator.php',
        'bee' => 'bee-calculator.php',
        'harris-benedict' => 'harris-benedict-calculator.php',
        'fiber' => 'fiber-calculator.php',
    ];

    $atts = shortcode_atts(['type' => 'bmi'], $atts);

    $type = $atts['type'];

    ob_start();

    if (isset($calculators[$type])) {
        include __DIR__ . '/templates/' . $calculators[$type];
    } else {
        echo '<div class="alert alert-warning">Unknown calculator type.</div>';
    }

    return ob_get_clean();
}

add_shortcode('calculator', 'netvio_calculator_shortcode');
