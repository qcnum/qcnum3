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


	jQuery('.sharer').click(function(){
		jQuery(this).next().toggleClass('visible');
		event.preventDefault();
	});

    jQuery('#full-screen').click(function(){
        jQuery(".map-content").toggleClass('full-screen-map');
        event.preventDefault();
        initialize();
    });


 	jQuery(window).scroll(function () {
 
        if (jQuery(this).scrollTop() > 5) {
            jQuery('.site-description').addClass('fadeout');
        } else {
            jQuery('.site-description').removeClass('fadeout');
        }

        if (jQuery(this).scrollTop() > 70) {
            jQuery('.home-link').addClass('retract');
            jQuery('.navigation .meta').addClass('retract-tag');

        } else {
            jQuery('.home-link').removeClass('retract');
            jQuery('.navigation .meta').removeClass('retract-tag');
        }

    });

});



function calculResize() {

	element = jQuery(window);

	if(element[0].outerWidth >= 1024 ) {
		
	} 

	if(element[0].outerWidth >= 768 ) {
		

	} else {

	}

}