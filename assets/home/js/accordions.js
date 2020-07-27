jQuery(document).ready(function() {
		
	function close_accordions_section() {
		jQuery('.accordions .accordions-section-title').removeClass('active');
		jQuery('.accordions .accordions-section-content').slideUp(300).removeClass('open');
	}

	jQuery('.accordions-section-title').click(function(e) {
		// debugger;	
		// Grab current anchor value
		var currentAttrValue = jQuery(this).attr('href');

		if(jQuery(e.target).is('.active')) {
			close_accordions_section();
		}else {
			close_accordions_section();

			// Add active class to section title
			jQuery(this).addClass('active');
			// Open up the hidden content panel
			jQuery('.accordions ' + currentAttrValue).slideDown(300).addClass('open'); 
		}

		e.preventDefault();
	});
	 
	jQuery('.left-submenu').click(function(e){
		debugger;
		var leftSubMenu = jQuery(this).children().text();
		var leftMenu = jQuery(this).parent().prev().text();
		var menu = jQuery(this).parent().parent().parent().parent().prev().text();
		
		var breadcrumb = '<ul class="breadcrumb"><li><a href="#">Categories</a></li><li><a href="#">'+leftMenu+'</a></li><li>'+leftSubMenu+'</li></ul>';
		
		breadcrumbs = breadcrumb;
		
		//jQuery('#breadcrumbContainer').html(breadcrumb);
		
	});
	
	//jQuery('#breadcrumbContainer').html(breadcrumbs);
	
	jQuery('.product_small_image').hover(function(e){
		var src = jQuery(this).children().attr('src');
		var html = '<img src='+src+' width='+400+' height='+480+'>';
		jQuery('.product_image').html(html);
		jQuery(this).css("border","2px solid green");
		jQuery(this).siblings().css("border","1px solid #f0f0f0");
	});
	
	
});