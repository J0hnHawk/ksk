<?php
/* Smarty version 3.1.29, created on 2016-08-24 12:03:14
  from "D:\Programme\xampp\htdocs\ksk2\templates\report.htpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57bd7ef28da119_23335855',
  'file_dependency' => 
  array (
    'ac7c984782a3ce8f875c847e03e13c0b8774c416' => 
    array (
      0 => 'D:\\Programme\\xampp\\htdocs\\ksk2\\templates\\report.htpl',
      1 => 1472036591,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57bd7ef28da119_23335855 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:\\Programme\\xampp\\htdocs\\ksk2\\include\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_html_options')) require_once 'D:\\Programme\\xampp\\htdocs\\ksk2\\include\\smarty\\plugins\\function.html_options.php';
?>
<div class="page-header hidden-xs">
	<h3>Übersicht für <?php echo utf8_encode(smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'%B %Y'));?>
</h3>
</div>
<div class="row">
	<div class="col-sm-9">
		
		<?php echo '<script'; ?>
 type="text/javascript">
			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip({
					placement : 'top',
					container : 'body'
				});
			});
		<?php echo '</script'; ?>
>
		
		<div class="table-responsive">
			<?php if ($_smarty_tpl->tpl_vars['mode']->value == "list") {?>
			<table class="table table-bordered calendar">
				<thead>
					<tr>
						<th rowspan="2">Tag</th>
						<th colspan="3">Art</th>
						<th rowspan="2">Medi<span class="hidden-xs">kamente</span></th>
						<th colspan="5">Grad<span class="hidden-xs">uierung</span></th>
						<th rowspan="2">Info<span class="hidden-xs">rmationen</span></th>
					</tr>
					<tr>
						<th>M</th>
						<th>S</th>
						<th>?</th>
						<th>0</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
					</tr>
				</thead>
				<tbody>
					<?php $_smarty_tpl->tpl_vars["check"] = new Smarty_Variable("glyphicon-check", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "check", 0);?> <?php $_smarty_tpl->tpl_vars["unchecked"] = new Smarty_Variable("glyphicon-unchecked", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "unchecked", 0);?> <?php
$_from = $_smarty_tpl->tpl_vars['tage']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_daten_0_saved_item = isset($_smarty_tpl->tpl_vars['daten']) ? $_smarty_tpl->tpl_vars['daten'] : false;
$__foreach_daten_0_saved_key = isset($_smarty_tpl->tpl_vars['datum']) ? $_smarty_tpl->tpl_vars['datum'] : false;
$_smarty_tpl->tpl_vars['daten'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['datum'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['daten']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['datum']->value => $_smarty_tpl->tpl_vars['daten']->value) {
$_smarty_tpl->tpl_vars['daten']->_loop = true;
$__foreach_daten_0_saved_local_item = $_smarty_tpl->tpl_vars['daten'];
?>
					<tr <?php if (freiertag($_smarty_tpl->tpl_vars['datum']->value)) {?>class="weekendlist2" <?php }?> data-toggle="modal" href="#day_details" data-modal_title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['datum']->value,'%d.%m.%Y');?>
" data-modal_type="<?php echo $_smarty_tpl->tpl_vars['daten']->value['ks_art'];?>
" data-modal_drugs="<?php
$_from = $_smarty_tpl->tpl_vars['daten']->value['ks_medis'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_drugs_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_drugs']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] : false;
$__foreach_drugs_1_saved_item = isset($_smarty_tpl->tpl_vars['medi']) ? $_smarty_tpl->tpl_vars['medi'] : false;
$__foreach_drugs_1_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
$_smarty_tpl->tpl_vars['medi'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] = new Smarty_Variable(array());
$__foreach_drugs_1_iteration=0;
$_smarty_tpl->tpl_vars['medi']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['medi']->value) {
$_smarty_tpl->tpl_vars['medi']->_loop = true;
$__foreach_drugs_1_iteration++;
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs']->value['last'] = $__foreach_drugs_1_iteration == $__foreach_drugs_1_total;
$__foreach_drugs_1_saved_local_item = $_smarty_tpl->tpl_vars['medi'];
echo $_smarty_tpl->tpl_vars['medikamente']->value[$_smarty_tpl->tpl_vars['medi']->value]['name'];?>
<br><?php
$_smarty_tpl->tpl_vars['medi'] = $__foreach_drugs_1_saved_local_item;
}
if ($__foreach_drugs_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] = $__foreach_drugs_1_saved;
}
if ($__foreach_drugs_1_saved_item) {
$_smarty_tpl->tpl_vars['medi'] = $__foreach_drugs_1_saved_item;
}
?>"
						data-modal_grad="<?php echo $_smarty_tpl->tpl_vars['daten']->value['ks_grad'];?>
" data-modal_info="<?php echo $_smarty_tpl->tpl_vars['daten']->value['ks_info'];?>
">
						<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['datum']->value,'%d.');?>
<span class="hidden-xs"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['datum']->value,'%m.%Y');?>
</span><a href="index.php?seite=edit&amp;date=<?php echo $_smarty_tpl->tpl_vars['datum']->value;?>
"></a>
						</td>
						<td><span class="glyphicon <?php if ($_smarty_tpl->tpl_vars['daten']->value['ks_art']&1) {
echo $_smarty_tpl->tpl_vars['check']->value;
} else {
echo $_smarty_tpl->tpl_vars['unchecked']->value;
}?>"></span></td>
						<td><span class="glyphicon <?php if ($_smarty_tpl->tpl_vars['daten']->value['ks_art']&2) {
echo $_smarty_tpl->tpl_vars['check']->value;
} else {
echo $_smarty_tpl->tpl_vars['unchecked']->value;
}?>"></span></td>
						<td><span class="glyphicon <?php if ($_smarty_tpl->tpl_vars['daten']->value['ks_art']&4) {
echo $_smarty_tpl->tpl_vars['check']->value;
} else {
echo $_smarty_tpl->tpl_vars['unchecked']->value;
}?>"></span></td>
						<td><?php
$_from = $_smarty_tpl->tpl_vars['daten']->value['ks_medis'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_drugs_2_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_drugs']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] : false;
$__foreach_drugs_2_saved_item = isset($_smarty_tpl->tpl_vars['medi']) ? $_smarty_tpl->tpl_vars['medi'] : false;
$__foreach_drugs_2_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
$_smarty_tpl->tpl_vars['medi'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] = new Smarty_Variable(array());
$__foreach_drugs_2_iteration=0;
$_smarty_tpl->tpl_vars['medi']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['medi']->value) {
$_smarty_tpl->tpl_vars['medi']->_loop = true;
$__foreach_drugs_2_iteration++;
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs']->value['last'] = $__foreach_drugs_2_iteration == $__foreach_drugs_2_total;
$__foreach_drugs_2_saved_local_item = $_smarty_tpl->tpl_vars['medi'];
?><span class="hidden-xs"><?php echo $_smarty_tpl->tpl_vars['medikamente']->value[$_smarty_tpl->tpl_vars['medi']->value]['name'];?>
</span><span class="hidden-sm hidden-md hidden-lg"><?php echo $_smarty_tpl->tpl_vars['medikamente']->value[$_smarty_tpl->tpl_vars['medi']->value]['short'];?>
</span><?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_drugs']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_drugs']->value['last'] : null)) {
} else { ?>, <?php }
$_smarty_tpl->tpl_vars['medi'] = $__foreach_drugs_2_saved_local_item;
}
if ($__foreach_drugs_2_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] = $__foreach_drugs_2_saved;
}
if ($__foreach_drugs_2_saved_item) {
$_smarty_tpl->tpl_vars['medi'] = $__foreach_drugs_2_saved_item;
}
?>
						</td> <?php
$_smarty_tpl->tpl_vars['grad'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['grad']->step = 1;$_smarty_tpl->tpl_vars['grad']->total = (int) ceil(($_smarty_tpl->tpl_vars['grad']->step > 0 ? 4+1 - (0) : 0-(4)+1)/abs($_smarty_tpl->tpl_vars['grad']->step));
if ($_smarty_tpl->tpl_vars['grad']->total > 0) {
for ($_smarty_tpl->tpl_vars['grad']->value = 0, $_smarty_tpl->tpl_vars['grad']->iteration = 1;$_smarty_tpl->tpl_vars['grad']->iteration <= $_smarty_tpl->tpl_vars['grad']->total;$_smarty_tpl->tpl_vars['grad']->value += $_smarty_tpl->tpl_vars['grad']->step, $_smarty_tpl->tpl_vars['grad']->iteration++) {
$_smarty_tpl->tpl_vars['grad']->first = $_smarty_tpl->tpl_vars['grad']->iteration == 1;$_smarty_tpl->tpl_vars['grad']->last = $_smarty_tpl->tpl_vars['grad']->iteration == $_smarty_tpl->tpl_vars['grad']->total;?>
						<td><span class="glyphicon <?php if (isset($_smarty_tpl->tpl_vars['daten']->value['ks_grad']) && $_smarty_tpl->tpl_vars['daten']->value['ks_grad'] == $_smarty_tpl->tpl_vars['grad']->value) {
echo $_smarty_tpl->tpl_vars['check']->value;
} else {
echo $_smarty_tpl->tpl_vars['unchecked']->value;
}?>" aria-hidden="true"></span></td> <?php }
}
?>

						<td><?php echo $_smarty_tpl->tpl_vars['daten']->value['ks_info'];?>
</td>
					</tr>
					<?php
$_smarty_tpl->tpl_vars['daten'] = $__foreach_daten_0_saved_local_item;
}
if ($__foreach_daten_0_saved_item) {
$_smarty_tpl->tpl_vars['daten'] = $__foreach_daten_0_saved_item;
}
if ($__foreach_daten_0_saved_key) {
$_smarty_tpl->tpl_vars['datum'] = $__foreach_daten_0_saved_key;
}
?>
				</tbody>
			</table>
			<?php } else { ?>
			<?php echo '<script'; ?>
 type="text/javascript">
				$(document).ready(function() {
					$('[data-toggle="tooltip"]').tooltip({
						placement : 'top'
					});
				});
			<?php echo '</script'; ?>
>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="14%">Mo<span class="hidden-xs">ntag</span></th>
						<th width="14%">Di<span class="hidden-xs">enstag</span></th>
						<th width="14%">Mi<span class="hidden-xs">ttwoch</span></th>
						<th width="14%">Do<span class="hidden-xs">nnerstag</span></th>
						<th width="14%">Fr<span class="hidden-xs">eitag</span></th>
						<th width="14%">Sa<span class="hidden-xs">mstag</span></th>
						<th width="14%">So<span class="hidden-xs">nntag</span></th>
					</tr>
				</thead>
				<tbody>
					<?php
$_from = $_smarty_tpl->tpl_vars['tage']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_calendar_3_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_calendar']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_calendar'] : false;
$__foreach_calendar_3_saved_item = isset($_smarty_tpl->tpl_vars['daten']) ? $_smarty_tpl->tpl_vars['daten'] : false;
$__foreach_calendar_3_saved_key = isset($_smarty_tpl->tpl_vars['datum']) ? $_smarty_tpl->tpl_vars['datum'] : false;
$_smarty_tpl->tpl_vars['daten'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_calendar'] = new Smarty_Variable(array('iteration' => 0));
$_smarty_tpl->tpl_vars['datum'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['daten']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['datum']->value => $_smarty_tpl->tpl_vars['daten']->value) {
$_smarty_tpl->tpl_vars['daten']->_loop = true;
$_smarty_tpl->tpl_vars['__smarty_foreach_calendar']->value['iteration']++;
$__foreach_calendar_3_saved_local_item = $_smarty_tpl->tpl_vars['daten'];
?> <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_calendar']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_calendar']->value['iteration'] : null)%7 == 1) {?>
					<tr>
						<?php }?> <?php if ($_smarty_tpl->tpl_vars['daten']->value['ks_art']&1) {
$_smarty_tpl->tpl_vars["class"] = new Smarty_Variable("danger", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "class", 0);
} elseif ($_smarty_tpl->tpl_vars['daten']->value['ks_art'] == 0) {
$_smarty_tpl->tpl_vars["class"] = new Smarty_Variable("success", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "class", 0);
} elseif ($_smarty_tpl->tpl_vars['daten']->value['ks_art']&2) {
$_smarty_tpl->tpl_vars["class"] = new Smarty_Variable("warning", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "class", 0);
} elseif ($_smarty_tpl->tpl_vars['daten']->value['ks_art']&4) {
$_smarty_tpl->tpl_vars["class"] = new Smarty_Variable("info", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "class", 0);
} else {
$_smarty_tpl->tpl_vars["class"] = new Smarty_Variable('', null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "class", 0);
}?>
						<td class="<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
" data-toggle="modal" href="#day_details" data-modal_title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['datum']->value,'%d.%m.%Y');?>
" data-modal_type="<?php echo $_smarty_tpl->tpl_vars['daten']->value['ks_art'];?>
" data-modal_drugs="<?php
$_from = $_smarty_tpl->tpl_vars['daten']->value['ks_medis'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_drugs_4_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_drugs']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] : false;
$__foreach_drugs_4_saved_item = isset($_smarty_tpl->tpl_vars['medi']) ? $_smarty_tpl->tpl_vars['medi'] : false;
$__foreach_drugs_4_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
$_smarty_tpl->tpl_vars['medi'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] = new Smarty_Variable(array());
$__foreach_drugs_4_iteration=0;
$_smarty_tpl->tpl_vars['medi']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['medi']->value) {
$_smarty_tpl->tpl_vars['medi']->_loop = true;
$__foreach_drugs_4_iteration++;
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs']->value['last'] = $__foreach_drugs_4_iteration == $__foreach_drugs_4_total;
$__foreach_drugs_4_saved_local_item = $_smarty_tpl->tpl_vars['medi'];
echo $_smarty_tpl->tpl_vars['medikamente']->value[$_smarty_tpl->tpl_vars['medi']->value]['name'];?>
<br><?php
$_smarty_tpl->tpl_vars['medi'] = $__foreach_drugs_4_saved_local_item;
}
if ($__foreach_drugs_4_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] = $__foreach_drugs_4_saved;
}
if ($__foreach_drugs_4_saved_item) {
$_smarty_tpl->tpl_vars['medi'] = $__foreach_drugs_4_saved_item;
}
?>" data-modal_grad="<?php echo $_smarty_tpl->tpl_vars['daten']->value['ks_grad'];?>
"
							data-modal_info="<?php echo $_smarty_tpl->tpl_vars['daten']->value['ks_info'];?>
"><?php if (smarty_modifier_date_format($_smarty_tpl->tpl_vars['datum']->value,'%m') != smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'%m')) {?> <?php $_smarty_tpl->tpl_vars["dayclass"] = new Smarty_Variable("othermonth", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "dayclass", 0);?> <?php } else { ?> <?php if (freiertag($_smarty_tpl->tpl_vars['datum']->value)) {?> <?php $_smarty_tpl->tpl_vars["dayclass"] = new Smarty_Variable("weekend", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "dayclass", 0);?> <?php } else { ?> <?php $_smarty_tpl->tpl_vars["dayclass"] = new Smarty_Variable("weekday", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "dayclass", 0);?> <?php }?> <?php }?>
							<p class="<?php echo $_smarty_tpl->tpl_vars['dayclass']->value;?>
">
								<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['datum']->value,'%d')+0;?>

								<!-- <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['datum']->value,'%d.%m.%Y - %H:%M');?>
 -->
							</p>
							<p>
								<?php
$_from = $_smarty_tpl->tpl_vars['daten']->value['ks_medis'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_drugs_5_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_drugs']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] : false;
$__foreach_drugs_5_saved_item = isset($_smarty_tpl->tpl_vars['medi']) ? $_smarty_tpl->tpl_vars['medi'] : false;
$__foreach_drugs_5_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
$_smarty_tpl->tpl_vars['medi'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] = new Smarty_Variable(array());
$__foreach_drugs_5_iteration=0;
$_smarty_tpl->tpl_vars['medi']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['medi']->value) {
$_smarty_tpl->tpl_vars['medi']->_loop = true;
$__foreach_drugs_5_iteration++;
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs']->value['last'] = $__foreach_drugs_5_iteration == $__foreach_drugs_5_total;
$__foreach_drugs_5_saved_local_item = $_smarty_tpl->tpl_vars['medi'];
?>
								<!-- <span data-toggle="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['medikamente']->value[$_smarty_tpl->tpl_vars['medi']->value]['name'];?>
"> -->
								<?php echo $_smarty_tpl->tpl_vars['medikamente']->value[$_smarty_tpl->tpl_vars['medi']->value]['short'];?>

								<!-- </span> -->
								<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_drugs']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_drugs']->value['last'] : null)) {
} else { ?>, <?php }
$_smarty_tpl->tpl_vars['medi'] = $__foreach_drugs_5_saved_local_item;
}
if ($__foreach_drugs_5_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_drugs'] = $__foreach_drugs_5_saved;
}
if ($__foreach_drugs_5_saved_item) {
$_smarty_tpl->tpl_vars['medi'] = $__foreach_drugs_5_saved_item;
}
?>&nbsp;
							</p> <?php if (isset($_smarty_tpl->tpl_vars['daten']->value['ks_grad']) && $_smarty_tpl->tpl_vars['daten']->value['ks_grad'] > -1) {?>
							<p class="badge"><?php echo $_smarty_tpl->tpl_vars['daten']->value['ks_grad'];
} else { ?>
							<p>&nbsp;<?php }?></p>
						</td> <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_calendar']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_calendar']->value['iteration'] : null)%7 == 0) {?>
					</tr>
					<?php }?> <?php
$_smarty_tpl->tpl_vars['daten'] = $__foreach_calendar_3_saved_local_item;
}
if ($__foreach_calendar_3_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_calendar'] = $__foreach_calendar_3_saved;
}
if ($__foreach_calendar_3_saved_item) {
$_smarty_tpl->tpl_vars['daten'] = $__foreach_calendar_3_saved_item;
}
if ($__foreach_calendar_3_saved_key) {
$_smarty_tpl->tpl_vars['datum'] = $__foreach_calendar_3_saved_key;
}
?>
				</tbody>
			</table>
			<?php }?>

		</div>
		<nav>
			<ul class="pager">
				<li class="previous"><a href="index.php?page=report&mode=<?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
&month=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'m')-1;?>
&year=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'Y');?>
"> <span aria-hidden="true">&larr;</span> vorheriger
				</a></li>
				<li class="next"><a href="index.php?page=report&mode=<?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
&month=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'m')+1;?>
&year=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'Y');?>
"> nächster <span aria-hidden="true">&rarr;</span>
				</a></li>
			</ul>
		</nav>
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
		<legend>Monat wählen:</legend>
		<center>
			<div id="datepicker"></div>
		</center>
		<br>
		<?php echo '<script'; ?>
 type="text/javascript">
			$('#datepicker').datepicker({
				startDate : "<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ekt']->value,'%d/%m/%Y');?>
",
				endDate : "0d",
				startView : 1,
				inline : true,
				minViewMode : 1,
				language : "de",
				todayHighlight : true,
				autoclose : false
			});
			$('#datepicker').on(
					"changeDate",
					function() {
						var datum = $('#datepicker').datepicker(
								'getFormattedDate').split(".");
						var mode = location.search.split("mode=")[1];
						window.location.href = "index.php?page=report&mode="
								+ mode + "&month=" + datum[1] + "&year="
								+ datum[2];
					});
		<?php echo '</script'; ?>
>
		<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#pdfreport">
			<span class="glyphicon glyphicon-save-file"></span> als PDF herunterladen
		</button>
		<br>

	</div>
</div>

<!-- Modal Report -->
<div id="pdfreport" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<!--  <form method="post" action="index.php?page=report&mode=<?php echo $_smarty_tpl->tpl_vars['mode']->value;
if (isset($_smarty_tpl->tpl_vars['amonat']->value)) {?>&month=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'m');?>
&year=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['amonat']->value,'Y');
}?>" target="_BLANK"> -->
			<form method="post" action="index.php?page=report_pdf" target="_BLANK">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Auswertung über 6 Monate</h4>
				</div>
				<div class="modal-body">
					<p>Auswertungen können für den den Zeitraum <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ekt']->value,'%B %Y');?>
 bis <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['lkt']->value,'%B %Y');?>
 generiert werden.</p>
					<fieldset>
						<div class="form-group">
							<label for="inputStart" class="col-sm-4 control-label">Auswertung ab</label>
							<div class="col-sm-8"><?php echo smarty_function_html_options(array('name'=>'startmonat','options'=>$_smarty_tpl->tpl_vars['sme']->value,'class'=>"form-control",'id'=>"inputStart"),$_smarty_tpl);?>
</div>
						</div>
						<div class="form-group">
							<label for="inputExtraInfo" class="col-sm-4 control-label">Zusätzlich</label>
							<div class="col-sm-8">
								<div class="checkbox">
									<label><input type="checkbox" value="1" name="info">Informationen / Bemerkungen ausgeben</label>
								</div>
							</div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
					<button type="submit" class="btn btn-primary">Auswertung generieren</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Day details -->
<div id="day_details" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Details</h4>
			</div>
			<div class="modal-body">
				<fieldset>
					<div class="form-group">
						<label class="col-sm-4 control-label">Schmerzart</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="modal_type"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">Medikamente</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="modal_drugs"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">Schmerzgrad</label>
						<div class="col-sm-8">
							<div class="progress">
								<div class="progress-bar progress-bar-warning progress-bar-striped" id="modal_grad" role="progressbar" style="width: 0%;">keine</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">Informationen</label>
						<div class="col-sm-8">
							<p class="form-control-static" id="modal_info"></p>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="modal-footer">
				<a class="btn btn-primary" href="#" role="button" id="modal_button">Bearbeiten</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
			</div>
		</div>
	</div>
</div>
<?php echo '<script'; ?>
>
	function br2nl(str) {
		return str.replace(/<br\s*\/<?php echo '?>';?>/mg, "\r\n");
	}
	$('#day_details').on(
			'show.bs.modal',
			function(event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var title = button.data('modal_title')
				var type = button.data('modal_type')
				var drugs = button.data('modal_drugs')
				var grad = button.data('modal_grad')
				var info = button.data('modal_info')
				var modal = $(this)
				modal.find('.modal-title').text('Details ' + title)
				var pain_type = ((type & 1) ? "Migräne, " : "")
						+ ((type & 2) ? "Spannungskopfschmerzen, " : "")
						+ ((type & 4) ? "Undefiniert, " : "")
				$('#modal_button').attr("href", "index.php?page=edit&date=" + title)
				$('#modal_type')
						.text(pain_type.substr(0, pain_type.length - 2));
				$('#modal_drugs').text(br2nl(drugs))
				var grad_text = ((grad == -1) ? "keine" : "")
						+ ((grad == 0) ? "nur Aura" : grad);
				$('#modal_grad').text(grad_text)
				var grad_percent = 20 + grad * 20;
				$('#modal_grad').css("width", grad_percent + "%");
				$('#modal_info').text(info)
			})
<?php echo '</script'; ?>
><?php }
}
