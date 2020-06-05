<?php
/**
 * Le contenu de la modal de synchronisation.
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

<div class="wpeo-gridlayout grid-2">
	<?php
	if ( ! empty( $entries ) ) :
		foreach ( $entries as $key => $entry ) :
			?>
			<div class="choose <?php echo esc_attr( $key ); ?>">
				<h2><?php echo $entry['title']; ?>

				<?php // translators: Last update the 06/06/2019 10:10:10. ?>
				<p><?php printf( __( 'Last update the %s', 'wpshop' ), $entry['data']['date']['rendered']['date_time'] ); ?></p>

				<ul>
					<li><strong><?php esc_html_e( 'Product name', 'wpshop' ); ?></strong>: <?php echo ! empty( $entry['data']['title'] ) ? esc_html( $entry['data']['title'] ) : 'Non définie'; ?></li>
					<li><strong><?php esc_html_e( 'Description', 'wpshop' ); ?></strong>: <?php echo ! empty( $entry['data']['content'] ) ? esc_html( $entry['data']['content'] ) : 'Non définie'; ?></li>
					<li><strong><?php esc_html_e( 'Price HT(€)', 'wpshop' ); ?></strong>: <?php echo ! empty( $entry['data']['price'] ) ? esc_html( $entry['data']['price'] ) : '0,00'; ?>€</li>
					<li><strong><?php esc_html_e( 'VAT Rate', 'wpshop' ); ?></strong>: <?php echo ! empty( $entry['data']['tva_tx'] ) ? esc_html( $entry['data']['tva_tx'] ) : '0,00'; ?>€</li>
					<li><strong><?php esc_html_e( 'Price TTC(€)', 'wpshop' ); ?></strong>: <?php echo ! empty( $entry['data']['price_ttc'] ) ? esc_html( $entry['data']['price_ttc'] ) : '0,00'; ?>€</li>
				</ul>


			</div>
			<?php
		endforeach;
	endif;
	?>
</div>
