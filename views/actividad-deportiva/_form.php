<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\FhPersona;
//use yii\web\JsExpression; 
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\FaActividadDeportiva */
/* @var $form yii\widgets\ActiveForm */
?>
	

<div class="fa-actividad-deportiva-form">

    <?php $form = ActiveForm::begin(['method' => 'post','enableClientValidation' => true]); ?>

    <?= $form->field($actividad, 'nombre')->textInput(['maxlength' => true])/*->label('Nombre de AD')*/ ?>

    <?php 
        $rama=['Varonil' => 'Varonil','Femenil' => 'Femenil','Mixta' => 'Mixta'];
        echo $form->field($actividad,'rama')->dropDownList(
            $rama,
            ['prompt'=>'Seleccionar una rama...']
        );
     ?>

    <?= $form->field($actividad,'estado')->checkbox(['label' => 'Vigente'])?>


    <div class="form-group">
        <?= Html::submitButton('Registar Actividad Deportiva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>