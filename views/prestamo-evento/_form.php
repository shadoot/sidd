<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FiPrestamoEvento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fi-prestamo-evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_prestamo')->textInput() ?>

    <?= $form->field($model, 'id_evento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
