{if $mode != 'edit'}
<style>
/* http://css-tricks.com/perfect-full-page-background-image/ */
html {
	background: url(styles/{$style}/images/header.jpg) no-repeat center
		center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}

body {
	padding-top: 70px;
	background: transparent;
}

.panel {
	background-color: rgba(255, 255, 255, 0.9);
}
</style>
<div class="modal-dialog">
	<div class="modal-content">
		{if $mode == login}
		<form method="post" action="index.php?page=account&mode=login" class="form-horizontal">
			<div class="modal-header">
				<h4 class="modal-title">Anmelden</h4>
			</div>
			<div class="modal-body">
				{if isset($login_failure)}
				<div class="alert alert-danger">{$login_failure}</div>
				{/if}
				<fieldset>
					<div class="form-group">
						<label for="userName" class="col-sm-3 control-label">Benutzername</label>
						<div class="col-sm-9">
							<input class="form-control" id="userName" name="userName" placeholder="Benutzername" type="text" required>
						</div>
					</div>
					<div class="form-group">
						<label for="userPass" class="col-sm-3 control-label">Passwort</label>
						<div class="col-sm-9">
							<input class="form-control" id="userPass" name="userPass" placeholder="Passwort" type="password" required>
							<div style="text-align: right;">
								<a href="index.php?page=account&mode=password" data-toggle="modal" class="password">Passwort vergessen?</a>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<div class="checkbox">
								<label>
									<input type="checkbox" id="autologin" name="autologin"> Angemeldet bleiben
								</label>
							</div>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Anmelden</button>
				<hr>
				<h6 style="text-align: center;">
					Noch kein Benutzerkonto? - <a href="index.php?page=account&mode=register" data-toggle="modal" class="register">Hier registrieren</a>
				</h6>
			</div>
		</form>
		{elseif $mode == "password"}
		<form method="post" action="index.php?page=account&mode=password" class="form-horizontal">
			<div class="modal-header">
				<h4 class="modal-title">Passwort vergessen</h4>
			</div>
			<div class="modal-body">
				<p>Gib bitte deine E-Mail Adresse ein, die du bei der Registrierung angegeben hast.
				<fieldset>
					<div class="form-group">
						<label for="inputEmail" class="col-sm-3 control-label">E-Mail</label>
						<div class="col-sm-9">
							<input class="form-control" id="inputEmail" name="inputEmail" placeholder="E-Mail" type="email" required>
						</div>
					</div>
				</fieldset>
				<p>Folge bitte den Anweisungen in der E-Mail.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Schlie&szlig;en</button>
				<button type="submit" class="btn btn-primary">Ansenden</button>
				<hr>
				<h6 style="text-align: center;">
					<a href="index.php?page=account&mode=login" data-toggle="modal" class="login">Zurück zur Anmeldemaske</a>
				</h6>
			</div>
		</form>
		{elseif $mode == "register"}
		<form method="post" action="index.php?page=account&mode=register" class="form-horizontal">
			<div class="modal-header">
				<h4 class="modal-title">Registrieren</h4>
			</div>
			<div class="modal-body">
				{if isset($message)}{$message}{/if}
				<fieldset>
					<div class="form-group">
						<label for="inputUser" class="col-sm-3 control-label">Benutzername</label>
						<div class="col-sm-9">
							<input class="form-control" id="inputUser" name="inputUser" placeholder="Benutzername" type="text" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail" class="col-sm-3 control-label">E-Mail</label>
						<div class="col-sm-9">
							<input class="form-control" id="inputEmail" name="inputEmail" placeholder="E-Mail" type="email" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword" class="col-sm-3 control-label">Passwort</label>
						<div class="col-sm-9">
							<input class="form-control" id="inputPassword" name="inputPassword" placeholder="Passwort" type="password" required>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Schlie&szlig;en</button>
				<button type="submit" class="btn btn-primary">Registrieren</button>
				<hr>
				<h6 style="text-align: center;">
					Du hast bereits ein Benutzerkonto? - <a href="index.php?page=account&mode=login" data-toggle="modal" class="login">Hier anmelden</a>
				</h6>
			</div>
		</form>
		{else}
		<div class="alert alert-danger">
			<h1>
				<strong>Fehler!</strong><br>Etwas ganz schlimmes ist passiert.
			</h1>
		</div>
		{/if}
	</div>
</div>
{else}
<div class="page-header hidden-xs">
	<h3>Einstellungen</h3>
