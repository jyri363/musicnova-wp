<?php 
global $post;
$ID = $post->ID;
?>
(function( $ ) {
	'use strict';
	$('.my-subject').click(function(){ //on click of the order button
		var title = $(this).attr('dataTitle'); //put the current dataTitle in the variable title
		$(".your-subject input").val( title); //put the title as the subject in your contact form 7
	});
	//$('.jjk_product_name').val('<?php echo get_the_title( $ID )." ".$ID ?>'); 
	$(function() {
		$('.jjk_show').bind('click', function(e) {
			e.preventDefault();
			$('.jjk_element_to_pop_up').bPopup();
		});
	});
})( jQuery );
