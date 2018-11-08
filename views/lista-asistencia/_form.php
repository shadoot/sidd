<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FaListaAsistencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fa-lista-asistencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_Alumno')->textInput() ?>

    <?= $form->field($model, 'id_actividad_deportiva')->textInput() ?>

    <?= $form->field($model, 'dia')->textInput() ?>

    <?= $form->field($model, 'asistencia')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
