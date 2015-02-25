jQuery(document).ready(function(){
	//var timeline = new VMM.Timeline();
	//timeline.init("data.json");
	var lastScrollTop = 0;


	jQuery('.fa-search, .fa-close').click(function(){
		jQuery('#searchform').toggleClass('hidden');
		jQuery('#searchform #s').focus();
		event.preventDefault();
	});

	jQuery('#searchform').submit(function(){
		jQuery('.unecat').each(function(){
			if (this.checked) {
		    jQuery('.post-checkbox').prop('checked', true);
		    }
		});
	});

	jQuery(window).scroll(function(){
	    var $nav = jQuery('.home-link');
	    if (jQuery('body').scrollTop() > 20) {
	    	jQuery('.home-link').css("top", "-40px");
	    } else {
	    	//alert('déployé');
	    }
	
		jQuery('.home-link').css("top", Math.max(0, -12 - jQuery(this).scrollTop()));
	});

});