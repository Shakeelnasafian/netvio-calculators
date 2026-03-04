<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div class="wrap netvio-admin-wrap">

	<div class="netvio-admin-header">
		<h1><?php esc_html_e( 'Settings', 'netvio-calculators' ); ?></h1>
		<p class="netvio-subtitle"><?php esc_html_e( 'Configure the Netvio Calculators plugin behaviour and appearance.', 'netvio-calculators' ); ?></p>
	</div>

	<?php settings_errors( 'netvio_calc_settings' ); ?>

	<form method="post" action="options.php">
		<?php
		settings_fields( 'netvio_calc_settings_group' );
		do_settings_sections( 'netvio_calc_settings_page' );
		submit_button( __( 'Save Settings', 'netvio-calculators' ) );
		?>
	</form>

</div>
