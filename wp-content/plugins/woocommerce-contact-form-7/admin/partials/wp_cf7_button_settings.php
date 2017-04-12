<?php	
		global $product;
		// Grab all top options
        $options = get_option($this->plugin_name.'_button');	
		// Button Options
		$jjk_button = $options['jjk_button'];
		$jjk_popup = $options['jjk_popup'];
		$jjk_button_color = $options['jjk_button_color'];
		$jjk_button_background_color = $options['jjk_button_background_color'];
		$jjk_popup_color = $options['jjk_popup_color'];
		$jjk_popup_background_color = $options['jjk_popup_background_color'];
		// Settings fields
		settings_fields($this->plugin_name.'_button'); 
		do_settings_sections($this->plugin_name.'_button'); 
?>
			<!-- Button -->
			<h2><?php esc_attr_e( 'Custom Button and PopUp setting', 'wc_cf7_admin' ); ?></h2>			
			<fieldset>
				<legend class="screen-reader-text"><span><?php esc_attr_e( 'Custom Button setting on', 'wc_cf7_admin' ); ?></span></legend>
				<label for="jjk_button">
					<input name="<?php echo $this->plugin_name; ?>_button[jjk_button]" type="checkbox" id="jjk_button" value="1" <?php checked($jjk_button, 1); ?> />
					<span><?php esc_attr_e( 'Custom Button setting on', 'wc_cf7_admin' ); ?></span>
				</label>
			</fieldset>
			<!-- PopUp -->
			<fieldset>
				<legend class="screen-reader-text"><span><?php esc_attr_e( 'Custom PopUp setting on', 'wc_cf7_admin' ); ?></span></legend>
				<label for="jjk_popup">
					<input name="<?php echo $this->plugin_name; ?>_button[jjk_popup]" type="checkbox" id="jjk_popup" value="1" <?php checked($jjk_popup, 1); ?> />
					<span><?php esc_attr_e( 'Custom PopUp setting on', 'wc_cf7_admin' ); ?></span>
				</label>
			</fieldset>
			<!-- buttons color -->
            <fieldset class="wp_cbf-colors">
                <legend class="screen-reader-text"><span><?php _e('Button Text Color', 'wc_cf7_admin');?></span></legend>
                <label for="jjk_button_color">
                    <input type="text" class="wc_cf7_color-picker" id="jjk_button_color" name="<?php echo $this->plugin_name; ?>_button[jjk_button_color]" value="<?php echo $jjk_button_color;?>" />
                    <span><?php esc_attr_e('Button Text Color', 'wc_cf7_admin');?></span>
                </label>
            </fieldset>
			 <fieldset class="wp_cbf-colors">
                <legend class="screen-reader-text"><span><?php _e('Button background color', 'wc_cf7_admin');?></span></legend>
                <label for="jjk_button_background_color">
                    <input type="text" class="wc_cf7_color-picker" id="jjk_button_background_color" name="<?php echo $this->plugin_name; ?>_button[jjk_button_background_color]" value="<?php echo $jjk_button_background_color;?>" />
                    <span><?php esc_attr_e('Button background color', 'wc_cf7_admin');?></span>
                </label>
            </fieldset>
			<!-- popup color -->
			 <fieldset class="wp_cbf-colors">
                <legend class="screen-reader-text"><span><?php _e('Popup color', 'wc_cf7_admin');?></span></legend>
                <label for="jjk_popup_color">
                    <input type="text" class="wc_cf7_color-picker" id="jjk_popup_color" name="<?php echo $this->plugin_name; ?>_button[jjk_popup_color]" value="<?php echo $jjk_popup_color;?>" />
                    <span><?php esc_attr_e('Popup color', 'wc_cf7_admin');?></span>
                </label>
            </fieldset>
			 <fieldset class="wp_cbf-colors">
                <legend class="screen-reader-text"><span><?php _e('Popup background color', 'wc_cf7_admin');?></span></legend>
                <label for="jjk_popup_background_color">
                    <input type="text" class="wc_cf7_color-picker" id="jjk_popup_background_color" name="<?php echo $this->plugin_name; ?>_button[jjk_popup_background_color]" value="<?php echo $jjk_popup_background_color;?>" />
                    <span><?php esc_attr_e('Popup background color', 'wc_cf7_admin');?></span>
                </label>
            </fieldset>

			<?php //echo $jjk_button_color; ?>