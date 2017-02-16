<div class="page-header hidden-xs">
	<h3>Schmerzmitteleinnahme erfassen</h3>
</div>
<div class="row">
	<div class="col-sm-9">
		<link rel="stylesheet" href="styles/{$style}/css/bootstrap-slider.css">
		<script type='text/javascript' src="styles/{$style}/js/bootstrap-slider.js"></script>
		<form class="form-horizontal" id="sandbox" action="index.php?page=edit" method="POST">
			<fieldset>
				{if isset($success)}
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>ERFOLG:</strong><br>{$success}
				</div>
				{/if} {if isset($info)}
				<div class="alert alert-info">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>HINWEIS:</strong><br>{$info}
				</div>
				{/if} {if isset($error)}
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>FEHLER!</strong><br>{$error}
				</div>
				{/if}
				<div class="form-group">
					<label for="inputDate" class="col-sm-4 control-label">Datum</label>
					<div class="col-sm-8">
						<div class="input-group date">
							<input type="text" class="form-control" id="inputDate" name="inputDate" value="{$ks_day|date_format:'%d.%m.%Y'}" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
						</div>
					</div>
				</div>
				<div class="form-group hidden-xs">
					<label for="checkboxPaintype" class="col-sm-4 control-label">Schmerzart</label>
					<div class="col-sm-8" id="checkboxPaintype">
						{foreach from=$ks_arten item=paintype key=ks_id}
						<div class="col-sm-4">
							<div class="checkbox">
								<label><input type="checkbox" class="checkboxPaintype" value="{$ks_id}" {if isset($ks_art)}{if $ks_art & $ks_id}checked{/if}{/if} name="checkboxPaintype[]" id="checkboxPaintype[{$ks_id}]">{$paintype}</label>
							</div>
						</div>
						{/foreach}
					</div>
				</div>
				<div class="form-group hidden-sm hidden-md hidden-lg">
					<label for="dropdownPaintype" class="col-sm-4 control-label">Schmerzart</label>
					<div class="col-sm-8">
						<select multiple class="form-control" id="dropdownPaintype" name="dropdownPaintype[]"> {html_options options=$ks_arten selected=$ks_art}
						</select>
					</div>
				</div>
				<div class="form-group hidden-xs">
					<label for="checkboxDrugs" class="col-sm-4 control-label">Eingenommene Medikamente</label>
					<div class="col-sm-8" id="checkboxDrugs">
						{foreach from=$medikamente item=med_name key=med_id}
						<div class="col-sm-4">
							<div class="checkbox">
								<label><input type="checkbox" class="checkboxDrugs" value="{$med_id}" {if isset($ks_medis)}{if in_array($med_id,$ks_medis)}checked{/if}{/if} name="checkboxDrugs[]">{$med_name}</label>
							</div>
						</div>
						{/foreach}
					</div>
				</div>
				<div class="form-group hidden-sm hidden-md hidden-lg">
					<label for="dropdownDrugs" class="col-sm-4 control-label">Eingenommene Medikamente</label>
					<div class="col-sm-8">
						<select multiple class="form-control" id="dropdownDrugs" name="dropdownDrugs[]"> {html_options options=$medikamente selected=$ks_medis}
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputGrad" class="col-sm-4 control-label">Graduierung</label>
					<div class="col-sm-8">
						&nbsp;&nbsp;&nbsp;<input id="ex19" name="inputGrad" type="text" data-provide="slider" data-slider-ticks="[-1, 0, 1, 2, 3, 4]" data-slider-ticks-labels='[" ", "0", "1", "2", "3", "4"]' data-slider-min="-1" data-slider-max="4" data-slider-step="1"
							data-slider-value="{if isset($ks_grad)}{$ks_grad}{else}-1{/if}" data-slider-tooltip="hide" />
					</div>
				</div>
				<div class="form-group">
					<label for="textAreaInfo" class="col-sm-4 control-label">Zusätzliche Informationen</label>
					<div class="col-sm-8">
						<textarea class="form-control" id="textArea_info" name="textAreaInfo" cols="" rows="">{$ks_info}</textarea>
						<span class="help-block"></span>
					</div>
				</div>
				{if $ks_lastchange}
				<div class="form-group">
					<div class="col-sm-12">
						<span class="help-block">Letzte Änderung: {$ks_lastchange|date_format:'%d.%m.%Y um %H:%M'}</span>
					</div>
				</div>
				{/if}
				<div class="form-group">
					<div class="text-right col-sm-12">
						<!-- col-sm-8 col-sm-offset-3 -->
						{if !$showpain}
						<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#paindays">
							Schmerztage<span class="hidden-xs"> anzeigen</span>
						</button>
						{/if}
						{if $ks_lastchange}
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteDay" {if !$ks_lastchange}disabled="disabled"{/if}>Löschen</button>
							<button type="reset" class="btn btn-default">Zurücksetzen</button>
						{/if}
						<button type="submit" class="btn btn-primary">Speichern</button>
					</div>
				</div>
			</fieldset>
		</form>
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
				<p>Soll der Eintrag vom {$ks_day|date_format:'%d.%m.%Y'} wirklich unwiderruflich gelöscht werden?&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Nein</button>
				<a href="index.php?page=edit&date={$ks_day|date_format:'%d.%m.%Y'}&mode=delete" class="btn btn-success" role="button">Ja</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
{literal}
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
	});	{/literal}
</script>
