<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntrenadorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fh-entrenador-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_entrenador') ?>

    <?= $form->field($model, 'estado') ?>

    <?= $form->field($model, 'id_tipo_entrenador') ?>

    <?= $form->field($model, 'id_persona') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
