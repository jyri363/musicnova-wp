<?php
/*
Plugin Name: Monday
Plugin URI: http://mp3-jplayer.com
Description: A conversion of the original jPlayer Blue Monday skin for MP3-jPlayer. 
Version: 1.0
Author: Simon Ward
Author URI: http://www.sjward.org
*/


//~~~~~
function frontendFooter_eMPJskin_monday_enqueue () 
{
	global $MP3JP;
	$skin = $MP3JP->theSettings['player_theme'];
	
	if ( $MP3JP->Player_ID > 0 && $skin === 'monday' )
	{
		wp_enqueue_script( 'mjp-skin-monday-js', plugins_url( '/js/frontend.js', __FILE__ ), array('jquery') );
	}
}


//~~~~~
function frontendFooter_eMPJskin_monday ()
{
	global $MP3JP;
	$skin = $MP3JP->theSettings['player_theme'];
	
	if ( $MP3JP->Player_ID > 0 && $skin === 'monday' )
	{	
		$colours = $MP3JP->theSettings['colour_settings'];
		
		$css1 = ".transport-MI div, .gfxbutton_mp3j.play-mjp, .gfxbutton_mp3j.pause-mjp, .popout-wrap-mjp {";
		$css1 .= " border-color:" . $colours['posbar_colour'] . ";";
		$css1 .= " box-shadow:0 0 3px 0.7px " . $colours['posbar_colour'] . "; -moz-box-shadow:0 0 3px 0.7px " . $colours['posbar_colour'] . "; -webkit-box-shadow:0 0 3px 0.7px " . $colours['posbar_colour'] . "; ";
		$css1 .= "}";
		$css2 = ".subwrap-MI, .ul-mjp { border-color:" . $colours['posbar_colour'] . "; }";
		$css3 = ".gfxbutton_mp3j.play-mjp:hover, .gfxbutton_mp3j.pause-mjp:hover, .MIsliderVolume .ui-widget-header, .vol_mp3t .ui-widget-header, .vol_mp3j .ui-widget-header { background-color:" . $colours['posbar_colour'] . "; }";
		
		$js = "<script>\n";
		$js .= "jQuery( document ).ready( function () { \n";
		$js .= " MP3_JPLAYER.extStyles.push( \"" . $css1 . "\" );\n";
		$js .= " MP3_JPLAYER.extStyles.push( \"" . $css2 . "\" );\n";
		$js .= " MP3_JPLAYER.extStyles.push( \"" . $css3 . "\" );\n";
		$js .= " MP3_JPLAYER.skinJS = '" .plugins_url( '/js/frontend.js', __FILE__ ). "'; \n";
		$js .= " MJP_SKINS_INIT(); \n";
		$js .= "}); \n";
		$js .= "</script>";
		echo $js;
	}
}


//~~~~~
function menuHook_eMPJskin_monday () {
	global $MP3JP;
	if ( $MP3JP->menuHANDLES['design'] !== false ) {
		add_action( 'admin_head-'. $MP3JP->menuHANDLES['design'], 'adminScripts_eMPJskin_monday', 100 );
	}
}


//~~~~~
function adminScripts_eMPJskin_monday ()
{	
	wp_enqueue_script( 'monday-admin-js', plugins_url( '/js/admin.js', __FILE__ ), array('jquery') );
}


//~~~~~
function hookup_eMPJskin_monday () 
{
	if ( function_exists('mp3j_put') ) //parent is active and instance exists
	{
		global $MP3JP;
		
		$opValue = 'monday';
		$skinData = array(
			'opValue' => $opValue,
			'opName' => 'Monday',
			'url' => plugins_url('', __FILE__) . '/css/monday-orig.css'
		);
		$MP3JP->SKINS[ $opValue ] = $skinData;
		
		add_action('wp_footer', 'frontendFooter_eMPJskin_monday_enqueue', 10); //scripts
		add_action('wp_footer', 'frontendFooter_eMPJskin_monday', 180); //onload
		add_action('admin_menu', 'menuHook_eMPJskin_monday', 200 );
	}
}


//~~~~~
add_action( 'init', 'hookup_eMPJskin_monday', 90 );
?>