<?php

use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */

?>

<div class="fa-rendimiento-form">
<?php 
	$form = ActiveForm::begin();
	echo TabularForm::widget([
	    'dataProvider'=>$provider,
	    'form'=>$form,
	    'formName'=>'kvTabForm',
	    'actionColumn'=>false,
	    'attributes'=>[
	    	'id_lista_registro' => [
	    		'type' => TabularForm::INPUT_HIDDEN, 
            	'columnOptions'=>['hidden'=>true]
	    	],
	    	'Num_Control' => [
	    		'type'=>TabularForm::INPUT_STATIC,
	    	],
	    	'Nombre del alumno' => [
	    		'type'=>TabularForm::INPUT_STATIC,
	    	],
	    	'puntuacion' => [
    			'type'=>TabularForm::INPUT_TEXT
	    	],
	    	'id_rendimiento' =>[
	    		'type' => TabularForm::INPUT_HIDDEN, 
            	'columnOptions'=>['hidden'=>true]
	    	]
	    ],
	    'gridSettings' => [
            //'floatHeader' => true,
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="fas fa-book"></i> Registro de desempeño</h3>',
                'type' => GridView::TYPE_PRIMARY,
                'after'=>
                    Html::submitButton(
                        '<i class="fas fa-save"></i> Guardar', 
                        ['class'=>'btn btn-success']
                    )
            ]
        ]        
	]);
	
	
	ActiveForm::end();
 ?>    
</div>
