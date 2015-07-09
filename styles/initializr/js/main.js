jQuery(document).ready(function() {
	if(!warning) jQuery('#kstage').hide();
});
jQuery(document).ready(function() {
	
	jQuery('#toggle').click(function() {
		if($('#toggle').html() == 'Kopfschmerztage anzeigen') {
			jQuery('#kstage').fadeIn('slow');
			$('#toggle').html('Kopfschmerztage ausblenden');
		} else {
			jQuery('#kstage').fadeOut('slow');
			$('#toggle').html('Kopfschmerztage anzeigen');
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
