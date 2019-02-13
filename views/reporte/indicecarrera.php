<?php 
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

$a='[';
foreach ($DatosAprovados as $key => $value) {
	$a=$a.$value.',';
}
$a = substr_replace ($a, "]", strrpos($a, ","), 2);

$r='[';
foreach ($DatosReprovados as $key => $value) {
	$r=$r.$value.',';
}
$r = substr_replace ($r, "]", strrpos($r, ","), 2);

$c='["';
foreach ($ListaCarreras as $key => $value) {
	$c=$c.$value.'","';
}
$c = substr_replace ($c, "]", strrpos($c, ","), 2);

echo Highcharts::widget([
	'options' => '{
		    "chart": {
		        "type": "column"
		    },
		    "title": {
		        "text": "Indice de aprovación por carrera"
		    },
		    "subtitle": {
		        "text": "'.$periodo.'"
		    },
		    "xAxis": {
		        "categories": '.$c.',
		        "crosshair": true
		    },
		    "yAxis": {
		        "min": 0,
		        "title": {
		            "text": "Número de alumnos"
		        }
		    },
		    "tooltip": {
		        "headerFormat": "<span style=\"font-size:10px\">{point.key}</span><table>",
		        "pointFormat": "<tr><td style=\"padding:0\">{series.name}: </td> <td style=\"padding:0\"><b>{point.y}</b></td></tr>",
		        "footerFormat": "</table>",
		        "shared": true,
		        "useHTML": true
		    },
		    "plotOptions": {
		        "column": {
		            "pointPadding": 0.2,
		            "borderWidth": 0
		        }
		    },
		    "series": [{
		        "name": "Aprodado",
		        "data": '.$a.'

		    }, {
		        "name": "Reprovado",
		        "data": '.$r.'

		    }]
		}'
]);

 ?>