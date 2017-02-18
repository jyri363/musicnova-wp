<?php
/**
 * The template for displaying content in the single-portfolio.php template
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

// prev & next post -------------------


// categories -------------------------
$categories 	= '';
$aCategories 	= '';

$terms = get_the_terms( get_the_ID(), 'portfolio-types' );
if( is_array( $terms ) ){
	foreach( $terms as $term ){
		$categories		.= '<li><a href="'. get_term_link($term) .'">'. $term->name .'</a></li>';
		$aCategories[]	= $term->term_id;  
	}
}

	