</div>
<div class="row">
	<div class="col-sm-9">
		<link rel="stylesheet" href="styles/{$style}/css/bootstrap-slider.css">
		<script type='text/javascript' src="styles/{$style}/js/bootstrap-slider.js"></script>
		<form class="form-horizontal" method="post" action="index.php?page=account&mode=edit">
			<fieldset>
				{if isset($message)}{$message}{/if}
				<div class="form-group">
					<label class="col-sm-4 control-label">Benutzername</label>
					<div class="col-sm-8">
						<p class="form-control-static">{$user.user_name}</p>
						<span class="help-block"> Der Benutzername kann von Administratoren geändert werden.</span>
					</div>
				</div>
				<div class="form-group">
					<label for="emai1" class="col-sm-4 control-label">E-Mail-Adresse</label>
					<div class="col-sm-8">
						<input class="form-control" id="email1" name="email1" value="{$user.user_email}" type="email">
					</div>
				</div>
				<div class="form-group">
					<label for="email2" class="col-sm-4 control-label">Bestätigung der E-Mail-Adresse</label>
					<div class="col-sm-8">
						<input class="form-control" id="email2" name="email2" placeholder="E-Mail" type="email">
						<span class="help-block">Muss nur angegeben werden, wenn du die E-Mail-Adresse änderst.</span>
					</div>
				</div>
				<div class="form-group">
					<label for="passwd1" class="col-sm-4 control-label">Neues Passwort</label>
					<div class="col-sm-8">
						<input class="form-control" id="passwd1" name="passwd1" placeholder="Passwort" type="password">
						<span class="help-block">Muss zwischen 6 und 30 Zeichen lang sein.</span>
					</div>
				</div>
				<div class="form-group">
					<label for="passwd2" class="col-sm-4 control-label">Bestätigung des Passwort</label>
					<div class="col-sm-8">
						<input class="form-control" id="passwd2" name="passwd2" placeholder="Passwort" type="password">
						<span class="help-block"> Zur Sicherheit musst du das neue Kennwort bestätigen.</span>
					</div>
				</div>
				<div class="form-group">
					<label for="inputRangeSlider" class="col-sm-4 control-label">Tablettenwarner</label>
					<div class="col-sm-8">
						<input id="inputRangeSlider" name="inputRangeSlider" type="text" class="form-control">
						<span class="help-block"> Der Tablettenwarner wird bei erreichen des roten Bereichs automatisch anzeigt.</span>
					</div>
				</div>
				<div class="form-group">
					<label for="showPain" class="col-sm-4 control-label">Schmerztage immer anzeigen?</label>
					<div class="col-sm-8">
						<label class="radio-inline">
							<input type="radio" name="showPain" id="showPain" value="1"> ja
						</label>
						<label class="radio-inline">
							<input type="radio" name="radioShowPain" id="radioShowPain" value="0"> nein
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="userStyle" class="col-sm-4 control-label">Stylesheet</label>
					<div class="col-sm-8">
						<select class="form-control" id="userStyle" name="userStyle"> {html_options options=$styles selected=$user.user_style}
						</select>{if $default_style}
						<span class="help-block">Benutzereinstellungen zum Stylesheet werden ignoriert.</span>
						{/if}
					</div>
				</div>
				<div class="form-group">
					<div class="text-right col-sm-12">
						{if !$showpain}
						<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#paindays">
							Schmerztage
							<span class="hidden-xs"> anzeigen</span>
						</button>
						{/if}
						<button type="reset" class="btn btn-default">Zurücksetzen</button>
						<button type="submit" class="btn btn-primary">Speichern</button>
					</div>
				</div>
			</fieldset>
		</form>
		<script type="text/javascript">
				var range1 = {$user.range1};
				var range2 = {$user.range2};
				new Slider("#inputRangeSlider", {
					id : "inputRangeSlider",
					min : 0,
					max : 10,
					range : true,
					value : [ range1, range2 ]
				});
				$("input[name='radioShowPain'][value='{$user.user_showpain}']")
				.attr("checked", "checked");
			</script>
	</div>
	<div class="col-sm-3">
		<div class="panel {$panel_type} {if !$showpain}collapse{/if}" id="paindays">
			<div class="panel-heading">Zusammenfassung {$drugdays.monat|date_format:'%B %Y'|utf8_encode}</div>
			<div class="panel-body">
				<p>{$drugdays.kstage} Tage mit Kopfschmerzen</p>
				<p>{$drugdays.meditage} Tage mit Schmerzmitteln</p>
			</div>
		</div>
	</div>
</div>
{/if}
