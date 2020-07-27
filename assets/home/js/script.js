/*=========== bg-fun ==============*/
$(document).ready(function(e) {
    $('label.bg').click(function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$('input',this).attr('checked',false);
		}else{
			$(this).addClass('active');
			$('input',this).attr('checked',true);
		}
		return false;
	});

	$('label.bg-fun').click(function(){
		
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$('input',this).attr('checked',false);
		}else{
			$(this).addClass('active');
			$('input',this).attr('checked',true);
		}
		return false;
	});
	});




$(window).scroll(function(){
    if ($(window).scrollTop() >= 1) {
       $('nav').addClass('fixed-header');
    }
    else {
       $('nav').removeClass('fixed-header');
    }
});
