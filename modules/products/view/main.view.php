<?php
/**
 * La vue principale de la page des produits (wps-product)
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
	<h2>
		<?php esc_html_e( 'Products', 'wpshop' ); ?>

		<?php if ( ! Settings::g()->dolibarr_is_active() ) : ?>
			<a href="<?php echo esc_attr( admin_url( 'post-new.php?post_type=wps-product' ) ); ?>" class="wpeo-button button-main"><?php esc_html_e( 'Add', 'wpshop' ); ?></a>
		<?php else: ?>
			<a href="<?php echo esc_attr( $dolibarr_url . $dolibarr_create_product ); ?>" target="_blank" class="wpeo-button button-main"><?php esc_html_e( 'Add', 'wpshop' ); ?></a>
		<?php endif; ?>
	</h2>

	<div class="wpeo-gridlayout wpeo-form form-light grid-4 alignleft" style="margin-bottom: 20px; margin-top: 15px;">
		<form method="GET" action="<?php echo admin_url( 'admin.php' ); ?>" class="wps-filter-bar" style="display: flex">
			<div class="form-element">
				<label class="form-field-container">
					<span class="form-field-icon-prev"><i class="fas fa-search"></i></span>
					<input type="hidden" name="page" value="wps-product" />
					<input type="text" name="s" class="form-field" value="<?php echo esc_attr( $s ); ?>" style="height: 49px;" />
				</label>
			</div>
			<input type="submit" class="wpeo-button button-grey button-filter" value="<?php esc_html_e( 'Search', 'wpshop' ); ?>" />
		</form>
	</div>

	<?php
	if ( ! empty( $s ) ) :
		?>
		<p>Résultats de recherche pour « <?php echo $s; ?> »</p>
		<?php
	endif;
	?>

	<div class="alignright" style="display: flex; margin-top: 35px;">
		<p style="line-height: 0px; margin-right: 5px;"><?php echo $count . ' ' . __( 'element(s)', 'wpshop' ); ?></p>

		<?php if ( $number_page > 1 ) : ?>
			<ul class="wpeo-pagination">
				<?php
				if ( 1 !== $current_page ) :
					?>
					<li class="pagination-element pagination-prev">
						<a href="<?php echo esc_attr( $begin_url ); ?>"><<</a>
					</li>

					<li class="pagination-element pagination-prev">
						<a href="<?php echo esc_attr( $prev_url ); ?>"><</a>
					</li>
					<?php
				endif;
				?>

				<form method="GET" action="<?php echo admin_url( 'admin.php' ); ?>" />
					<input type="hidden" name="page" value="wps-product" />
					<input type="hidden" name="s" value="<?php echo esc_attr( ! empty( $s ) ); ?>" />
					<input style="width: 50px;" type="text" name="current_page" value="<?php echo esc_attr( $current_page ); ?>" />
				</form>

				sur <?php echo $number_page; ?>

				<?php
				if ( $current_page !== $number_page ) :
					?>
					<li class="pagination-element pagination-next">
						<a href="<?php echo esc_attr( $next_url ); ?>">></a>
					</li>

					<li class="pagination-element pagination-next">
						<a href="<?php echo esc_attr( $end_url ); ?>">>></a>
					</li>
					<?php
				endif;
				?>
			</ul>
		<?php endif; ?>
	</div>

	<?php Product::g()->display(); ?>
</div>
