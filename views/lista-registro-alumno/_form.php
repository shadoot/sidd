<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\FaActividadDeportiva;
use app\models\FhAlumno;
use app\models\FaListaRegistroAlumno;
use yii\web\JsExpression; 

/* @var $this yii\web\View */
/* @var $model app\models\FaListaRegistroAlumno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lista-registro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_Alumno')->widget(\yii\jui\AutoComplete::classname(), [
    	'clientOptions' => [
        	'source' => FhAlumno::getAllNumeroControl(),
            'select' => new JsExpression("function(event, ui) { 
                            $('#dynamicmodel-nombre_temp').val(ui.item.nombre);
                            $('#dynamicmodel-numero_control').text(ui.item.value);
                            $('#dynamicmodel-carrera').val(ui.item.carrera);

                            console.log(ui);
                        }"),
    	],
        'options' => ['class' => 'form-control'],
	])->label('Numero de Control') ?>

    <?= $form->field($alumnoTemporal,'nombre_temp')->textInput(['readonly' => true])
        ->label('Nombre Completo') ?>

    <?= Html::activeHiddenInput($alumnoTemporal, 'numero_control') ?>

    <?= $form->field($alumnoTemporal,'carrera')->textInput(['readonly' => true])->label('Carrera') ?>  

    <?php 
    	$actividad_deportiva=ArrayHelper::map(FaListaRegistroAlumno::getActividadDeportivaEnCurso(),'id_lrad', 'nombre');
    	echo $form->field($model,'id_lista_registro_actividad_deportiva')->dropDownList(
    		$actividad_deportiva,
    		[
    			'promt'=>'Eliga una actividad',
    		]
    	);
     ?>

    <?= $form->field($model, 'fecha_registro')->widget(\yii\jui\DatePicker::class, [
    	'language' => 'es',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control', 'style' => 'width:25%']
    ])?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

