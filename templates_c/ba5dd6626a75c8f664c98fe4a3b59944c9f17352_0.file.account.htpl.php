<?php
/* Smarty version 3.1.29, created on 2016-08-25 10:20:37
  from "D:\Programme\xampp\htdocs\ksk2\templates\account.htpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57beb865d72320_67243646',
  'file_dependency' => 
  array (
    'ba5dd6626a75c8f664c98fe4a3b59944c9f17352' => 
    array (
      0 => 'D:\\Programme\\xampp\\htdocs\\ksk2\\templates\\account.htpl',
      1 => 1464708430,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57beb865d72320_67243646 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'D:\\Programme\\xampp\\htdocs\\ksk2\\include\\smarty\\plugins\\function.html_options.php';
if (!is_callable('smarty_modifier_date_format')) require_once 'D:\\Programme\\xampp\\htdocs\\ksk2\\include\\smarty\\plugins\\modifier.date_format.php';
?>
<div class="page-header hidden-xs">
	<h3>Einstellungen</h3>
</div>
<div class="row">
	<div class="col-sm-9">
		<link rel="stylesheet" href="styles/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/css/bootstrap-slider.css">
		<?php echo '<script'; ?>
 type='text/javascript' src="styles/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/js/bootstrap-slider.js"><?php echo '</script'; ?>
>
		<form class="form-horizontal" method="post" action="index.php?page=account&mode=edit">
			<fieldset>
				<?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {
echo $_smarty_tpl->tpl_vars['message']->value;
}?>
				<div class="form-group">
					<label class="col-sm-4 control-label">Benutzername</label>
					<div class="col-sm-8">
						<p class="form-control-static"><?php echo $_smarty_tpl->tpl_vars['user']->value['user_name'];?>
</p>
						<span class="help-block"> Der Benutzername kann von Administratoren geändert werden.</span>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail" class="col-sm-4 control-label">E-Mail-Adresse</label>
					<div class="col-sm-8">
						<input class="form-control" id="inputEmail" name="inputEmail" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['user_email'];?>
" type="email">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail2" class="col-sm-4 control-label">Bestätigung der E-Mail-Adresse</label>
					<div class="col-sm-8">
						<input class="form-control" id="inputEmail2" name="inputEmail2" placeholder="E-Mail" type="email"> <span class="help-block">Muss nur angegeben werden, wenn du die E-Mail-Adresse änderst.</span>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword" class="col-sm-4 control-label">Neues Passwort</label>
					<div class="col-sm-8">
						<input class="form-control" id="inputPassword" name="inputPassword" placeholder="Passwort" type="password"> <span class="help-block">Muss zwischen 6 und 30 Zeichen lang sein.</span>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword2" class="col-sm-4 control-label">Bestätigung des Passwort</label>
					<div class="col-sm-8">
						<input class="form-control" id="inputPassword2" name="inputPassword2" placeholder="Passwort" type="password"> <span class="help-block"> Zur Sicherheit musst du das neue Kennwort bestätigen.</span>
					</div>
				</div>
				<div class="form-group">
					<label for="inputRangeSlider" class="col-sm-4 control-label">Tablettenwarner</label>
					<div class="col-sm-8">
						<input id="inputRangeSlider" name="inputRangeSlider" type="text" class="form-control"> <span class="help-block"> Der Tablettenwarner wird bei erreichen des roten Bereichs automatisch anzeigt.</span>
					</div>
				</div>
				<div class="form-group">
					<label for="radioShowPain" class="col-sm-4 control-label">Schmerztage immer anzeigen?</label>
					<div class="col-sm-8">
						<label class="radio-inline"><input type="radio" name="radioShowPain" id="radioShowPain" value="1"> ja </label> <label class="radio-inline"> <input type="radio" name="radioShowPain" id="radioShowPain" value="0"> nein
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="selectStyle" class="col-sm-4 control-label">Stylesheet</label>
					<div class="col-sm-8">
						<select class="form-control" id="selectStyle" name="selectStyle"> <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['styles']->value,'selected'=>$_smarty_tpl->tpl_vars['user']->value['user_style']),$_smarty_tpl);?>

						</select><?php if ($_smarty_tpl->tpl_vars['default_style']->value) {?><span class="help-block">Benutzereinstellungen zum Stylesheet werden ignoriert.</span><?php }?>
					</div>
				</div>
				<div class="form-group">
					<div class="text-right col-sm-12">
						<?php if (!$_smarty_tpl->tpl_vars['showpain']->value) {?>
						<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#paindays">
							Schmerztage<span class="hidden-xs"> anzeigen</span>
						</button>
						<?php }?>
						<button type="reset" class="btn btn-default">Zurücksetzen</button>
						<button type="submit" class="btn btn-primary">Speichern</button>
					</div>
				</div>
			</fieldset>
		</form>
		<?php echo '<script'; ?>
 type="text/javascript">
				var range1 = <?php echo $_smarty_tpl->tpl_vars['user']->value['range1'];?>
;
				var range2 = <?php echo $_smarty_tpl->tpl_vars['user']->value['range2'];?>
;
				new Slider("#inputRangeSlider", {
					id : "inputRangeSlider",
					min : 0,
					max : 10,
					range : true,
					value : [ range1, range2 ]
				});
				$("input[name='radioShowPain'][value='<?php echo $_smarty_tpl->tpl_vars['user']->value['user_showpain'];?>
']")
				.attr("checked", "checked");
			<?php echo '</script'; ?>
>
	</div>
	<div class="col-sm-3">
		<div class="panel <?php echo $_smarty_tpl->tpl_vars['panel_type']->value;?>
 <?php if (!$_smarty_tpl->tpl_vars['showpain']->value) {?>collapse<?php }?>" id="paindays">
			<div class="panel-heading">Zusammenfassung <?php echo utf8_encode(smarty_modifier_date_format($_smarty_tpl->tpl_vars['drugdays']->value['monat'],'%B %Y'));?>
</div>
			<div class="panel-body">
				<p><?php echo $_smarty_tpl->tpl_vars['drugdays']->value['kstage'];?>
 Tage mit Kopfschmerzen</p>
				<p><?php echo $_smarty_tpl->tpl_vars['drugdays']->value['meditage'];?>
 Tage mit Schmerzmitteln</p>
			</div>
		</div>
	</div>
</div><?php }
}
