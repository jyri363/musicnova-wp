<?php
/**
 * The file that defines the core plugin class
 * 
 * @author      Jüri-Joonas Kerem <jyri363@gmail.com>
 * @package     Wc_cf7
 * @subpackage  Wc_cf7/includes
 * @version   	1.0.0
 */
 
class Wc_cf7 {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @access   protected
	 * @var      Wc_cf7_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 */
	public function __construct() {

		$this->plugin_name = WC_CF7_PLUGIN_NAME;
		$this->version = WC_CF7_VERSION;

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wc_cf7_Loader. Orchestrates the hooks of the plugin.
	 * - Wc_cf7_i18n. Defines internationalization functionality.
	 * - Wc_cf7_Admin. Defines all hooks for the admin area.
	 * - Wc_cf7_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once WC_CF7_PLUGIN_DIR . '/includes/class-wc_cf7-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once WC_CF7_PLUGIN_DIR . '/includes/class-wc_cf7-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once WC_CF7_PLUGIN_DIR . '/admin/class-wc_cf7-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once WC_CF7_PLUGIN_DIR . '/public/class-wc_cf7-public.php';

		$this->loader = new Wc_cf7_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wc_cf7_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wc_cf7_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all in admin page
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Wc_cf7_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		// Add menu item
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );
		// Add Settings link to the plugin
		$this->loader->add_filter( 'plugin_action_links_' . WC_CF7_PLUGIN_BASENAME, $plugin_admin, 'add_action_links' );
		// Save/Update our plugin options
		$this->loader->add_action('admin_init', $plugin_admin, 'options_update');
		$this->loader->add_action('admin_init', $plugin_admin, 'options_update_button');
		$this->loader->add_action('admin_init', $plugin_admin, 'options_update_sub');
		if(get_option($this->plugin_name)['jjk_cf7'] != "")
			$this->loader->add_filter( 'woocommerce_product_tabs', $plugin_admin,'woo_rename_tabs', 98 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Wc_cf7_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		
		//if(get_option($this->plugin_name.'_css')['jjk_css'] != ''){
			$this->loader->add_action('wp_head',$plugin_public,'hook_css_box');
		//} else {
			
		//}

		//if(get_option($this->plugin_name.'_css_js')['jjk_js'] != ''){
			$this->loader->add_action('wp_footer',$plugin_public,'hook_js_box',30);
		//} else {
			
		//}
		
		// Add woocommerce script vars
		$this->loader->add_action('woocommerce_before_main_content', $plugin_public, 'add_scripts_action');	
		// Add woocommerce product page new button and/or remove Add to Cart button
		if(get_option($this->plugin_name)['jjk_remove_add_to_cart']){
			$this->loader->add_action('init',$plugin_public, 'remove_add_to_cart_button');
			$this->loader->add_action('woocommerce_single_product_summary', $plugin_public, 'add_new_button', 30 );
		} else {
			$this->loader->add_filter('woocommerce_after_add_to_cart_button', $plugin_public, 'add_new_button', 30 );
		}
		if(get_option($this->plugin_name)['jjk_add_from_button_loops']) $this->loader->add_action('woocommerce_after_shop_loop_item',$plugin_public,'add_new_button');
		//$this->loader->add_action('woocommerce_after_shop_loop_item',$plugin_public,'product_3213');
		//$this->loader->add_filter('woocommerce_is_purchasable', $plugin_public, 'my_woocommerce_is_purchasable', 10, 2);	
		// Add woocommerce tab
		$this->loader->add_filter( 'woocommerce_product_tabs', $plugin_public, 'product_enquiry_tab' );
		//$this->loader->add_filter( 'woocommerce_product_tabs', $plugin_public,'woo_rename_tabs', 98 );
		// Add woocommerce template
		$this->loader->add_filter( 'woocommerce_locate_template', $plugin_public, 'wc_cf7_woocommerce_locate_template', 10, 3  );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    Wc_cf7_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
