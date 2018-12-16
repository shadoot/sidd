<?php 
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
/*echo Highcharts::widget([
	'options' => [
		'title' => ['text' => 'Genero por actividad'],
		'chart' => [
			'type' => 'pie'
		],
		'series' => [[
			'name' => 'Brands',
			'colorByPoint' => 'true',
			'data' => [['name' => 'Firefox',
				'y' => '10.85']]
		]]
	]
]);*/

/*echo Highcharts::widget([
   'options' => [
      'title' => ['text' => 'Consumo de Fruta'],
      'xAxis' => [
         'categories' => ['Manzanas', 'Platanos', 'Narangas']
      ],
      'yAxis' => [
         'title' => ['text' => 'Frutas Comidas']
      ],
      'series' => [
         ['name' => 'Jane', 'data' => [1, 0, 4]],
         ['name' => 'John', 'data' => [0, 7, 1]],
         ['name' => 'Jean', 'data' => [2, 2, 15]],
         ['name' => 'Sani', 'data' => [5, 3, 3]],
      ]
   ]
]);*/

/*echo Highcharts::widget([
	'options' => '{
		"chart": { 
			"plotBackgroundColor": "white",
			"plotBorderWidth": "null",
			"plotShadow": "false",
			"type": "pie"
			},
	      "title": { "text": "Genero por actividad" },
	      "xAxis": {
	         "categories": ["Apples", "Bananas", "Oranges"]
	      },
	      "tooltip": {
	      		"pointFormat": "\'{series.name}: <b>{point.percentage:.1f}%</b>\'"
	      	},
	      "plotOptions": {
	      		"pie": {
	      				"allowPointSelect": "true",
	      				"cursor": "\'pointer\'",
	      				"dataLabels": {
	      					"enabled": "false"
	      				},
	      				"showInLegend": "true"
	      			}
	      },	

		"series":[{
			"name": "Brands",
			"colorByPoint": "true",
			"data": [{
				"name": "Chrome",
				"y": "\'100\'"
				}]
			}]	      
   }'
]);*/

/*echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'Combination chart',
        ],
         'series' => [
        'type' => 'pie',
        'name' => 'Total consumption',
        'data' => [
            [
                'name' => 'Jane',
                'y' => 13,
                'color' => new JsExpression('Highcharts.getOptions().colors[0]'), // Jane's color
            ],
            [
                'name' => 'John',
                'y' => 23,
                'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // John's color
            ],
            [
                'name' => 'Joe',
                'y' => 19,
                'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // Joe's color
            ],
        ],
        
        ],
    ]
]);*/
echo Highcharts::widget([
	'options' => '{
    "chart": {
        "plotBackgroundColor": null,
        "plotBorderWidth": null,
        "plotShadow": false,
        "type": "pie"
    },
    "title": {
        "text": "Browser market shares in January, 2018"
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
        "name": "Genero",
        "data": [{
            "name": "H",
            "y": '.$hombres.'
        }, {
            "name": "M",
            "y": '.$mujeres.'
        }]
    }]
}'
]);
 ?>

 <!--
	"series": [{
	      	"name": "\'Brands\'",
	      	"colorByPoint": "true",
	      	"data": [{
	      		"name": "\'Chrome\'",
	      		"y": "61.41",
	      		"sliced": "true",
	      		"selected": "true"
	      		},{
	      			"name": "Internet Explorer",
	      			"y": "11.84"
	      		}, {
		            "name": "\'Firefox\'",
		            y: 10.85
		        }, {
		            "name": "\'Edge\'",
		            y: 4.67
		        }, {
		            "name": "\'Safari\'",
		            y: 4.18
		        }, {
		            "name": "\'Other\'",
		            y: 7.05
		        }]
	      	}]
	
 -->