<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\FhPersona;
use yii\web\JsExpression; 
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\FaActividadDeportiva */
/* @var $form yii\widgets\ActiveForm */
?>
	

<div class="fa-actividad-deportiva-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($actividad, 'nombre')->textInput(['maxlength' => true])/*->label('Nombre de AD')*/ ?>

    <?php 
        $rama=['Varonil' => 'Varonil','Femenil' => 'Femenil','Mixta' => 'Mixta'];
        echo $form->field($actividad,'rama')->dropDownList(
            $rama,
            [
                'promt'=>'Eliga una Rama',//investigar promt
            ]
        );
     ?>

    <?php /* Html::activeHiddenInput($personaTemporal, 'id_temporal')*/?>

    <?php /*$form->field($personaTemporal, 'nombre')->widget(\yii\jui\AutoComplete::classname(), [
    	'clientOptions' => [
        	//'source' => [['label'=>'juan','value'=>'12'],['label'=>'pablo','value'=>'2']],
    		'source' => FhPersona::getAllNameEntrenadores(),

    		'select' => new JsExpression("function(event, ui) { 
			       			$('#dynamicmodel-id_temporal').val(ui.item.id_Persona);
			       			//$('#dynamicmodel-nombre').text(ui.item.label);
			       			//$('#dynamicmodel-id_temporal').focus();
    						//console.log(ui);
			      		}"),
    		
    	],
    	'options' => ['class' => 'form-control'],
	]) */?>

    <?php /* Html::button('Registar Nuevo Entrenador', 
    ['id' => 'registar-entrenador', 'class' => 'btn btn-success',
    'data' => 'new']) */?>

    <?= $form->field($actividad,'estado')->checkbox(['label' => 'Vigente'])?>


    <div class="form-group">
        <?= Html::submitButton('Registar Actividad Deportiva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>