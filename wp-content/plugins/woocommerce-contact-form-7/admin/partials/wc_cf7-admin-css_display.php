<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()) ?></h2>
	<form method="post" action="options.php">
	<?php 
		// Grab all options
        $options = get_option($this->plugin_name.'_css');	
		// Custom CSS
		$jjk_css = $options['jjk_css'];
		//$jjk_js = $options['jjk_js'];
		//Settings fields
		settings_fields($this->plugin_name.'_css'); 
		do_settings_sections($this->plugin_name.'_css'); 
		?>
		<h2><?php esc_attr_e( 'Custom CSS', 'wp_admin_style' ); ?></h2>
		<textarea id="jjk_css" name="<?php echo $this->plugin_name.'_css'; ?>[jjk_css]" cols="80" rows="10" class="large-text"><?php echo $jjk_css; ?></textarea>
		
		<?php submit_button(); //submit_button( __('Reset', 'wc_cf7_admin'), 'secondary', 'reset', false); 
		?>		
	</form>	
</div>