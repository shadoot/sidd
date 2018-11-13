<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FiPrestamoActividad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fi-prestamo-actividad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_prestamo')->textInput() ?>

    <?= $form->field($model, 'id_actividad_deportiva')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
