<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\FaActividadDeportiva;
use app\models\FhAlumno;

/* @var $this yii\web\View */
/* @var $model app\models\FaListaRegistro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lista-registro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_Alumno')->widget(\yii\jui\AutoComplete::classname(), [
    	'clientOptions' => [
        	'source' => FhAlumno::getAllNumeroControl(),
    	],
	]) ?>

    <?php 
    	$actividad_deportiva=ArrayHelper::map(FaActividadDeportiva::find()->all(),'id_actividad_deportiva', 'nombre');
    	echo $form->field($model,'id_actividad_deportiva')->dropDownList(
    		$actividad_deportiva,
    		[
    			'promt'=>'Eliga una actividad',
    		]
    	);
     ?>

    <?= $form->field($model, 'fecha_registro')->widget(\yii\jui\DatePicker::class, [
    	'language' => 'es',
    ])?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

