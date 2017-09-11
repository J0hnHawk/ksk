<?php
/**
 * This file is part of the "Kopfschmerzkalender" package.
 * Copyright (C) 2017 John Hawk <john.hawk@gmx.net>
 *
 * "NF Marsch Webstats" is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * "NF Marsch Webstats" is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Foobar. If not, see <http://www.gnu.org/licenses/>.
 */

if (! defined ( 'IN_KSK' )) {
	exit ();
}

function get_message($id, $var = '') {
	$messages = messagesArray ();
	return sprintf ( $messages [$id] . " (%s)<br>%s", $id, $var );
}
function getMessage($messageID, $errorCode) {
	$messages = messagesArray ();
	return sprintf ( $messages [$messageID] . " (%s)<br>", $errorCode );
}
function messagesArray() {
	return array (
			201 => 'Es wurde kein gültiger Benutzername eingeben.',
			202 => 'Es wurde kein gültiges Passwort eingegebn.',
			203 => 'Fehler bei der Übermittlung der Forumlardaten.',
			204 => 'Es wurde keine gültige E-Mail-Adresse eingegeben.',
			205 => 'Die E-Mail-Adresse wird bereits verwendet.',
			206 => 'Der Benutzername oder das Passwort ist falsch.',
			207 => 'Der Benutzername wird bereits verwendet.',
			208 => 'Datenbankfehler!',
			209 => 'Das Benutzerkonto wurde angelegt.',
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
			'F25' => 'Es wurde kein Benutzername eingegeben.',
			'F26' => 'Bei der Parameterübergabe wurden unregelmäßigkeiten festgestellt.',
			'F27' => 'Es wurde kein Passwort eingegeben.',
			'F28' => 'Bei der Parameterübergabe wurden unregelmäßigkeiten festgestellt.',
			'F29' => 'Bei der Parameterübergabe wurden unregelmäßigkeiten festgestellt.',
			'F30' => 'Der Benutzername darf nicht leer sein.',
			'F31' => 'Die eingebene Email-Adresse war ungültig.',
			'F32' => 'Dein Passwort muss mindestens 8 Zeichen haben.',
			'F33' => 'Diese E-Mail-Adresse ist bereits vergeben.',
			'F34' => 'Bitte benutze für den Benutzernamen nur alphanumerische Zeichen (Zahlen, Buchstaben und den Unterstrich).',
			'H01' => 'Es wurde ein Schmerzgrad angegeben aber keine Schmerzart ausgewählt.',
			'H02' => 'Schmerzart und Medikamente wurden nicht ausgewählt. Der Tag wird im Kalender besonders gekennzeichnet.' 
	);
}