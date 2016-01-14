jQuery(document).ready(function() {
	if(!warning) jQuery('#kstage').hide();
	//jQuery('#options').hide();
});
jQuery(document).ready(function() {
	
	jQuery('#toggle1').click(function() {
		if($('#toggle1').html() == 'Kopfschmerztage anzeigen') {
			jQuery('#kstage').fadeIn('slow');
			$('#toggle1').html('Kopfschmerztage ausblenden');
		} else {
			jQuery('#kstage').fadeOut('slow');
			$('#toggle1').html('Kopfschmerztage anzeigen');
		}
		
	});
	jQuery('#toggle2').click(function() {
		if($('#options').is(":visible") == false) {
			jQuery('#options').fadeIn('slow');
		} else {
			jQuery('#options').fadeOut('slow');
		}
		
	});
});

jQuery(document).ready(function() {
	jQuery('#eintrag_datum').hide();
});
jQuery(document).ready(function() {
	
	jQuery('#datum_waehlen').click(function() {
		jQuery('#eintrag_datum').fadeIn('slow');
		jQuery('#eintrag_daten').fadeOut('slow');
	});
});
