<?php
/* Smarty version 3.1.29, created on 2016-08-24 10:11:52
  from "D:\Programme\xampp\htdocs\ksk2\templates\edit.htpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57bd64d8dc7da5_58952649',
  'file_dependency' => 
  array (
    '7c8fab50efa5bf8aebe5e406ab3eaf43e26c028f' => 
    array (
      0 => 'D:\\Programme\\xampp\\htdocs\\ksk2\\templates\\edit.htpl',
      1 => 1464708346,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57bd64d8dc7da5_58952649 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:\\Programme\\xampp\\htdocs\\ksk2\\include\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_html_options')) require_once 'D:\\Programme\\xampp\\htdocs\\ksk2\\include\\smarty\\plugins\\function.html_options.php';
?>
<div class="page-header hidden-xs">
	<h3>Schmerzmitteleinnahme erfassen</h3>
</div>
<div class="row">
	<div class="col-sm-9">
		<link rel="stylesheet" href="styles/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/css/bootstrap-slider.css">
		<?php echo '<script'; ?>
 type='text/javascript' src="styles/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/js/bootstrap-slider.js"><?php echo '</script'; ?>
>
		<form class="form-horizontal" id="sandbox" action="index.php?page=edit" method="POST">
			<fieldset>
				<?php if (isset($_smarty_tpl->tpl_vars['success']->value)) {?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>ERFOLG:</strong><br><?php echo $_smarty_tpl->tpl_vars['success']->value;?>

				</div>
				<?php }?> <?php if (isset($_smarty_tpl->tpl_vars['info']->value)) {?>
				<div class="alert alert-info">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>HINWEIS:</strong><br><?php echo $_smarty_tpl->tpl_vars['info']->value;?>

				</div>
				<?php }?> <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>FEHLER!</strong><br><?php echo $_smarty_tpl->tpl_vars['error']->value;?>

				</div>
				<?php }?>
				<div class="form-group">
					<label for="inputDate" class="col-sm-4 control-label">Datum</label>
					<div class="col-sm-8">
						<div class="input-group date">
							<input type="text" class="form-control" id="inputDate" name="inputDate" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ks_day']->value,'%d.%m.%Y');?>
" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
						</div>
					</div>
				</div>
				<div class="form-group hidden-xs">
					<label for="checkboxPaintype" class="col-sm-4 control-label">Schmerzart</label>
					<div class="col-sm-8" id="checkboxPaintype">
						<?php
$_from = $_smarty_tpl->tpl_vars['ks_arten']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_paintype_0_saved_item = isset($_smarty_tpl->tpl_vars['paintype']) ? $_smarty_tpl->tpl_vars['paintype'] : false;
$__foreach_paintype_0_saved_key = isset($_smarty_tpl->tpl_vars['ks_id']) ? $_smarty_tpl->tpl_vars['ks_id'] : false;
$_smarty_tpl->tpl_vars['paintype'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['ks_id'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['paintype']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['ks_id']->value => $_smarty_tpl->tpl_vars['paintype']->value) {
$_smarty_tpl->tpl_vars['paintype']->_loop = true;
$__foreach_paintype_0_saved_local_item = $_smarty_tpl->tpl_vars['paintype'];
?>
						<div class="col-sm-4">
							<div class="checkbox">
								<label><input type="checkbox" class="checkboxPaintype" value="<?php echo $_smarty_tpl->tpl_vars['ks_id']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['ks_art']->value)) {
if ($_smarty_tpl->tpl_vars['ks_art']->value&$_smarty_tpl->tpl_vars['ks_id']->value) {?>checked<?php }
}?> name="checkboxPaintype[]" id="checkboxPaintype[<?php echo $_smarty_tpl->tpl_vars['ks_id']->value;?>
]"><?php echo $_smarty_tpl->tpl_vars['paintype']->value;?>
</label>
							</div>
						</div>
						<?php
$_smarty_tpl->tpl_vars['paintype'] = $__foreach_paintype_0_saved_local_item;
}
if ($__foreach_paintype_0_saved_item) {
$_smarty_tpl->tpl_vars['paintype'] = $__foreach_paintype_0_saved_item;
}
if ($__foreach_paintype_0_saved_key) {
$_smarty_tpl->tpl_vars['ks_id'] = $__foreach_paintype_0_saved_key;
}
?>
					</div>
				</div>
				<div class="form-group hidden-sm hidden-md hidden-lg">
					<label for="dropdownPaintype" class="col-sm-4 control-label">Schmerzart</label>
					<div class="col-sm-8">
						<select multiple class="form-control" id="dropdownPaintype" name="dropdownPaintype[]"> <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['ks_arten']->value,'selected'=>$_smarty_tpl->tpl_vars['ks_art']->value),$_smarty_tpl);?>

						</select>
					</div>
				</div>
				<div class="form-group hidden-xs">
					<label for="checkboxDrugs" class="col-sm-4 control-label">Eingenommene Medikamente</label>
					<div class="col-sm-8" id="checkboxDrugs">
						<?php
$_from = $_smarty_tpl->tpl_vars['medikamente']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_med_name_1_saved_item = isset($_smarty_tpl->tpl_vars['med_name']) ? $_smarty_tpl->tpl_vars['med_name'] : false;
$__foreach_med_name_1_saved_key = isset($_smarty_tpl->tpl_vars['med_id']) ? $_smarty_tpl->tpl_vars['med_id'] : false;
$_smarty_tpl->tpl_vars['med_name'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['med_id'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['med_name']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['med_id']->value => $_smarty_tpl->tpl_vars['med_name']->value) {
$_smarty_tpl->tpl_vars['med_name']->_loop = true;
$__foreach_med_name_1_saved_local_item = $_smarty_tpl->tpl_vars['med_name'];
?>
						<div class="col-sm-4">
							<div class="checkbox">
								<label><input type="checkbox" class="checkboxDrugs" value="<?php echo $_smarty_tpl->tpl_vars['med_id']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['ks_medis']->value)) {
if (in_array($_smarty_tpl->tpl_vars['med_id']->value,$_smarty_tpl->tpl_vars['ks_medis']->value)) {?>checked<?php }
}?> name="checkboxDrugs[]"><?php echo $_smarty_tpl->tpl_vars['med_name']->value;?>
</label>
							</div>
						</div>
						<?php
$_smarty_tpl->tpl_vars['med_name'] = $__foreach_med_name_1_saved_local_item;
}
if ($__foreach_med_name_1_saved_item) {
$_smarty_tpl->tpl_vars['med_name'] = $__foreach_med_name_1_saved_item;
}
if ($__foreach_med_name_1_saved_key) {
$_smarty_tpl->tpl_vars['med_id'] = $__foreach_med_name_1_saved_key;
}
?>
					</div>
				</div>
				<div class="form-group hidden-sm hidden-md hidden-lg">
					<label for="dropdownDrugs" class="col-sm-4 control-label">Eingenommene Medikamente</label>
					<div class="col-sm-8">
						<select multiple class="form-control" id="dropdownDrugs" name="dropdownDrugs[]"> <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['medikamente']->value,'selected'=>$_smarty_tpl->tpl_vars['ks_medis']->value),$_smarty_tpl);?>

						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputGrad" class="col-sm-4 control-label">Graduierung</label>
					<div class="col-sm-8">
						&nbsp;&nbsp;&nbsp;<input id="ex19" name="inputGrad" type="text" data-provide="slider" data-slider-ticks="[-1, 0, 1, 2, 3, 4]" data-slider-ticks-labels='[" ", "0", "1", "2", "3", "4"]' data-slider-min="-1" data-slider-max="4" data-slider-step="1"
							data-slider-value="<?php if (isset($_smarty_tpl->tpl_vars['ks_grad']->value)) {
echo $_smarty_tpl->tpl_vars['ks_grad']->value;
} else { ?>-1<?php }?>" data-slider-tooltip="hide" />
					</div>
				</div>
				<div class="form-group">
					<label for="textAreaInfo" class="col-sm-4 control-label">Zusätzliche Informationen</label>
					<div class="col-sm-8">
						<textarea class="form-control" id="textArea_info" name="textAreaInfo" cols="" rows=""><?php echo $_smarty_tpl->tpl_vars['ks_info']->value;?>
</textarea>
						<span class="help-block"></span>
					</div>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['ks_lastchange']->value) {?>
				<div class="form-group">
					<div class="col-sm-12">
						<span class="help-block">Letzte Änderung: <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ks_lastchange']->value,'%d.%m.%Y um %H:%M');?>
</span>
					</div>
				</div>
				<?php }?>
				<div class="form-group">
					<div class="text-right col-sm-12">
						<!-- col-sm-8 col-sm-offset-3 -->
						<?php if (!$_smarty_tpl->tpl_vars['showpain']->value) {?>
						<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#paindays">
							Schmerztage<span class="hidden-xs"> anzeigen</span>
						</button>
						<?php }?>
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteDay" <?php if (!$_smarty_tpl->tpl_vars['ks_lastchange']->value) {?>disabled="disabled"<?php }?>>Löschen</button>
						<button type="reset" class="btn btn-default">Zurücksetzen</button>
						<button type="submit" class="btn btn-primary">Speichern</button>
					</div>
				</div>
			</fieldset>
		</form>
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
</div>

<!-- Modal Eintrag löschen -->
<div class="modal fade" id="deleteDay" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Tageseintrag löschen?</h4>
			</div>
			<div class="modal-body">
				<p>Soll der Eintrag vom <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ks_day']->value,'%d.%m.%Y');?>
 wirklich unwiderruflich gelöscht werden?&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Nein</button>
				<a href="index.php?page=edit&date=<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ks_day']->value,'%d.%m.%Y');?>
&mode=delete" class="btn btn-success" role="button">Ja</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php echo '<script'; ?>
 type="text/javascript">

	$('#sandbox .input-group.date').datepicker({
		 endDate: "0d",
		 language: "de",
		 autoclose: true,
		 todayHighlight: true
	});
	$('#inputDate').change(function(){
		window.location.href = "index.php?page=edit&date=" + $(this).val();
	});
	$(function() {
	  $('.checkboxPaintype').click(function() {
	    $("#dropdownPaintype option[value=" + $(this).val() + "]").prop('selected', (this.checked ? true : false));
	  });
	  $('.checkboxDrugs').click(function() {
	    $("#dropdownDrugs option[value=" + $(this).val() + "]").prop('selected', (this.checked ? true : false));
	  });
	  $('#dropdownPaintype').click(function() {
	    $('.checkboxPaintype').prop('checked', false);
	    $.each($(this).val(), function(key, drug) {
	      $('#checkboxPaintype [value=' + drug + ']').prop("checked", true);
	    });
	  });
	  $('#dropdownDrugs').click(function() {
	    $('.checkboxDrugs').prop('checked', false);
	    $.each($(this).val(), function(key, drug) {
	      $('#checkboxDrugs [value=' + drug + ']').prop("checked", true);
	    });
	  });
	});	
<?php echo '</script'; ?>
>
<?php }
}
