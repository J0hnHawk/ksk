<?php
/* Smarty version 3.1.29, created on 2016-08-24 10:15:14
  from "D:\Programme\xampp\htdocs\ksk2\templates\menu.htpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57bd65a28b6fa1_47532341',
  'file_dependency' => 
  array (
    '8f542b8843ddb5e1490fac2eac5ec449f4042d2c' => 
    array (
      0 => 'D:\\Programme\\xampp\\htdocs\\ksk2\\templates\\menu.htpl',
      1 => 1472030112,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57bd65a28b6fa1_47532341 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:\\Programme\\xampp\\htdocs\\ksk2\\include\\smarty\\plugins\\modifier.date_format.php';
?>
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
			<?php if (isset($_SESSION['user'])) {?>
			<ul class="nav navbar-nav">
				<li class="<?php if ($_smarty_tpl->tpl_vars['page']->value == 'edit') {?>active<?php }?>"><a href="index.php?page=edit"> <span class="glyphicon glyphicon-pencil"></span> Erfassen
				</a></li>
				<li class="dropdown <?php if ($_smarty_tpl->tpl_vars['page']->value == 'report') {?>active<?php }?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-calendar"></span> &Uuml;bersicht <span class="caret"></span>
				</a>
					<ul class="dropdown-menu">
						<li class="<?php if (isset($_smarty_tpl->tpl_vars['mode']->value) && $_smarty_tpl->tpl_vars['mode']->value == 'sheet') {?>active<?php }?>"><a href="index.php?page=report&mode=sheet<?php if (isset($_smarty_tpl->tpl_vars['amonat']->value)) {?>&month=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'m');?>
&year=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'Y');
}?>">Kalenderblatt</a></li>
						<li class="<?php if (isset($_smarty_tpl->tpl_vars['mode']->value) && $_smarty_tpl->tpl_vars['mode']->value == 'list') {?>active<?php }?>"><a href="index.php?page=report&mode=list<?php if (isset($_smarty_tpl->tpl_vars['amonat']->value)) {?>&month=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'m');?>
&year=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'Y');
}?>">Monatsliste</a></li>
					</ul></li>
				<li class="<?php if ($_smarty_tpl->tpl_vars['page']->value == 'statistics') {?>active<?php }?>"><a href="index.php?page=statistics"> <span class="glyphicon glyphicon-equalizer"></span> Auswertung
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
			<?php } else { ?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#register" data-toggle="modal"> <span class="glyphicon glyphicon-user"></span> Registrieren
				</a></li>
				<li><a href="#login" data-toggle="modal"> <span class="glyphicon glyphicon-log-in"></span> Anmelden
				</a></li>
			</ul>
			<?php }?>
		</div>
	</div>
</nav>
<?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
><?php }
}
