<div class="page-header hidden-xs">
	<h3>Medikamentenverwaltung</h3>
</div>
<div class="row">
	<div class="col-sm-9">
		{if $mode == "edit"}
		<form class="form-horizontal" id="drugsForm" method="post">
			<input type="hidden" id="hiddenId" name="hiddenId" value="{if isset($medikament)}{$medikament.med_id}{else}-1{/if}">
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
					<label for="inputName" class="col-sm-4 control-label">Name des Medikament</label>
					<div class="col-sm-8">
						<input class="form-control" id="inputName" name="inputName" placeholder="Name des Medikament" type="text" required {if isset($medikament)}value="{$medikament.med_name}"{/if}>
					</div>
				</div>
				<div class="form-group">
					<label for="inputShort" class="col-sm-4 control-label">Abkürzung</label>
					<div class="col-sm-8">
						<input class="form-control" id="inputShort" name="inputShort" placeholder="Abkürzung" type="text" {if isset($medikament)}value="{$medikament.med_shortname}"{/if}><span class="help-block">Kann auch automatisch generiert werden.</span>
					</div>
				</div>
				<div class="form-group">
					<label for="inputDose" class="col-sm-4 control-label">Dosen</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="number" class="form-control" id="dose_value">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span id="mass_label">mg</span> <span class="caret"></span>
								</button>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#" onclick="$('#mass_label').text('mg')">Milligramm (mg)</a></li>
									<li><a href="#" onclick="$('#mass_label').text('µg')">Mikrogramm (µg)</a></li>
									<li><a href="#" onclick="$('#mass_label').text('ng')">Nanogramm (ng)</a></li>
								</ul>
								<button class="btn btn-success" type="button" onclick="add_dose()">
									<span class="glyphicon glyphicon-ok"></span>
								</button>
								<button class="btn btn-danger" type="button" onclick="delete_dose()">
									<span class="glyphicon glyphicon-remove"></span>
								</button>
							</div>
							<!-- /btn-group -->
						</div>
						<!-- /input-group -->
						<select size="4" class="form-control" multiple onclick="select_dose(this)" id="selectDoses" name="selectDoses" style="margin-top: 5px;"> {if isset($medikament)}{html_options values=$medikament.med_doses output=$medikament.med_doses}{/if})
						</select><input type="hidden" id="hiddenDoses" name="hiddenDoses">
					</div>
				</div>
				<div class="form-group">
					<label for="radioType" class="col-sm-4 control-label">Art des Medikament</label>
					<div class="col-sm-8">
						<label class="radio-inline"><input type="radio" name="radioType" required id="radioType" value="0" {if isset($medikament) && $medikament.med_type==0}checked{/if}> Akuttherapie </label> <label class="radio-inline"> <input type="radio" name="radioType" id="radioType" value="1"
							{if isset($medikament) && $medikament.med_type==1}checked{/if}> Prophylaxe
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="radioShow" class="col-sm-4 control-label">Anzeigen?</label>
					<div class="col-sm-8">
						<label class="radio-inline"><input type="radio" name="radioShow" required id="radioShow" value="1" {if isset($medikament) && $medikament.med_show==1}checked{/if}> ja </label> <label class="radio-inline"> <input type="radio" name="radioShow" required id="radioShow" value="0" {if
							isset($medikament) && $medikament.med_show==0}checked{/if}> nein
						</label><span class="help-block"> Bei der Erfassung von Schmerztagen.</span>
					</div>
				</div>
				<div class="form-group">
					<div class="text-right col-sm-12">
						{if !$showpain}
						<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#paindays">
							Schmerztage<span class="hidden-xs"> anzeigen</span>
						</button>
						{/if}
						<button type="button" class="btn btn-default n2d" data-dismiss="modal">Abbrechen</button>
						<button type="sumbit" class="btn btn-primary" id="submit" onclick="options2hidden();">Speichern</button>
					</div>
				</div>
			</fieldset>

		</form>
		<script type="text/javascript">
			function options2hidden() {
				var newhidden = '';
				$("#selectDoses option").each(function() {
					newhidden += $(this).val() + ';';
				});
				$("#hiddenDoses").val(newhidden);
			}
			function select_dose(element) {
				var val = element.value;
				selected_dose = element.selectedIndex;
				var stSplit = val.split(' ');
				$('#dose_value').val(stSplit[0]);
				$('#mass_label').text(stSplit[1]);
			}
			function delete_dose() {
				$('#selectDoses option:eq(' + selected_dose + ')').remove();
			}
			function add_dose() {
				var new_opt = $('#dose_value').val() + ' '
						+ $('#mass_label').text();
				$('#selectDoses').append(
						$('<option></option>').val(new_opt).html(new_opt));
				sort_doses();
				$('#dose_value').val('');
			}
			function sort_doses() {
				var options = $('#selectDoses option');
				var arr = options.map(function(_, o) {
					return {
						t : $(o).text(),
						v : o.value
					};
				}).get();
				arr.sort(function(o1, o2) {
					return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
				});
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});

			}
		</script>
		{elseif $mode=="list"} {if isset($success)}
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
		<table class="table table-striped">
			<tr>
				<th>Medikament</th>
				<th>Art</th>
				<th>Anzeigen</th>
				<th>Vorgang</th>
			</tr>
			{$glyphicon = ['glyphicon-unchecked', 'glyphicon-check']} {foreach from=$medikamente item=medikament key=drug_id}
			<tr>
				<td>{$medikament.med_name}</td>
				<td>{if $medikament.med_type}Prophylaxe{else}Akuttherapie{/if}</td>
				<td><span class="glyphicon {$glyphicon[$medikament.med_show+0]}" aria-hidden="true"></span></td>
				<td><a class="btn btn-success btn-xs" href="index.php?page=drugs&mode=edit&medid={$medikament.med_id}" role="button"><span class="glyphicon glyphicon-wrench"></span><span class="hidden-xs"> bearbeiten</span></a>
					<button type="button" data-drugname="{$medikament.med_name}" data-drugid="{$medikament.med_id}" data-toggle="modal" data-target="#deleteDrug" class="btn btn-danger btn-xs {if $medikament.med_used}disabled{/if}">
						<span class="glyphicon glyphicon-trash"></span><span class="hidden-xs"> löschen</span>
					</button></td>
			</tr>
			{/foreach}
		</table>
		<span class="help-block">Medikamente, die du bereits eingenommen hast, können nicht gelöscht werden.</span>
		<div class="text-right">
			{if !$showpain}
			<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#paindays">
				Schmerztage<span class="hidden-xs"> anzeigen</span>
			</button>
			{/if} <a class="btn btn-primary" href="index.php?page=drugs&mode=edit" role="button"><span class="hidden-xs">Medikament </span>hinzufügen</a>
		</div>
		{/if}
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
<!-- Modal Medikament löschen -->
<div class="modal fade" id="deleteDrug" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Medikament löschen?</h4>
			</div>
			<div class="modal-body">
				<p>
					Soll das Medikament '<span id="drugName">kein Name</span>' wirklich unwiderruflich gelöscht werden?&hellip;
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Nein</button>
				<a href="#" id="drugLink" class="btn btn-success" role="button">Ja</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
	$('#deleteDrug').on(
			'show.bs.modal',
			function(event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var drugName = button.data('drugname');
				var drugID = button.data('drugid');
				$('#drugName').text(drugName);
				$('#drugLink').attr("href",
						"index.php?page=drugs&mode=delete&medid=" + drugID);
			});
</script>