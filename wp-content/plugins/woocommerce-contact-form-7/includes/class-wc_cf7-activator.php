<?php
/**
 * @since      1.0.0
 * @package    Wc_cf7
 * @subpackage Wc_cf7/includes
 * @author     Jüri-Joonas Kerem <jyri363@gmail.com>
 */
class Wc_cf7_Activator {

	/**
	 * Check if WooCommerce and Contact Form 7 is active
	 */
	public static function activate() {
		if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || !in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			// Deactivate the plugin
			deactivate_plugins(WC_CF7_PLUGIN);
			// Throw an error in the wordpress admin console
			$error_message = __('This plugin requires <a target="_blank" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> and <a target="_blank" href="https://wordpress.org/plugins/woocommerce/">WooCommerce</a> to be active!', 'contactform7andwoocommerce');
			die($error_message);
		}
		/*if( false == get_option( WC_CF7_PLUGIN_NAME.'_css_js' ) ) {
			require_once( WC_CF7_PLUGIN_DIR.'/admin/partials/wc_cf7-css_js_default.php' );
			$defaults = array(
				'jjk_css'		=>	jjk_default_css(),
				'jjk_js'		=>	jjk_default_js(),
			);
			add_option( WC_CF7_PLUGIN_NAME.'_css_js', $defaults );
		}*/
	}

}
