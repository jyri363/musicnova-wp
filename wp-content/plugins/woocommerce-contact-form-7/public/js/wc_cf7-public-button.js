(function( $ ) {
	'use strict';
	$('.jjk_data').click(function(){ //on click of the order button
		var title = $(this).attr('dataTitle'); //put the current dataTitle in the variable title
		$("input.jjk_product_name").val( title); //put the title as the subject in your contact form 7
	});
	$(function() {
		$('.jjk_show').bind('click', function(e) {
			e.preventDefault();
			$('.jjk_element_to_pop_up').bPopup();
		});
	});
	
})( jQuery );