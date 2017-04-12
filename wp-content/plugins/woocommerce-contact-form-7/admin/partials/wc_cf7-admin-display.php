<?php
/**
 * This file primarily consist of admin HTML 
 *
 * @package    Wc_cf7
 * @subpackage Wc_cf7/admin/partials
 */
?>

<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<?php settings_errors();
	$active_tab = '';
	if( isset( $_GET[ 'tab' ] ) ) {
		$active_tab = $_GET[ 'tab' ];
	} else if( $active_tab == 'button_setting' ) {
		$active_tab = 'button_settings';
	} else {
		$active_tab = 'general_settings';
	} // end if/else ?>

	<h2 class="nav-tab-wrapper">
		<a href="?page=woocommerce-contact-form-7&tab=general_settings" class="nav-tab <?php echo $active_tab == 'general_settings' ? 'nav-tab-active' : ''; ?>"><?php _e( 'General Settings', 'wc_cf7_admin' ); ?></a>
		<a href="?page=woocommerce-contact-form-7&tab=button_settings" class="nav-tab <?php echo $active_tab == 'button_settings' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Button Settings', 'wc_cf7_admin' ); ?></a>
	</h2>
	<form method="post" action="options.php"> 
	<?php 
	if( $active_tab == 'general_settings' ) {
		require_once('wp_cf7_general_settings.php');
	} else {
		require_once('wp_cf7_button_settings.php');
	} // end if/else

	submit_button();
	 ?>
	</form>
</div>