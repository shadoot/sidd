<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $entrenador app\models\FhEntrenador */
/* @var $persona app\models\FhPersona */
/* @var $contacto app\models\FhContacto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fh-entrenador-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?=	$form->field($persona,'Nombre')->textInput() ?>

    <?=	$form->field($persona,'Ap_Pataterno')->textInput() ?>

    <?=	$form->field($persona,'Ap_Materno')->textInput() ?>

    <?=	$form->field($persona,'Genero')->textInput() ?>

    <?=	$form->field($persona,'ECivil')->textInput() ?>

    <?=	$form->field($persona,'FNacimiento')->widget(\yii\jui\DatePicker::class, [
    	'language' => 'es',
    	'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'yearRange' => '-80:+0',
            'changeYear' => true,
            'changeMonth' => true,
        ],
        'options' => ['class' => 'form-control', 'style' => 'width:25%']
    ]) ?>

    <?=	$form->field($contacto,'Tel_Fijo')->textInput() ?>

    <?=	$form->field($contacto,'Tel_Movil')->textInput() ?>

    <?=	$form->field($contacto,'e_mail')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Registrar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
