<?php
function get_message($id, $var = '') {
	$message = messages ();
	return sprintf ( $message [$id] . " (%s)<br>%s", $id, $var );
}
function messages() {
	return array (
			'F01' => 'Es wurde kein Datum eingegeben.',
			'F02' => 'Es wurde kein gültiges Datum eingegeben.',
			'F03' => 'Die Schmerzart wurde unzutreffend übermittelt!',
			'F04' => 'Die eingenommenen Medikamente wurde unzutreffend übermittelt!',
			'F05' => 'Die eingenommenen Medikamente wurde unzutreffend übermittelt!',
			'F06' => 'Der Schmerzgrad wurde unzutreffend übermittelt!',
			'F07' => 'Die zusätzlichen Informationen wurde unzutreffend übermittelt!',
			'F08' => 'Die eingenommenen Medikamente konnten nicht in der Datenbank gespeichert werden!',
			'F09' => 'Die eingenommenen Medikamente konnten nicht in der Datenbank gespeichert werden!',
			'F10' => 'Der Schmerztag konnten der Datenbank nicht hinzugefügt werden!',
			'F11' => 'Der Schmerztag konnten in der Datenbank nicht aktualisiert werden!',
			'F12' => 'Der Schmerztag konnten der Datenbank nicht abgefragt werden!',
			'F13' => 'Bei der Parameterübergabe wurden unregelmäßigkeiten festgestellt.',
			'F14' => 'Bei der Parameterübergabe wurden unregelmäßigkeiten festgestellt.',
			'F15' => 'Das Medikament existiert nicht in der Datenbank.',
			'F16' => 'Bei der Parameterübergabe wurden unregelmäßigkeiten festgestellt.',
			'F17' => 'Der Datenbankeintrag für das Medikament konnte nicht aktualisiert werden.',
			'F18' => 'Das Medikament konnte nicht in der Datenbank gespeichert werden.',
			'F19' => 'Die eingebene Abkürzung wurde bereits für ein anderes Medikament verwendet.',
			'F20' => 'Bei der Parameterübergabe wurden unregelmäßigkeiten festgestellt.',
			'F21' => 'Bei der Parameterübergabe wurden unregelmäßigkeiten festgestellt.',
			'F22' => 'Bei der Parameterübergabe wurden unregelmäßigkeiten festgestellt.',
			'F23' => 'Das zu löschende Medikament existiert nicht.',
			'F24' => 'Bereits eingenommene Medikamente dürfen nicht gelöscht werden.',
			'H01' => 'Es wurde ein Schmerzgrad angegeben aber keine Schmerzart ausgewählt.',
			'H02' => 'Schmerzart und Medikamente wurden nicht ausgewählt. Der Tag wird im Kalender besonders gekennzeichnet.' 
	);
}