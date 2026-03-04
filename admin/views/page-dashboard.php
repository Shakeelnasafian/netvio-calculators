<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$registry  = Netvio_Calculators_Shortcode::get_registry();
$settings  = Netvio_Calculators_Plugin::get_settings();
$disabled  = (array) ( $settings['disabled_calcs'] ?? [] );
$total     = count( $registry );
$active    = $total - count( $disabled );
$by_cat    = [];

foreach ( $registry as $key => $info ) {
	$by_cat[ $info['category'] ][] = array_merge( $info, [ 'key' => $key, 'enabled' => ! in_array( $key, $disabled, true ) ] );
}
?>
<div class="wrap netvio-admin-wrap">

	<div class="netvio-admin-header">
		<h1><?php esc_html_e( 'Netvio Calculators', 'netvio-calculators' ); ?></h1>
		<p class="netvio-subtitle"><?php esc_html_e( 'Embed health & fitness calculators anywhere using shortcodes.', 'netvio-calculators' ); ?></p>
	</div>

	<!-- Stats Row -->
	<div class="netvio-stats-row">
		<div class="netvio-stat-card">
			<span class="netvio-stat-number"><?php echo esc_html( $total ); ?></span>
			<span class="netvio-stat-label"><?php esc_html_e( 'Total Calculators', 'netvio-calculators' ); ?></span>
		</div>
		<div class="netvio-stat-card">
			<span class="netvio-stat-number netvio-green"><?php echo esc_html( $active ); ?></span>
			<span class="netvio-stat-label"><?php esc_html_e( 'Active', 'netvio-calculators' ); ?></span>
		</div>
		<div class="netvio-stat-card">
			<span class="netvio-stat-number netvio-red"><?php echo esc_html( count( $disabled ) ); ?></span>
			<span class="netvio-stat-label"><?php esc_html_e( 'Disabled', 'netvio-calculators' ); ?></span>
		</div>
		<div class="netvio-stat-card">
			<span class="netvio-stat-number"><?php echo esc_html( count( $by_cat ) ); ?></span>
			<span class="netvio-stat-label"><?php esc_html_e( 'Categories', 'netvio-calculators' ); ?></span>
		</div>
	</div>

	<!-- Quick Actions -->
	<div class="netvio-section">
		<h2><?php esc_html_e( 'Quick Actions', 'netvio-calculators' ); ?></h2>
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=netvio-calculators-list' ) ); ?>" class="button button-primary">
			<?php esc_html_e( 'Browse All Calculators & Shortcodes', 'netvio-calculators' ); ?>
		</a>
		&nbsp;
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=netvio-calculators-settings' ) ); ?>" class="button">
			<?php esc_html_e( 'Settings', 'netvio-calculators' ); ?>
		</a>
	</div>

	<!-- How to Use -->
	<div class="netvio-section">
		<h2><?php esc_html_e( 'How to Use', 'netvio-calculators' ); ?></h2>
		<ol class="netvio-how-to">
			<li><?php esc_html_e( 'Go to "All Calculators" to see the list with ready-to-use shortcodes.', 'netvio-calculators' ); ?></li>
			<li><?php esc_html_e( 'Click the "Copy" button next to any shortcode.', 'netvio-calculators' ); ?></li>
			<li><?php esc_html_e( 'Paste the shortcode into any page, post, or widget.', 'netvio-calculators' ); ?></li>
		</ol>
		<div class="netvio-code-example">
			<code>[calculator type="bmi"]</code>
		</div>
	</div>

	<!-- Category Summary -->
	<div class="netvio-section">
		<h2><?php esc_html_e( 'Calculators by Category', 'netvio-calculators' ); ?></h2>
		<div class="netvio-category-grid">
			<?php foreach ( $by_cat as $category => $calcs ) :
				$cat_active = count( array_filter( $calcs, fn( $c ) => $c['enabled'] ) );
			?>
			<div class="netvio-category-card">
				<h3><?php echo esc_html( $category ); ?></h3>
				<p class="netvio-cat-count">
					<span class="netvio-green"><?php echo esc_html( $cat_active ); ?></span>
					/ <?php echo esc_html( count( $calcs ) ); ?>
					<?php esc_html_e( 'active', 'netvio-calculators' ); ?>
				</p>
				<ul>
					<?php foreach ( $calcs as $calc ) : ?>
					<li class="<?php echo $calc['enabled'] ? '' : 'netvio-disabled-calc'; ?>">
						<?php echo esc_html( $calc['label'] ); ?>
						<?php if ( ! $calc['enabled'] ) : ?>
							<span class="netvio-badge-disabled"><?php esc_html_e( 'off', 'netvio-calculators' ); ?></span>
						<?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

</div>
