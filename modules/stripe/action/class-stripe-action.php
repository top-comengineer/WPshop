<?php
/**
 * La classe gérant les actions de Stripe.
 *
 * @package   WPshop
 * @author    Eoxia <dev@eoxia.com>
 * @copyright (c) 2011-2020 Eoxia <dev@eoxia.com>.
 * @since     2.0.0
 * @version   2.0.0
 */

namespace wpshop;

use eoxia\View_Util;

defined( 'ABSPATH' ) || exit;

/**
 * Stripe Action Class.
 */
class Stripe_Action {
	/**
	 * Le constructeur.
	 *
	 * @since   2.0.0
	 * @version 2.0.0
	 */
	public function __construct() {
		add_action( 'wp_head', array( $this, 'define_stripe_option' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'callback_enqueue_scripts' ), 9 );

		add_action( 'wps_setting_payment_method_stripe_after_form', array( $this, 'callback_setting_payment_method' ), 10, 0 );
		add_action( 'wps_update_payment_method_data', array( $this, 'update_method_payment_stripe' ), 10, 2 );

		add_action( 'wps_gateway_stripe', array( $this, 'callback_wps_gateway_stripe' ), 10, 1 );
	}

	/**
	 * Ajoute la variable stripe_key pour la rendre acessible dans le JS.
	 *
	 * @since   2.0.0
	 * @version 2.0.0
	 */
	public function define_stripe_option() {
		$stripe_options = Payment::g()->get_payment_option( 'stripe' );

		echo '<script type="text/javascript">
		  var stripe_key = "' . $stripe_options['publish_key'] . '";
		</script>';
	}

	/**
	 * Inclus le JS de stripe.
	 *
	 * @since   2.0.0
	 * @version 2.0.0
	 */
	public function callback_enqueue_scripts() {
		if ( Pages::g()->is_checkout_page() ) {
			wp_enqueue_script( 'wpshop-stripe', 'https://js.stripe.com/v3/', array(), \eoxia\Config_Util::$init['wpshop']->version );
		}
	}

	/**
	 * Ajoute la page pour configurer le paiement Stripe.
	 *
	 * @since   2.0.0
	 * @version 2.0.0
	 */
	public function callback_setting_payment_method() {
		$stripe_options = Payment::g()->get_payment_option( 'stripe' );
		View_Util::exec( 'wpshop', 'stripe', 'form-setting', array(
			'stripe_options' => $stripe_options,
		) );
	}

	/**
	 * Met à jour les réglages de Stripe.
	 *
	 * @since   2.0.0
	 * @version 2.0.0
	 *
	 * @param  array $data Les données de Stripe.
	 * @param  array $type Le type de méthode de paiement.
	 *
	 * @return array      Les données de Stripe
	 */
	public function update_method_payment_stripe( $data, $type ) {
		if ( 'stripe' === $type ) {
			$publish_key        = ! empty( $_POST['publish_key'] ) ? sanitize_text_field( $_POST['publish_key'] ) : '';
			$secret_key         = ! empty( $_POST['secret_key'] ) ? sanitize_text_field( $_POST['secret_key'] ) : '';
			$use_stripe_sandbox = ( isset( $_POST['use_stripe_sandbox'] ) && 'on' === $_POST['use_stripe_sandbox'] ) ? true : false;

			$data['stripe']['publish_key']        = $publish_key;
			$data['stripe']['secret_key']         = $secret_key;
			$data['stripe']['use_stripe_sandbox'] = $use_stripe_sandbox;
		}

		return $data;
	}

	/**
	 * Déclenche l'action pour compléter le paiement.
	 *
	 * @since   2.0.0
	 * @version 2.0.0
	 *
	 * @param array $param Les données reçues par Stripe.
	 */
	public function callback_wps_gateway_stripe( $param ) {
		if ( 'order.payment_failed' === $param['type'] ) {
			do_action( 'wps_payment_failed', $param );
		} else {
			do_action( 'wps_payment_complete', $param );
		}
	}
}

new Stripe_Action();
