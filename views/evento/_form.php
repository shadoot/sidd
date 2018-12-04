<?php

//use kartikorm\ActiveForm;
//use kartik\widgets\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;


/* @var $this yii\web\View */
/* @var $model app\models\FaEvento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fa-evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'id_Evento')->textInput() ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha')->textInput() ?>

    <?= $form->field($model, 'Lugar')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'Hr_Evento')->textInput() ?>

    <?= $form->field($model, 'Hr_Evento')->widget(TimePicker::classname(), [
        'pluginOptions' => [
            //'showSeconds' => true
            'minuteStep' => 1,
            'showMeridian' => false,
        ],
        'options' => [
            'readonly' => true,
        ],
    ]);?>

    <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true]) ?>

    <?php /* TimePicker::widget([
            //'name' => 'Hr_Evento', 
            //'value' => '11:24 AM',
            'pluginOptions' => [
                //'showSeconds' => true
            ],
            'options' => [
                'readonly' => true,
            ],
            ]);*/
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
