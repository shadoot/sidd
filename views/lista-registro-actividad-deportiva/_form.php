<?php

use app\models\FaActividadDeportiva;
use app\models\FaPeriodo;
use app\models\FhEntrenador;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use app\models\FhTipoEntrenador;

/* @var $this yii\web\View */
/* @var $rad app\models\FaListaRegistroActividadDeportiva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fa-lista-registro-actividad-deportiva-form">

    <?php $form = ActiveForm::begin(['method' => 'post','enableClientValidation' => true]); ?>

    <?= Html::activeHiddenInput($personaTemporal, 'id_temporal') ?>

    <?= $form->field($personaTemporal, 'nombre')->widget(\yii\jui\AutoComplete::classname(), [
    	'clientOptions' => [
        	//'source' => [['label'=>'juan','value'=>'12'],['label'=>'pablo','value'=>'2']],
    		'source' => FhEntrenador::getAllNameEntrenadores(),

    		'select' => new JsExpression("function(event, ui) { 
			       			$('#dynamicmodel-id_temporal').val(ui.item.id_entrenador);
			       			$('#dynamicmodel-nombre').text(ui.item.label);
			       			//$('#dynamicmodel-id_temporal').focus();
    						//console.log(ui);
			      		}"),
    		
    	],
    	'options' => ['class' => 'form-control'],
	])->label('Nombre de Entrenador') ?>

    
    <?php 
    	$actividad_deportiva=ArrayHelper::map(FaActividadDeportiva::find()
    		->where('estado=:estado')->addParams([':estado' => 1])->all(),'id_actividad_deportiva', 'nombre');
    	echo $form->field($rad,'id_actividad_deportiva')->dropDownList(
    		$actividad_deportiva,['prompt'=>'Seleccionar una actividad deportiva...'])->label('Actividad Deportiva');
     ?>

    <?= $form->field($rad, 'fecha')->widget(\yii\jui\DatePicker::class, [
    	'language' => 'es',
    	'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'yearRange' => '2014:+0',
            'changeYear' => true,
            'changeMonth' => true,
        ],
        'options' => ['class' => 'form-control', 'style' => 'width:25%']
    ]) ?>

    <?= $form->field($rad, 'en_curso')->checkbox() ?>

    
    <?php 
    	$actividad_deportiva=ArrayHelper::map(FaPeriodo::getPeriodo(),
    		'id_Periodo','Periodo');
    	echo $form->field($rad,'id_periodo')->dropDownList(
    		$actividad_deportiva,['prompt'=>'Seleccionar un periodo...'])->label('Periodo de la actividad');
     ?>

     <?php $tipo=ArrayHelper::map(FhTipoEntrenador::find()->all(),'id_tipo_entrenador', 'tipo'); ?>
    <?php echo $form->field($rad,'id_tipo_entrenador')->dropDownList(
            $tipo,['prompt'=>'Seleccionar un tipo...'])->label('Tipo de Entrenador'); ?>

    <div class="form-group">
        <?= Html::submitButton('Registar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>