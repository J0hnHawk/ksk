<div class="page-header hidden-xs">
	<h3>Übersicht für {$amonat|date_format:'%B %Y'|utf8_encode}</h3>
</div>
<div class="row">
	<div class="col-sm-9">
		{literal}
		<script type="text/javascript">
			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip({
					placement : 'top',
					container : 'body'
				});
			});
		</script>
		{/literal}
		<div class="table-responsive">
			{if $mode=="list"}
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
					{assign "check" "glyphicon-check"} {assign "unchecked" "glyphicon-unchecked"} {foreach from=$tage key=datum item=daten}
					<tr {if freiertag($datum)}class="weekendlist2" {/if} data-toggle="modal" href="#day_details" data-modal_title="{$datum|date_format:'%d.%m.%Y'}" data-modal_type="{$daten.ks_art}" data-modal_drugs="{foreach from=$daten.ks_medis item=medi name=drugs}{$medikamente[$medi].name}<br>{/foreach}"
						data-modal_grad="{$daten.ks_grad}" data-modal_info="{$daten.ks_info}">
						<td>{$datum|date_format:'%d.'}<span class="hidden-xs">{$datum|date_format:'%m.%Y'}</span><a href="index.php?seite=edit&amp;date={$datum}"></a>
						</td>
						<td><span class="glyphicon {if $daten.ks_art & 1}{$check}{else}{$unchecked}{/if}"></span></td>
						<td><span class="glyphicon {if $daten.ks_art & 2}{$check}{else}{$unchecked}{/if}"></span></td>
						<td><span class="glyphicon {if $daten.ks_art & 4}{$check}{else}{$unchecked}{/if}"></span></td>
						<td>{foreach from=$daten.ks_medis item=medi name=drugs}<span class="hidden-xs">{$medikamente.$medi.name}</span><span class="hidden-sm hidden-md hidden-lg">{$medikamente.$medi.short}</span>{if $smarty.foreach.drugs.last}{else}, {/if}{/foreach}
						</td> {for $grad = 0 to 4}
						<td><span class="glyphicon {if isset($daten.ks_grad) && $daten.ks_grad == $grad}{$check}{else}{$unchecked}{/if}" aria-hidden="true"></span></td> {/for}
						<td>{$daten.ks_info}</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
			{else}
			<script type="text/javascript">
				$(document).ready(function() {
					$('[data-toggle="tooltip"]').tooltip({
						placement : 'top'
					});
				});
			</script>
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
					{foreach from=$tage key=datum item=daten name=calendar} {if $smarty.foreach.calendar.iteration%7 == 1}
					<tr>
						{/if} {if $daten.ks_art & 1}{assign "class" "danger"}{elseif $daten.ks_art == 0}{assign "class" "success"}{elseif $daten.ks_art & 2}{assign "class" "warning"}{elseif $daten.ks_art & 4}{assign "class" "info"}{else}{assign "class" ""}{/if}
						<td class="{$class}" data-toggle="modal" href="#day_details" data-modal_title="{$datum|date_format:'%d.%m.%Y'}" data-modal_type="{$daten.ks_art}" data-modal_drugs="{foreach from=$daten.ks_medis item=medi name=drugs}{$medikamente[$medi].name}<br>{/foreach}" data-modal_grad="{$daten.ks_grad}"
							data-modal_info="{$daten.ks_info}">{if $datum|date_format:'%m' != $amonat|date_format:'%m'} {assign "dayclass" "othermonth"} {else} {if freiertag($datum)} {assign "dayclass" "weekend"} {else} {assign "dayclass" "weekday"} {/if} {/if}
							<p class="{$dayclass}">
								{$datum|date_format:'%d'+0}
								<!-- {$datum|date_format:'%d.%m.%Y - %H:%M'} -->
							</p>
							<p>
								{foreach from=$daten.ks_medis item=medi name=drugs}
								<!-- <span data-toggle="tooltip" title="{$medikamente[$medi].name}"> -->
								{$medikamente[$medi].short}
								<!-- </span> -->
								{if $smarty.foreach.drugs.last}{else}, {/if}{/foreach}&nbsp;
							</p> {if isset($daten.ks_grad) && $daten.ks_grad > -1}
							<p class="badge">{$daten.ks_grad}{else}
							<p>&nbsp;{/if}</p>
						</td> {if $smarty.foreach.calendar.iteration%7 == 0}
					</tr>
					{/if} {/foreach}
				</tbody>
			</table>
			{/if}

		</div>
		<nav>
			<ul class="pager">
				<li class="previous"><a href="index.php?page=report&mode={$mode}&month={$amonat|date_format:'m'-1}&year={$amonat|date_format:'Y'}"> <span aria-hidden="true">&larr;</span> vorheriger
				</a></li>
				<li class="next"><a href="index.php?page=report&mode={$mode}&month={$amonat|date_format:'m'+1}&year={$amonat|date_format:'Y'}"> nächster <span aria-hidden="true">&rarr;</span>
				</a></li>
			</ul>
		</nav>
	</div>
	<div class="col-sm-3">
		<div class="panel {$panel_type} {if !$showpain}collapse{/if}" id="paindays">
			<div class="panel-heading">Zusammenfassung {$drugdays.monat|date_format:'%B %Y'|utf8_encode}</div>
			<div class="panel-body">
				<p>{$drugdays.kstage} Tage mit Kopfschmerzen</p>
				<p>{$drugdays.meditage} Tage mit Schmerzmitteln</p>
			</div>
		</div>
		<legend>Monat wählen:</legend>
		<center>
			<div id="datepicker"></div>
		</center>
		<br>
		<script type="text/javascript">
			$('#datepicker').datepicker({
				startDate : "{$ekt|date_format:'%d/%m/%Y'}",
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
		</script>
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
			<!--  <form method="post" action="index.php?page=report&mode={$mode}{if isset($amonat)}&month={$amonat|date_format:'m'}&year={$amonat|date_format:'Y'}{/if}" target="_BLANK"> -->
			<form method="post" action="index.php?page=report_pdf" target="_BLANK">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Auswertung über 6 Monate</h4>
				</div>
				<div class="modal-body">
					<p>Auswertungen können für den den Zeitraum {$ekt|date_format:'%B %Y'} bis {$lkt|date_format:'%B %Y'} generiert werden.</p>
					<fieldset>
						<div class="form-group">
							<label for="inputStart" class="col-sm-4 control-label">Auswertung ab</label>
							<div class="col-sm-8">{html_options name=startmonat options=$sme class="form-control" id="inputStart"}</div>
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
<script>
	function br2nl(str) {
		return str.replace(/<br\s*\/?>/mg, "\r\n");
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
</script>