<div class="page-header hidden-xs">
	<h3>
		Auswertung <small>{$page_header}</small>
	</h3>
</div>
<div class="row">
	<div class="col-sm-10">
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<div id="chart_div"></div>
	</div>
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked">
			{assign "class" 'class="active"'}
			<li {if $mode=="ppw"}{$class}{/if}><a href="index.php?page=statistics&mode=ppw">Kopfschmerzen pro Wochentag</a></li>
			<li {if $mode=="ppm"}{$class}{/if}><a href="index.php?page=statistics&mode=ppm">Kopfschmerzen pro Monat</a></li>
			<li {if $mode=="ppie"}{$class}{/if}><a href="index.php?page=statistics&mode=ppie">Schmerzarten</a></li>
		</ul>
	</div>
</div>
{if $mode == "ppw"}
<script>
    google.load("visualization", "1", {
        packages : [ "corechart" ]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
                {$googlechartarray} ]);
        var options = {
            /*title : 'Kopfschmerzen pro Wochentag',*/
            legend : {
                position : 'none'
            },
            backgroundColor: { fill:'transparent' },
            height : 400,
            isStacked : false,
        };
        var chart = new google.visualization.ColumnChart(document
                .getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
{elseif $mode == "ppm"}
<script>
    google.load("visualization", "1", {
        packages : [ "corechart" ]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
                {$googlechartarray} ]);
        var options = {
            /*title : 'Kopfschmerzen pro Monat',*/
            legend : {
                position : 'none'
            },
            backgroundColor: { fill:'transparent' },
            height : 400,
            /* hAxis : { textStyle: { color: '#ffffff' } },
            vAxis : { textStyle: { color: '#ffffff' } }, */
            isStacked : false,
        };
        var chart = new google.visualization.LineChart(document
                .getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
{elseif $mode == "ppie"}
<script>
    google.load("visualization", "1", {
        packages : [ "corechart" ]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
                {$googlechartarray} ]);
        var options = {
            /*title : 'Kopfschmerzen pro Monat',*/
            backgroundColor: { fill:'transparent' },
            height : 400,
            isStacked : false,
        };
        var chart = new google.visualization.PieChart(document
                .getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
{/if}
