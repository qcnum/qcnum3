jQuery(document).ready(function(){
	//var timeline = new VMM.Timeline();
	//timeline.init("data.json");


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



 	jQuery(window).scroll(function () {
 
        if (jQuery(this).scrollTop() > 10) {
            jQuery('.site-description').fadeOut();
        } else {
            jQuery('.site-description').fadeIn();
        }

        if (jQuery(this).scrollTop() > 50) {
            jQuery('.home-link').addClass('retract');
            //jQuery('.home-link').css("top", "-40px", "background-position-y", "3em" );
            //jQuery('.site-description').css("top", "0em");
        } else {
            jQuery('.home-link').removeClass('retract');
            //jQuery('.home-link').css("top", "0" );
            //jQuery('.site-description').css("top", "3em" );
        }

    });


});