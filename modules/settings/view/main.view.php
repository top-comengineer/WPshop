<?php
/**
 * La vue principale de la page de réglages
 *
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2011-2019 Eoxia <dev@eoxia.com>.
 *
 * @license   AGPLv3 <https://spdx.org/licenses/AGPL-3.0-or-later.html>
 *
 * @package   WPshop\Templates
 *
 * @since     2.0.0
 */

namespace wpshop;

defined( 'ABSPATH' ) || exit; ?>

<div class="wrap wpeo-wrap">
	<h2><?php esc_html_e( 'Settings', 'wpshop' ); ?></h2>

	<?php
	if ( ! empty( $transient ) ) :
		?>
		<div class="notice notice-success is-dismissible">
			<p><?php echo $transient; ?></p>
		</div>
		<?php
	endif;
	?>

	<div class="wpeo-tab">
		<ul class="tab-list">
			<a href="<?php echo esc_url( admin_url( 'admin-post.php?action=wps_load_settings_tab&_wpnonce=' . wp_create_nonce( 'callback_load_tab' ) . '&tab=general' ) ); ?>" class="tab-element <?php echo ( 'general' === $tab ) ? 'tab-active' : ''; ?>"><?php esc_html_e( 'General', 'wpshop' ); ?></a>
			<a href="<?php echo esc_url( admin_url( 'admin-post.php?action=wps_load_settings_tab&_wpnonce=' . wp_create_nonce( 'callback_load_tab' ) . '&tab=pages' ) ); ?>" class="tab-element <?php echo ( 'pages' === $tab ) ? 'tab-active' : ''; ?>"><?php esc_html_e( 'Pages', 'wpshop' ); ?></a>
			<a href="<?php echo esc_url( admin_url( 'admin-post.php?action=wps_load_settings_tab&_wpnonce=' . wp_create_nonce( 'callback_load_tab' ) . '&tab=emails' ) ); ?>" class="tab-element <?php echo ( 'emails' === $tab ) ? 'tab-active' : ''; ?>"><?php esc_html_e( 'Emails', 'wpshop' ); ?></a>
			<a href="<?php echo esc_url( admin_url( 'admin-post.php?action=wps_load_settings_tab&_wpnonce=' . wp_create_nonce( 'callback_load_tab' ) . '&tab=payment_method' ) ); ?>" class="tab-element <?php echo ( 'payment_method' === $tab ) ? 'tab-active' : ''; ?>"><?php esc_html_e( 'Payment method', 'wpshop' ); ?></a>
			<a href="<?php echo esc_url( admin_url( 'admin-post.php?action=wps_load_settings_tab&_wpnonce=' . wp_create_nonce( 'callback_load_tab' ) . '&tab=erp' ) ); ?>" class="tab-element <?php echo ( 'erp' === $tab ) ? 'tab-active' : ''; ?>"><?php esc_html_e( 'ERP', 'wpshop' ); ?></a>
<!--			<a href="--><?php //echo esc_url( admin_url( 'admin-post.php?action=wps_load_settings_tab&_wpnonce=' . wp_create_nonce( 'callback_load_tab' ) . '&tab=shipping_cost' ) ); ?><!--" class="tab-element --><?php //echo ( 'shipping_cost' === $tab ) ? 'tab-active' : ''; ?><!--">--><?php //esc_html_e( 'Shipping cost', 'wpshop' ); ?><!--</a>-->
		</ul>

		<div class="tab-container">
			<div class="tab-content tab-active">
				<?php call_user_func( array( Settings::g(), 'display_' . $tab ), $section ); ?>
			</div>
		</div>
	</div>
</div>
