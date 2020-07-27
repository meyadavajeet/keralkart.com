jQuery(document).ready(function() {
	jQuery('#showLess').hide();
	jQuery('.hidden_list').hide();
	
	jQuery('#showAll').click(function(e) {
		jQuery('.hidden_list').show();
		jQuery('#showLess').show();
		jQuery('#showAll').hide();

		e.preventDefault();
	});
	
	jQuery('#showLess').click(function(e) {
		jQuery('.hidden_list').hide();
		jQuery('#showAll').show();
		jQuery('#showLess').hide();

		e.preventDefault();
	});
});