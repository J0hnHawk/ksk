<?php
/* Smarty version 3.1.29, created on 2016-08-24 10:11:46
  from "D:\Programme\xampp\htdocs\ksk2\templates\index.htpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57bd64d2ad20a9_26760659',
  'file_dependency' => 
  array (
    '6db0ab0c17873fdc08920169bc311162aeefc0e9' => 
    array (
      0 => 'D:\\Programme\\xampp\\htdocs\\ksk2\\templates\\index.htpl',
      1 => 1465115712,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:menu.htpl' => 1,
  ),
),false)) {
function content_57bd64d2ad20a9_26760659 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Kopfschmerzkalender 2.0.0</title>
<link rel="icon" href="styles/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="styles/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/js/bootstrap-datepicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="styles/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/js/locales/bootstrap-datepicker.de.min.js" charset="UTF-8"><?php echo '</script'; ?>
>
<!-- Optional Bootstrap theme -->
<link rel="stylesheet" href="styles/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/css/bootstrap-theme.css">
<link rel="stylesheet" href="styles/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/css/bootstrap-individually.css">
<link rel="stylesheet" href="styles/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/css/bootstrap-datepicker3.min.css">
</head>
<body>
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:menu.htpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
 <?php if (isset($_SESSION['login'])) {?> <?php $_smarty_tpl->tpl_vars["datei"] = new Smarty_Variable("./templates/".((string)$_smarty_tpl->tpl_vars['template']->value), null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "datei", 0);?> <?php } else { ?> <?php $_smarty_tpl->tpl_vars["datei"] = new Smarty_Variable("./templates/splash.htpl", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "datei", 0);?> <?php }?> <?php if (file_exists($_smarty_tpl->tpl_vars['datei']->value)) {?>
	<div class="container"><?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['template']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</div>
	<?php } else { ?>
	<div class="container">
		<div class="jumbotron">
			<h1>Template-Fehler</h1>
			<p>Auf das Template "<?php echo $_smarty_tpl->tpl_vars['datei']->value;?>
" kann nicht zugegriffen werden.</p>
			<p>Bitte prüfen das Template existiert und die Zugriffsrechte korrekt vergeben wurden.</p>
		</div>
		<?php $_smarty_debug = new Smarty_Internal_Debug;
 $_smarty_debug->display_debug($_smarty_tpl);
unset($_smarty_debug);
?>
	</div>
	<?php }?>
	<footer class="container-fluid text-center footer">
		<p>
			<span class="hidden-xs hidden-sm">Kopfschmerzkalender <?php echo $_smarty_tpl->tpl_vars['ksk_version']->value;?>
 &bull; </span>&copy; 2014 - 2016 Lars Bleckwenn
		</p>
	</footer>
</body>
</html>
<?php }
}
