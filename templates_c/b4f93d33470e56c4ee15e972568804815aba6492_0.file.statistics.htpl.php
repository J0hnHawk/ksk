<?php
/* Smarty version 3.1.29, created on 2016-08-24 10:14:15
  from "D:\Programme\xampp\htdocs\ksk2\templates\statistics.htpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57bd6567bb49a3_19760287',
  'file_dependency' => 
  array (
    'b4f93d33470e56c4ee15e972568804815aba6492' => 
    array (
      0 => 'D:\\Programme\\xampp\\htdocs\\ksk2\\templates\\statistics.htpl',
      1 => 1464701472,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57bd6567bb49a3_19760287 ($_smarty_tpl) {
?>
<div class="page-header hidden-xs">
	<h3>
		Auswertung <small><?php echo $_smarty_tpl->tpl_vars['page_header']->value;?>
</small>
	</h3>
</div>
<div class="row">
	<div class="col-sm-10">
		<?php echo '<script'; ?>
 type="text/javascript" src="https://www.google.com/jsapi"><?php echo '</script'; ?>
>
		<div id="chart_div"></div>
	</div>
	<div class="col-sm-2">
		<ul class="nav nav-pills nav-stacked">
			<?php $_smarty_tpl->tpl_vars["class"] = new Smarty_Variable('class="active"', null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "class", 0);?>
			<li <?php if ($_smarty_tpl->tpl_vars['mode']->value == "ppw") {
echo $_smarty_tpl->tpl_vars['class']->value;
}?>><a href="index.php?page=statistics&mode=ppw">Kopfschmerzen pro Wochentag</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['mode']->value == "ppm") {
echo $_smarty_tpl->tpl_vars['class']->value;
}?>><a href="index.php?page=statistics&mode=ppm">Kopfschmerzen pro Monat</a></li>
			<li <?php if ($_smarty_tpl->tpl_vars['mode']->value == "ppie") {
echo $_smarty_tpl->tpl_vars['class']->value;
}?>><a href="index.php?page=statistics&mode=ppie">Schmerzarten</a></li>
		</ul>
	</div>
</div>
<?php if ($_smarty_tpl->tpl_vars['mode']->value == "ppw") {
echo '<script'; ?>
>
    google.load("visualization", "1", {
        packages : [ "corechart" ]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
                <?php echo $_smarty_tpl->tpl_vars['googlechartarray']->value;?>
 ]);
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
<?php echo '</script'; ?>
>
<?php } elseif ($_smarty_tpl->tpl_vars['mode']->value == "ppm") {
echo '<script'; ?>
>
    google.load("visualization", "1", {
        packages : [ "corechart" ]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
                <?php echo $_smarty_tpl->tpl_vars['googlechartarray']->value;?>
 ]);
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
<?php echo '</script'; ?>
>
<?php } elseif ($_smarty_tpl->tpl_vars['mode']->value == "ppie") {
echo '<script'; ?>
>
    google.load("visualization", "1", {
        packages : [ "corechart" ]
    });
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
                <?php echo $_smarty_tpl->tpl_vars['googlechartarray']->value;?>
 ]);
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
<?php echo '</script'; ?>
>
<?php }
}
}
