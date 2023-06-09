<?php
/**
 * La vue affichant les commandes.
 *
 * @package   WPshop
 * @author    Eoxia <technique@eoxia.com>
 * @copyright (c) 2011-2022 Eoxia <technique@eoxia.com>.
 * @since     2.0.0
 * @version   2.0.0
 */

namespace wpshop;

defined( 'ABSPATH' ) || exit;

/**
 * Documentation des variables utilisées dans la vue.
 *
 * @var array      $orders  Le tableau contenant toutes les données des commandes.
 * @var Doli_Order $order   Les données d'une commande.
 * @var array      $line    Le tableau contenant toutes les données d'un item.
 * @var integer    $qty     La quantité du produit.
 * @var Product    $product Les données d'un produit.
 */
?>

<?php if ( ! Settings::g()->dolibarr_is_active() ): ?>
	<div class="wpeo-notice notice-info">
		<div class="notice-content">
			<div class="notice-title"><?php _e( 'Please contact commercial', 'wpshop' ) ; ?></div>
		</div>
	</div>
<?php else: ?>
	<div class="wps-list-order wps-list-box">
		<?php if ( ! empty( $orders ) ) :
			foreach ( $orders as $order ) : ?>
				<div class="wps-order wps-box">
					<div class="wps-box-resume">
						<div class="wps-box-primary">
							<div class="wps-box-title"><?php echo esc_html( $order->data['datec'] ); ?></div>
							<ul class="wps-box-attributes">
								<li class="wps-box-subtitle-item"><i class="wps-box-subtitle-icon fas fa-shopping-cart"></i> <?php echo esc_attr( $order->data['title'] ); ?></li>
							</ul>
							<div class="wps-box-display-more">
								<i class="wps-box-display-more-icon fas fa-angle-right"></i>
								<span class="wps-box-display-more-text"><?php esc_html_e( 'View details', 'wpshop' ); ?></span>
							</div>
						</div>
						<div class="wps-box-secondary">
							<div class="wps-box-status"><span class="wps-box-status-dot"></span> <?php echo Doli_Statut::g()->display_status( $order ); ?></div>
							<div class="wps-box-price"><?php echo esc_html( number_format( $order->data['total_ttc'], 2, ',', '' ) ); ?>€</div>
						</div>
						<div class="wps-box-action">
							<a target="_blank"
								href="<?php echo esc_attr( admin_url( 'admin-post.php?action=wps_download_order&_wpnonce=' . wp_create_nonce( 'download_order' ) . '&order_id=' . $order->data['external_id'] ) ); ?>"
								class="wpeo-button button-primary button-square-50 button-rounded">
								<i class="button-icon fas fa-file-download"></i>
							</a>
						</div>
					</div>

					<div class="wps-box-detail wps-list-product">
						<?php if ( ! empty( $order->data['lines'] ) ) :
							foreach ( $order->data['lines'] as $line ) :
								$qty                  = $line['qty'];
								$product              = Product::g()->get( array(
									'meta_key'   => '_external_id',
									'meta_value' => (int) $line['fk_product'],
								), true );

								if ( empty( $product ) ) {
									$product = Product::g()->get( array( 'schema' => true ), true );
									$product->data['title'] = ! empty( $line['libelle'] ) ? $line['libelle'] : '';
								}

								$product->data['qty'] = $qty;
								$product = $product->data;
								$product['price_ttc'] = ( $line['total_ttc'] / $qty );
								include( Template_Util::get_template_part( 'products', 'wps-product-list' ) );
							endforeach;
						else :
							esc_html_e( 'No products to display', 'wpshop' );
						endif; ?>
					</div>
				</div>
			<?php endforeach;
		else : ?>
			<div class="wpeo-notice notice-info">
				<div class="notice-content">
					<div class="notice-title"><?php esc_html_e( 'No orders', 'wpshop' ); ?></div>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
