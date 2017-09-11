<nav role="navigation" class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
				<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
			</button>
			<a href="index.php" class="navbar-brand">Kopfschmerzkalender</a>
		</div>
		<!-- Collection of nav links and other content for toggling -->
		<div id="navbarCollapse" class="collapse navbar-collapse inverse">
			{if isset($smarty.session.user)}
			<ul class="nav navbar-nav">
				<li class="{if $page == 'edit'}active{/if}"><a href="index.php?page=edit"> <span class="glyphicon glyphicon-pencil"></span> Erfassen
				</a></li>
				<li class="dropdown {if $page == 'report'}active{/if}"><a class="dropdown-toggle disabled" href="index.php?page=report&mode=list{if isset($amonat)}&month={$amonat|date_format:'m'}&year={$amonat|date_format:'Y'}{/if}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-calendar"></span> &Uuml;bersicht <span class="caret"></span>
				</a>
					<ul class="dropdown-menu">
						<li class="{if isset($mode) && $mode == 'sheet'}active{/if}"><a href="index.php?page=report&mode=sheet{if isset($amonat)}&month={$amonat|date_format:'m'}&year={$amonat|date_format:'Y'}{/if}">Kalenderblatt</a></li>
						<li class="{if isset($mode) && $mode == 'list'}active{/if}"><a href="index.php?page=report&mode=list{if isset($amonat)}&month={$amonat|date_format:'m'}&year={$amonat|date_format:'Y'}{/if}">Monatsliste</a></li>
					</ul></li>
				<li class="{if $page == 'statistics'}active{/if}"><a href="index.php?page=statistics"> <span class="glyphicon glyphicon-equalizer"></span> Auswertung
				</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-cog"></span> Einstellungen <span class="caret"></span>
				</a>
					<ul class="dropdown-menu">
						<li><a href="index.php?page=account&mode=edit">Benutzerkonto</a></li>
						<li><a href="index.php?page=drugs">Medikamente</a></li>
					</ul></li>
				<li><a href="index.php?page=account&mode=logoff"> <span class="glyphicon glyphicon-log-out"></span> Abmelden
				</a></li>
			</ul>
			{else}
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php?page=account&mode=register" data-toggle="modal"> <span class="glyphicon glyphicon-user"></span> Registrieren
				</a></li>
				<li><a href="index.php?page=account&mode=login" data-toggle="modal"> <span class="glyphicon glyphicon-log-in"></span> Anmelden
				</a></li>
			</ul>
			{/if}
		</div>
	</div>
</nav>
<script>
	// Script erstellt von Ben Bigras Premium Web Service
	// https://www.youtube.com/watch?v=dRLOHxyCaGU
	// http://www.benbigras.com/js/myscript.js
	$(function() {
		$('ul.nav li.dropdown').hover(function() {
			$('.dropdown-menu', this).fadeIn();
		}, function() {
			$('.dropdown-menu', this).fadeOut('fast');
		});

	});
</script>