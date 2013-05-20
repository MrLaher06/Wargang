<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<h2>:: Détail de vos statistiques (<?php echo $total_stat; ?>)</h2>
<div id="graph_stat_detail" align="center">Chargement en cours...</div>

<h2>:: Détail de vos statistiques sur le mois (<?php echo $total_stat_mois; ?>)</h2>
<div id="graph_stat_mois_detail" align="center">Chargement en cours...</div>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
  var myChart = new JSChart('graph_stat_detail', 'line');
  myChart.setDataArray([<?php echo implode(', ', $tableau_stat); ?>], 'rouge');
  myChart.setTitle('');
  myChart.setTitleFontSize(10);
  myChart.setAxisNameX('Heure ');
  myChart.setAxisNameY('Action ');
  myChart.setAxisValuesColor('#FFF');
  myChart.setAxisPaddingLeft(45);
  myChart.setAxisPaddingRight(5);
  myChart.setAxisPaddingTop(20);
  myChart.setAxisPaddingBottom(30);
  myChart.setAxisValuesNumberX(25);
  myChart.setGraphExtend(true);
  myChart.setGridColor('#FFF');
  myChart.setLineWidth(2);
  myChart.setLineColor('#900', 'rouge');	
  myChart.setFlagRadius(4);
  myChart.setSize( Math.round( $('#statistiques').width() - 20 ), 130);
  myChart.draw();
	
  var myChart = new JSChart('graph_stat_mois_detail', 'line');
  myChart.setDataArray([<?php echo implode(', ', $tableau_stat_mois); ?>], 'rouge');
  myChart.setTitle('');
  myChart.setTitleFontSize(10);
  myChart.setAxisNameX('Jours ');
  myChart.setAxisNameY('Action ');
  myChart.setAxisValuesColor('#FFF');
  myChart.setAxisPaddingLeft(45);
  myChart.setAxisPaddingRight(5);
  myChart.setAxisPaddingTop(20);
  myChart.setAxisPaddingBottom(30);
  myChart.setAxisValuesNumberX(<?php echo $jour_actuel; ?>);
  myChart.setGraphExtend(true);
  myChart.setGridColor('#FFF');
  myChart.setLineWidth(2);
  myChart.setLineColor('#900', 'rouge');	
  myChart.setFlagRadius(4);
  myChart.setSize( Math.round( $('#statistiques').width() - 20 ), 110);
  myChart.draw();
});
</script>
