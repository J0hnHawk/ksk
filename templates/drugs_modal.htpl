<div class="page-header hidden-xs">
	<h3>Medikamentenverwaltung</h3>
</div>
<div class="row">
	<div class="col-sm-9">
		<script type="text/javascript">
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
			$(document)
					.ready(
							function() {
								$('#drugEdit').on('hidden.bs.modal',
										function() {
											//window.location.reload(true);
										});
								$('.editButton')
										.on(
												'click',
												function() {
													// Get the record's ID via attribute
													var id = $(this).attr(
															'drug-id');
													$
															.get(
																	"./include/process.php?mode=getdrug&drug_id="
																			+ id,
																	function(
																			data) {
																		if (data.error == "1") {
																			$(
																					"#modal_drug_error")
																					.modal(
																							'show');
																			$(
																					'#drugEdit :input')
																					.prop(
																							"disabled",
																							true);
																			$(
																					'#drugEdit .n2d')
																					.prop(
																							"disabled",
																							false);
																		}

																		else {
																			$(
																					"#hiddenId")
																					.val(
																							data.med_id);
																			$(
																					"#inputName")
																					.val(
																							data.med_name);
																			$(
																					"#inputShort")
																					.val(
																							data.med_short);
																			for (var i = 0, len = (data.med_doses).length; i < len; i++) {
																				$(
																						'#selectDoses')
																						.append(
																								$(
																										'<option></option>')
																										.val(
																												data.med_doses[i])
																										.html(
																												data.med_doses[i]));
																			}
																			$(
																					"input[name='radioType'][value='"
																							+ data.med_type
																							+ "']")
																					.attr(
																							"checked",
																							"checked");
																			$(
																					"input[name='radioShow'][value='"
																							+ data.med_show
																							+ "']")
																					.attr(
																							"checked",
																							"checked");
																		}
																	}, "json");
													$("#drugEdit")
															.modal('show');
												});
								$("#drugEdit")
										.submit(
												function(event) {
													$
															.post(
																	"./include/process.php?mode=savedrug",
																	$(
																			"#drugsForm")
																			.serialize());
													event.preventDefault();
												});

							});
		</script>
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
				<td>
					<button type="button" class="btn btn-success btn-xs editButton" drug-id="{$drug_id}">
						<span class="glyphicon glyphicon-wrench"></span><span class="hidden-xs"> bearbeiten</span>
					</button>
					<button type="button" class="btn btn-danger btn-xs {if $medikament.med_used}disabled{/if}">
						<span class="glyphicon glyphicon-trash"></span><span class="hidden-xs"> löschen</span>
					</button>
				</td>
			</tr>
			{/foreach}
		</table>
		<span class="help-block">Medikamente, die du bereits eingenommen hast, können nicht gelöscht werden.</span>
		<div class="text-right">
			<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#paindays">
				Schmerztage<span class="hidden-xs"> anzeigen</span>
			</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#drugEdit" data-drugid="new">
				<span class="hidden-xs">Medikament </span>hinzufügen
			</button>
		</div>
		<div id="thanks">xx</div>
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
<!-- Modal Drugedit -->
<div id="drugEdit" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" id="drugsForm" method="post">
				<input type="hidden" id="hiddenId" name="hiddenId">
				<div class="modal-header">
					<button type="button" class="close n2d" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Medikament bearbeiten</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class="panel panel-danger collapse" id="modal_drug_error">
							<div class="panel-heading">
								<h3 class="panel-title">Übertragungsfehler!</h3>
							</div>
							<div class="panel-body">Die Daten des Medikaments konnten nicht übertragen werden.</div>
						</div>
						<div class="form-group">
							<label for="inputName" class="col-sm-4 control-label">Name des Medikament</label>
							<div class="col-sm-8">
								<input class="form-control" id="inputName" name="inputName" placeholder="Name des Medikament" type="text" required>
							</div>
						</div>
						<div class="form-group">
							<label for="inputShort" class="col-sm-4 control-label">Abkürzung</label>
							<div class="col-sm-8">
								<input class="form-control" id="inputShort" name="inputShort" placeholder="Abkürzung" type="text"><span class="help-block">Kann auch automatisch generiert werden.</span>
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
								<select size="4" class="form-control" onclick="select_dose(this)" id="selectDoses" name="selectDoses" style="margin-top: 5px;">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="radioType" class="col-sm-4 control-label">Art des Medikament</label>
							<div class="col-sm-8">
								<label class="radio-inline"><input type="radio" name="radioType" required id="radioType" value="0"> Akuttherapie </label> <label class="radio-inline"> <input type="radio" name="radioType" id="radioType" value="1"> Prophylaxe
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="radioShow" class="col-sm-4 control-label">Anzeigen?</label>
							<div class="col-sm-8">
								<label class="radio-inline"><input type="radio" name="radioShow" required id="radioShow" value="1"> ja </label> <label class="radio-inline"> <input type="radio" name="radioShow" required id="radioShow" value="0"> nein
								</label><span class="help-block"> Bei der Erfassung von Schmerztagen.</span>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default n2d" data-dismiss="modal">Abbrechen</button>
					<button class="btn btn-primary" id="submit">Speichern</button>
					<!-- type="submit"  -->
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$("button#submit").click(function() {
		$.ajax({
			type : "POST",
			url : "./include/process.php?mode=savedrug",
			data : $('#drugsForm').serialize(),
			success : function(msg) {
				$("#thanks").html(msg)
				$("#drugEdit").modal('hide');
			},
			error : function() {
				alert("failure");
			}
		});
	});
</script>