jQuery(document).ready(function($){

	// gravity forms custom placeholders
	$('.site-inner li.gfield .gfield_label').click(function(){
		$(this).next('.ginput_container').find('input[type="text"], textarea').focus();
	});

	$('.site-inner .ginput_container input[type="text"], .site-inner .ginput_container textarea')
	.focus(function(){
		$(this).closest('.ginput_container').prev('.gfield_label').hide();
	})
	.blur(function(){
		if( $(this).val() === "" ){
			$(this).closest('.ginput_container').prev('.gfield_label').show();
		}
	});

	$('.site-inner .ginput_container input[type="text"], .site-inner .ginput_container textarea').each(function(){
		if( $(this).val() !== "" ){
			$(this).closest('.ginput_container').prev('.gfield_label').hide();
		}
	});

});
