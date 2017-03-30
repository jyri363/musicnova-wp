<?php

/* ---------------------------------------------------------------------------
 * Child Theme URI | DO NOT CHANGE
 * --------------------------------------------------------------------------- */
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );


/* ---------------------------------------------------------------------------
 * Define | YOU CAN CHANGE THESE
 * --------------------------------------------------------------------------- */

// White Label --------------------------------------------
define( 'WHITE_LABEL', false );

// Static CSS is placed in Child Theme directory ----------
define( 'STATIC_IN_CHILD', false );


/* ---------------------------------------------------------------------------
 * Enqueue Style
 * --------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'mfnch_enqueue_styles', 101 );
function mfnch_enqueue_styles() {
	
	// Enqueue the parent stylesheet
// 	wp_enqueue_style( 'parent-style', get_template_directory_uri() .'/style.css' );		//we don't need this if it's empty
	
	// Enqueue the parent rtl stylesheet
	if ( is_rtl() ) {
		wp_enqueue_style( 'mfn-rtl', get_template_directory_uri() . '/rtl.css' );
	}
	

	// Enqueue the child stylesheet
	wp_dequeue_style( 'style' );
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() .'/style.css' );
	// 
	//wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css');
	
}

function my_assets() {
	wp_register_script( 'Isotope', CHILD_THEME_URI . '/js/jquery.isotope.min.js', array( 'jquery' ) , '1.5.25', false);
	wp_enqueue_script( 'Isotope' );
}

add_action( 'wp_enqueue_scripts', 'my_assets' );

/* ---------------------------------------------------------------------------
 * Load Textdomain
 * --------------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'mfnch_textdomain' );
function mfnch_textdomain() {
    load_child_theme_textdomain( 'betheme',  get_stylesheet_directory() . '/languages' );
    load_child_theme_textdomain( 'mfn-opts', get_stylesheet_directory() . '/languages' );
}


/* ---------------------------------------------------------------------------
 * Override theme functions
 * 
 * if you want to override theme functions use the example below
 * --------------------------------------------------------------------------- */
require_once( get_stylesheet_directory() .'/includes/content-portfolio.php' );
//require_once( get_stylesheet_directory() .'/includes/content-single-portfolio.php' );

// As of 3.1.10, Customizr doesn't output an html5 form.
add_theme_support( 'html5', array( 'search-form' ) );
add_filter('wp_nav_menu_items', 'add_search_form_to_menu', 10, 2);
function add_search_form_to_menu($items, $args) {
  // If this isn't the main navbar menu, do nothing
  if( !($args->theme_location == 'main') ) // with Customizr Pro 1.2+ and Cusomizr 3.4+ you can chose to display the saerch box to the secondary menu, just replacing 'main' with 'secondary'
    return $items;
  // On main menu: put styling around search and append it to the menu items
  return $items . '<li class="my-nav-menu-search">' . get_search_form(false) . '</li>';
}



// wpcf7 custom shortcode

add_action( 'wpcf7_init', 'custom_add_shortcode_clock' );
 
function custom_add_shortcode_clock() {
    wpcf7_add_shortcode( 'clock', 'custom_clock_shortcode_handler' ); // "clock" is the type of the form-tag
}
 
function custom_clock_shortcode_handler( $tag ) {
    return date_i18n( get_option( 'time_format' ) );
}
//
wpcf7_add_shortcode('custom_number', 'wpcf7_custom_number_shortcode_handler');

function wpcf7_custom_number_shortcode_handler($tag) {
	//if (!is_array($tag)) return '';
	//
    $name = $tag['name'];
    //if (empty($name)) return '';
	
    $number = "0.00"; 
    $html = '<span class="wpcf7-form-control-wrap '.$name.'">
	<input type="number" name="number" value="' . $number . '" min="0.00" step="0.01"  class="wpcf7-form-control wpcf7-text" />
	</span>';
    return $html;
}


