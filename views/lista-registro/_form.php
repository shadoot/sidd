<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FaListaRegistro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lista-registro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_Alumno')->textInput() ?>

    <?= $form->field($model, 'id_actividad_deportiva')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
