<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use app\models\FhAlumno;

 ?>

 <div class="row">
 	<?php // Html::script('function test(){alert("Hello!");}' ) ?>
 	<?php // Html::input('text', 'control','', ['class' => 'form-control']) ?>
	<?php // Html::button('Press me!', ['class' => 'btn btn-primary','onclick'=>'test()']) ?>    

	<?php $form = ActiveForm::begin(['method' => 'post','enableClientValidation' => true]); ?>

    <?= $form->field($alumnoTemporal, 'id_alumno')->widget(\yii\jui\AutoComplete::classname(), [
    	'clientOptions' => [
        	'source' => FhAlumno::getAllNumeroControl(),
            'select' => new JsExpression("function(event, ui) { 
                            $('#dynamicmodel-nombre').val(ui.item.nombre);
                            $('#dynamicmodel-numero_control').val(ui.item.value);
                            $('#dynamicmodel-carrera').val(ui.item.carrera);
                        }"),
    	],
        'options' => ['class' => 'form-control'],
	])->label('Numero de Control') ?>

    <?= $form->field($alumnoTemporal,'nombre')->textInput(['readonly' => true])
        ->label('Nombre Completo') ?>

    <?= $form->field($alumnoTemporal,'carrera')->textInput(['readonly' => true])->label('Carrera') ?>  

    <?= Html::activeHiddenInput($alumnoTemporal, 'numero_control') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>