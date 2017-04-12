<?php
/**
 * WooCommerce and Contact Form 7 Uninstall
 *
 * @package     Wc_cf7
 * @version     1.0.0
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( "woocommerce-contact-form-7" );
delete_option( "woocommerce-contact-form-7_css' );