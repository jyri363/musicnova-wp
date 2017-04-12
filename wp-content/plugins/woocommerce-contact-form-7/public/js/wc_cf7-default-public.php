(function( $ ) {
	'use strict';
	$('.jjk_product_name').val(script_vars.title); 
	$(function() {
		$('.show_jjk').bind('click', function(e) {
			e.preventDefault();
			$('.jjk_element_to_pop_up').bPopup();
		});
	});
})( jQuery );