jQuery(document).ready( function($) {
	$('.edit-expiringdate').click(function () {
		if ($('#expiringdatediv').is(':hidden')) {
			$('#expiringdatediv').slideDown('normal');
			$('.edit-expiringdate').hide();
		}
		return false;
	});
	$('.set-expiringdate').click(function() {
		$('#expiringdatediv').slideUp('normal');
		$('.edit-expiringdate').show();
		var edate = $('.expiring-datepicker').val();
		$('.setexpiringdate').html( edate );
		return false;
	});
	$('.cancel-expiringdate').click(function() {
		$('#expiringdatediv').slideUp('normal');
		$('.edit-expiringdate').show();
		var edate = $('.expiring-datepicker').attr('data-exdate');
		$('.setexpiringdate').html( edate );
		$('.expiring-datepicker').val( edate );
		return false;
	});
	
	jQuery('.expiring-datepicker').datepicker({ dateFormat : 'yy-mm-dd' });
	//$.datepicker.setDefaults($.datepicker.regional['pl']);
})
/*
jQuery(function($){
	$.datepicker.regional['pl'] = {
			closeText: 'Zamknij',
			prevText: '&#x3c;Poprzedni',
			nextText: 'Następny&#x3e;',
			currentText: 'Dziś',
			monthNames: ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec',
			'Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],
			monthNamesShort: ['Sty','Lu','Mar','Kw','Maj','Cze',
			'Lip','Sie','Wrz','Pa','Lis','Gru'],
			dayNames: ['Niedziela','Poniedzialek','Wtorek','Środa','Czwartek','Piątek','Sobota'],
			dayNamesShort: ['Nie','Pn','Wt','Śr','Czw','Pt','So'],
			dayNamesMin: ['N','Pn','Wt','Śr','Cz','Pt','So'],
			weekHeader: 'Tydz',
			dateFormat: 'yy-mm-dd',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['pl']);
});*/
