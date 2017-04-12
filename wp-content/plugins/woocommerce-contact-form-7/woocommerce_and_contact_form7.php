<?php
/**
 * Plugin Name: WooCommerce and Contact Form 7
 * Plugin URI: http://wpeesti.ee
 * Description: Additional Tab or Button Product Inquiry.
 * Author: JJK <jyri363@gmail.com>
 * Author URI: http://wpeesti.ee
 * Version: 1.0.7 (Beta Versions)
 * Tested up to: 4.4.2
 *
 * License: GNU General Public License v3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: woocommerce-contact-form-7
 * Domain Path: /languages
 *
 * @package     Wc_cf7
 * @author      Jüri-Joonas Kerem <jyri363@gmail.com>
 * @category    Plugin
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

/**
 * Exit if accessed directly
 **/
if ( !defined( 'ABSPATH' ) ) exit;
 
define( 'WC_CF7_VERSION', '1.0.7' );
define( 'WC_CF7_PLUGIN', __FILE__ );
define( 'WC_CF7_PLUGIN_BASENAME', plugin_basename( WC_CF7_PLUGIN ) );
define( 'WC_CF7_PLUGIN_NAME', trim( dirname( WC_CF7_PLUGIN_BASENAME ), '/' ) );
define( 'WC_CF7_PLUGIN_DIR', untrailingslashit( dirname( WC_CF7_PLUGIN ) ) );
define( 'WC_CF7_PLUGIN_DIR_URL', plugin_dir_url(WC_CF7_PLUGIN));

/**
 * Activate plugin
 * This action is documented in includes/class-wc_cf7-activator.php
 */
function activate_wc_cf7() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc_cf7-activator.php';
	Wc_cf7_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc_cf7-deactivator.php
 */
function deactivate_wc_cf7() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc_cf7-deactivator.php';
	Wc_cf7_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_cf7' );
register_deactivation_hook( __FILE__, 'deactivate_wc_cf7' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc_cf7.php';

/**
 * Begins execution of the plugin.
 */
function run_wc_cf7() {
	$plugin = new Wc_cf7();
	$plugin->run();
}
run_wc_cf7();

?>