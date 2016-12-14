<?php
/* Smarty version 3.1.29, created on 2016-08-26 11:25:36
  from "D:\Programme\xampp\htdocs\ksk2\templates\splash.htpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57c019209c5d65_89857878',
  'file_dependency' => 
  array (
    '422562d966c08f371c3f12791d9d5a708dab5ff9' => 
    array (
      0 => 'D:\\Programme\\xampp\\htdocs\\ksk2\\templates\\splash.htpl',
      1 => 1472207124,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57c019209c5d65_89857878 ($_smarty_tpl) {
?>
<style>
/* http://css-tricks.com/perfect-full-page-background-image/ */
html {
	background: url(styles/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/header.jpg) no-repeat center
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
<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function() {
		$('#login').modal('<?php echo $_smarty_tpl->tpl_vars['show_login']->value;?>
');
		$(".login").click(function() {
			$("#password").modal('hide');
			$("#register").modal('hide');
		});
		$(".password").click(function() {
			$("#login").modal('hide');
			$("#register").modal('hide');
		});
		$(".register").click(function() {
			$("#login").modal('hide');
			$("#password").modal('hide');
		});
	});
<?php echo '</script'; ?>
>
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3 panel"><?php echo $_smarty_tpl->tpl_vars['splash_message']->value;?>
</div>
	</div>
</div>
<!-- Modal Login -->
<div id="login" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="index.php?page=account&mode=login" class="form-horizontal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Anmelden</h4>
				</div>
				<div class="modal-body">
					<?php if (isset($_smarty_tpl->tpl_vars['login_failure']->value)) {?>
					<div class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['login_failure']->value;?>
</div>
					<?php }?>
					<fieldset>
						<div class="form-group">
							<label for="inputUser" class="col-sm-3 control-label">Benutzername</label>
							<div class="col-sm-9">
								<input class="form-control" id="inputUser" name="inputUser" placeholder="Benutzername" type="text" required>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword" class="col-sm-3 control-label">Passwort</label>
							<div class="col-sm-9">
								<input class="form-control" id="inputPassword" name="inputPassword" placeholder="Passwort" type="password" required>
								<div style="text-align: right;">
									<a href="#password" data-toggle="modal" class="password">Passwort vergessen?</a>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-9 col-sm-offset-3">
								<div class="checkbox">
									<label><input type="checkbox" id="checkboxAutologin" name="checkboxAutologin"> Angemeldet bleiben</label>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Schlie&szlig;en</button>
					<button type="submit" class="btn btn-primary">Anmelden</button>
					<hr>
					<h6 style="text-align: center;">
						Noch kein Benutzerkonto? - <a href="#register" data-toggle="modal" class="register">Hier registrieren</a>
					</h6>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Register -->
<div id="register" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="index.php?page=account&mode=register" class="form-horizontal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Registrieren</h4>
				</div>
				<div class="modal-body">
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
						Du hast bereits ein Benutzerkonto? - <a href="#login" data-toggle="modal" class="login">Hier anmelden</a>
					</h6>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Password -->
<div id="password" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="index.php?page=account&mode=password" class="form-horizontal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
						<a href="#login" data-toggle="modal" class="login">Zurück zur Anmeldemaske</a>
					</h6>
				</div>
			</form>
		</div>
	</div>
</div><?php }
}
