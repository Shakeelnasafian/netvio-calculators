<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$registry = Netvio_Calculators_Shortcode::get_registry();
$settings = Netvio_Calculators_Plugin::get_settings();
$disabled = (array) ( $settings['disabled_calcs'] ?? [] );
$by_cat   = [];

foreach ( $registry as $key => $info ) {
	$by_cat[ $info['category'] ][] = array_merge( $info, [ 'key' => $key ] );
}
?>
<div class="wrap netvio-admin-wrap">

	<div class="netvio-admin-header">
		<h1><?php esc_html_e( 'All Calculators', 'netvio-calculators' ); ?></h1>
		<p class="netvio-subtitle"><?php esc_html_e( 'Copy any shortcode and paste it into a page or post.', 'netvio-calculators' ); ?></p>
	</div>

	<!-- Search box -->
	<div class="netvio-search-wrap">
		<input type="text" id="netvio-calc-search" placeholder="<?php esc_attr_e( 'Search calculators…', 'netvio-calculators' ); ?>" class="regular-text">
	</div>

	<?php foreach ( $by_cat as $category => $calcs ) : ?>
	<div class="netvio-section netvio-calc-category">
		<h2><?php echo esc_html( $category ); ?> <span class="netvio-count">(<?php echo esc_html( count( $calcs ) ); ?>)</span></h2>
		<table class="wp-list-table widefat fixed striped netvio-calc-table">
			<thead>
				<tr>
					<th style="width:35%"><?php esc_html_e( 'Calculator', 'netvio-calculators' ); ?></th>
					<th style="width:30%"><?php esc_html_e( 'Shortcode', 'netvio-calculators' ); ?></th>
					<th style="width:15%"><?php esc_html_e( 'Status', 'netvio-calculators' ); ?></th>
					<th style="width:20%"><?php esc_html_e( 'Actions', 'netvio-calculators' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $calcs as $calc ) :
					$is_disabled = in_array( $calc['key'], $disabled, true );
					$shortcode   = '[calculator type="' . esc_attr( $calc['key'] ) . '"]';
				?>
				<tr class="netvio-calc-row <?php echo $is_disabled ? 'netvio-row-disabled' : ''; ?>" data-name="<?php echo esc_attr( strtolower( $calc['label'] ) ); ?>">
					<td class="netvio-calc-name">
						<strong><?php echo esc_html( $calc['label'] ); ?></strong>
					</td>
					<td>
						<div class="netvio-shortcode-wrap">
							<code class="netvio-shortcode-code" id="sc-<?php echo esc_attr( $calc['key'] ); ?>"><?php echo esc_html( $shortcode ); ?></code>
							<button
								class="button netvio-copy-btn"
								data-target="sc-<?php echo esc_attr( $calc['key'] ); ?>"
								data-shortcode="<?php echo esc_attr( $shortcode ); ?>"
								title="<?php esc_attr_e( 'Copy to clipboard', 'netvio-calculators' ); ?>"
							>
								<?php esc_html_e( 'Copy', 'netvio-calculators' ); ?>
							</button>
						</div>
					</td>
					<td>
						<?php if ( $is_disabled ) : ?>
							<span class="netvio-badge netvio-badge-off"><?php esc_html_e( 'Disabled', 'netvio-calculators' ); ?></span>
						<?php else : ?>
							<span class="netvio-badge netvio-badge-on"><?php esc_html_e( 'Active', 'netvio-calculators' ); ?></span>
						<?php endif; ?>
					</td>
					<td>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=netvio-calculators-settings#netvio_section_calculators' ) ); ?>" class="button button-small">
							<?php esc_html_e( 'Configure', 'netvio-calculators' ); ?>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php endforeach; ?>

	<!-- Copy success toast -->
	<div id="netvio-toast" class="netvio-toast" aria-live="polite">
		<?php esc_html_e( 'Shortcode copied!', 'netvio-calculators' ); ?>
	</div>

</div>
