jQuery(document).ready(function(){
	//var timeline = new VMM.Timeline();
	//timeline.init("data.json");
	var lastScrollTop = 0;


	jQuery('a.fa-search').click(function(){
		jQuery('#searchform').removeClass('hidden');
		jQuery('#searchform #s').focus();
		event.preventDefault();
	});

	jQuery('.fa-close').click(function(){

		if(jQuery('.recherche').hasClass('hidden')) {
			jQuery('#searchform').addClass('hidden');
		} else {
			jQuery('.recherche').addClass('hidden');
			jQuery('#searchform').delay(500).queue(function(up){
				jQuery(this).addClass('hidden'); up();
			});
		}
		event.preventDefault();
	});

	jQuery('.advanced').click(function(){
		jQuery('.recherche').toggleClass('hidden');
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