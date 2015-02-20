jQuery(document).ready(function(){
	//var timeline = new VMM.Timeline();
	//timeline.init("data.json");


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

});