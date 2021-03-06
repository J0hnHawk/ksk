<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Kopfschmerzkalender {$ksk_version}</title>
<link rel="icon" href="styles/{$style}/images/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="styles/{$style}/js/bootstrap-datepicker.js"></script>
<script src="styles/{$style}/js/locales/bootstrap-datepicker.de.min.js" charset="UTF-8"></script>
<!-- Optional Bootstrap theme -->
<link rel="stylesheet" href="styles/{$style}/css/bootstrap-theme.css">
<link rel="stylesheet" href="styles/{$style}/css/bootstrap-individually.css">
<link rel="stylesheet" href="styles/{$style}/css/bootstrap-datepicker3.min.css">
</head>
<body>
	{include file="menu.tpl"} {assign var="datei" value="./templates/$template"} {if file_exists($datei)}
	<div class="container">{include file="$template"}</div>
	{else}
	<div class="container">
		<div class="jumbotron">
			<h1>Template-Fehler</h1>
			<p>Auf das Template "{$datei}" kann nicht zugegriffen werden.</p>
			<p>Bitte prüfen das Template existiert und die Zugriffsrechte korrekt vergeben wurden.</p>
		</div>
		{debug}
	</div>
	{/if}
	<footer class="container-fluid text-center footer">
		<p>
			<span class="hidden-xs hidden-sm">Kopfschmerzkalender {$ksk_version} &bull; </span>&copy; 2014 - 2016 Lars Bleckwenn
		</p>
	</footer>
</body>
</html>
