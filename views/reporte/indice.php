<?php 
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;


echo Highcharts::widget([
	'options' => '{
	    "chart": {
	        "plotBackgroundColor": null,
	        "plotBorderWidth": null,
	        "plotShadow": false,
	        "type": "pie"
	    },
	    "title": {
	        "text": "Alumnos aprovados y reprobados del periodo '.
	        $periodo.' del año '.$year.'"
	    },
	    "tooltip": {
	        "pointFormat": "{series.name}: <b>{point.percentage:.1f}%</b>"
	    },
	    "plotOptions": {
	        "pie": {
	            "allowPointSelect": true,
	            "cursor": "pointer",
	            "dataLabels": {
	                "enabled": false
	            },
	            "showInLegend": true
	        }
	    },
	    "series": [{
	        "name": "indice",
	        "data": [{
	            "name": "Aprovados '.$aprovado.'",
	            "y": '.$aprovado.'
	        }, {
	            "name": "Reprovados '.$reprobado.'",
	            "y": '.$reprobado.'
	        }]
	    }]
	}'
]);

 ?>