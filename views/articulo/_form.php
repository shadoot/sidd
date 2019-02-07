<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\markdown\MarkdownEditor;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\FiArticulo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fi-articulo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= MarkdownEditor::widget([
		'model' => $model, 
		'attribute' => 'descripcion',
		'previewAction' => 'articulo/preview',
	]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
