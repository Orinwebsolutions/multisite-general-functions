(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$( document ).ready(function() {
		$('#woocommerce_paypal_testmode').on('click', function(){
            if($(this).prop("checked") == true){
				$('#woocommerce_paypal_api_details_tbl tbody tr').each(function($i) {
					if($i < 3){
						$(this).css('display', 'none');
					}else{
						$(this).css('display', 'table-row');
					}
					// console.log($i);
				});
                // console.log("Checkbox is checked.");
            }
            else if($(this).prop("checked") == false){
				$('#woocommerce_paypal_api_details_tbl tbody tr').each(function($i) {
					if($i < 3){
						$(this).css('display', 'table-row');
					}else{
						$(this).css('display', 'none');
					}
					// console.log($i);
				});
                // console.log("Checkbox is unchecked.");
            }
			// console.log('yes loading');
		});
	});

})( jQuery );
