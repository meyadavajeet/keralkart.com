var breadcrumbs = '';
jQuery(document).ready(function() {
	var src = jQuery('.product_small_image_first').children().attr('src');
	var html = '<img src='+src+' width='+100+'% height='+100+'%>';
	jQuery('.product_image').html(html);
	
		
	function close_accordion_section() {
		jQuery('.accordion .accordion-section-title').removeClass('active');
		jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
	}

	jQuery('.accordion-section-title').click(function(e) {
		// Grab current anchor value
		var currentAttrValue = jQuery(this).attr('href');

		if(jQuery(e.target).is('.active')) {
			close_accordion_section();
		}else {
			close_accordion_section();

			// Add active class to section title
			jQuery(this).addClass('active');
			// Open up the hidden content panel
			jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
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
		var html = '<img src='+src+' width='+100+'% height='+100+'%>';
		jQuery('.product_image').html(html);
		jQuery(this).css("border","2px solid green");
		jQuery(this).siblings().css("border","1px solid #f0f0f0");
	});
	
	jQuery('#changePasswordId').hide();
	jQuery('#myorders').hide();
	
	jQuery('#editProfileButtonId').click(function(){
		jQuery('#editProfileId').show();
		jQuery('#changePasswordId').hide();
		jQuery('.userInformation').show();
		jQuery('#myorders').hide();
	});
	
	jQuery('#changeAddress').click(function(){
		jQuery('#editProfileId').show();
		jQuery('#changePasswordId').hide();
		jQuery('.userInformation').hide();
		jQuery('#myorders').hide();
	});
	
	jQuery('#changePasswordButtonId').click(function(){
		jQuery('#editProfileId').hide();
		jQuery('#changePasswordId').show();
		jQuery('#myorders').hide();
	});
	
	jQuery('#myOrdersButtonId').click(function(){
		jQuery('#editProfileId').hide();
		jQuery('#changePasswordId').hide();
		jQuery('.userInformation').hide();
		jQuery('#myorders').show();
	});
	
	var textareaDiv = 	"<div class='form-row separator'>"+
						"<textarea class='form-control' placeholder='Address'></textarea>"+
						"</div>";
	
	var count=0;		
	
	jQuery('#addAddressButton1').click(function(){
		if(count==0) {
			jQuery('#addressDiv2').html(textareaDiv);
			count++;
		} else if (count==1){
			jQuery('#addressDiv3').html(textareaDiv);
			count++;
		}
	});
	
	jQuery('#removeAddressButton').click(function(){
		jQuery('#addressDiv2').hide();
	});
	
});