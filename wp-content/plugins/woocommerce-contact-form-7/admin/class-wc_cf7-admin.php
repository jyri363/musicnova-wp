<?php
/**
 * WooCommerce and Contact Form 7 Admin
 *
 * @class       Wc_cf7
 * @author      Jüri-Joonas Kerem <jyri363@gmail.com>
 * @category    Admin
 * @package     woocomerce-contact-form-7
 * @subpackage	woocomerce-contact-form-7/admin
 * @since      	1.0.0
 */

class Wc_cf7_Admin {
	
	/**
	 * The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 */	 
	private $version;
	
	/**
	 * Constructor
	 */	 
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'wp-color-picker' ); 
		wp_enqueue_style( $this->plugin_name, WC_CF7_PLUGIN_DIR_URL . '/admin/css/wc_cf7-admin.css', array( 'wp-color-picker' ), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, WC_CF7_PLUGIN_DIR_URL . '/admin/js/wc_cf7-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );
	}

	/**
	 * Create a WooCommerce and Contact Form 7 admin Settings menu
	 */
	public function add_plugin_admin_menu() {
		//create new top-level menu
		add_menu_page( 
			__( 'WooCommerce and Contact Form 7 Settings', $this->plugin_name ),
			__( 'WC & CF7', $this->plugin_name ),
			'administrator',
			$this->plugin_name,
			array($this, 'wc_cf7_plugin_settings_page'),
			plugins_url($this->plugin_name.'/images/icon.png', $this->plugin_name),
			40
		); 
		// Add a submenu
		add_submenu_page(
			$this->plugin_name,
			__('Custom CSS',$this->plugin_name), 
			__('Custom CSS',$this->plugin_name), 
			'administrator', 
			$this->plugin_name.'_css', 
			array($this, 'wc_cf7_plugin_css_page')
		);
		//call register settings function
		//add_action( 'admin_init', 'register_wc_cf7_plugin_settings' );
	}
	/**
	 * Display a WooCommerce and Contact Form 7 top menu admin page
	 */
	public function wc_cf7_plugin_settings_page(){ 
		include_once( 'partials/wc_cf7-admin-display.php' );
	}
	/**
	 * Display a WooCommerce and Contact Form 7 sub menu admin page
	 */
	public function wc_cf7_plugin_css_page(){ 
		include_once( 'partials/wc_cf7-admin-css_display.php' );
	}
	/**
	* Add settings action link to the plugins page.
	*/
	public function add_action_links( $links ) {
	   $settings_link = array(
		'<a href="' . admin_url( 'admin.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );
	}
	
	/**
	* validates top menu general setting 
	**/
	public function validate($value) {
		// All inputs top menu       
		$valid = array();
		$valid['jjk_cf7'] = $value['jjk_cf7'];
		if(!empty($value['jjk_rename'])){
			$valid['jjk_rename'] = $value['jjk_rename'];
		} else { $valid['jjk_rename'] = 'Ask more'; }
		$valid['jjk_position_cf7'] = $value['jjk_position_cf7'];
		$valid['jjk_remove_add_to_cart'] = (isset($value['jjk_remove_add_to_cart']) && !empty($value['jjk_remove_add_to_cart'])) ? 1 : 0;
		$valid['jjk_add_from_button_loops'] = (isset($value['jjk_add_from_button_loops']) && !empty($value['jjk_add_from_button_loops'])) ? 1 : 0;
		return $valid;
	}
	/**
	 * Register settings/options top menu general setting 
	 */
	public function options_update() {
		//register our settings top menu 
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}
		/**
	* validates top menu button setting 
	**/
	public function validate_button($value) {
		// All inputs top menu       
		$valid = array();
		$valid['jjk_button'] = (isset($value['jjk_button']) && !empty($value['jjk_button'])) ? 1 : 0;
		$valid['jjk_popup'] = (isset($value['jjk_popup']) && !empty($value['jjk_popup'])) ? 1 : 0;
		$valid['jjk_button_color'] = $value['jjk_button_color'];
		$valid['jjk_button_background_color'] = $value['jjk_button_background_color'];
		$valid['jjk_popup_color'] = $value['jjk_popup_color'];
		$valid['jjk_popup_background_color'] = $value['jjk_popup_background_color'];
		return $valid;
	}
	/**
	 * Register settings/options top menu button setting 
	 */
	public function options_update_button() {
		//register our settings top menu 
		register_setting($this->plugin_name.'_button', $this->plugin_name.'_button', array($this, 'validate_button'));
	}
	/**
	 * Provides default values for the Display Sub Options.
	 *
	 * @return array
	 
	public function default_display_sub_options() {
		require_once( 'partials/wc_cf7-css_js_default.php' );
		$defaults = array(
			'jjk_css'		=>	jjk_default_css(),
			'jjk_js'		=>	jjk_default_js(),
		);
		return $defaults;
	}
	*/
	/**
	* validates sub menu Custom CSS
	**/
	public function validate_sub($value) {
		// All inputs sub menu 
		$valid = array();
		//if isset 'reset'
		/*if (isset($_POST['reset'])) {
			return $this->default_display_sub_options(); //Default settings
		}*/	
		// if isset 'submit'
		$valid['jjk_css'] = $value['jjk_css'];
		/*$valid['jjk_js'] = $value['jjk_js'];*/
		return $valid;
	}
	/**
	 * Register settings/options sub menu Custom CSS 
	 */
	public function options_update_sub() {
		//register our settings sub menu 
		register_setting($this->plugin_name.'_css', $this->plugin_name.'_css', array($this, 'validate_sub'));
	}
	/**/
	public function woo_rename_tabs( $tabs ) {
		global $product;
		$options = get_option($this->plugin_name);	
		$jjk_rename = $options['jjk_rename'];
		$jjk_position_cf7 = $options['jjk_position_cf7'];
		$jjk_cf7 = $options['jjk_cf7'];
		if($jjk_position_cf7 == "tab" && $jjk_cf7 != ""){
			$tabs['jjk_tab']['title'] = __( $jjk_rename );			
		}
		return $tabs;			// Rename the tab
	}
}
