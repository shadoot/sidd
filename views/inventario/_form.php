<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FiInventario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fi-inventario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_articulo')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
