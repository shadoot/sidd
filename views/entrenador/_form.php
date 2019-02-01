<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\FhTipoEntrenador;

/* @var $this yii\web\View */
/* @var $entrenador app\models\FhEntrenador */
/* @var $persona app\models\FhPersona */
/* @var $contacto app\models\FhContacto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fh-entrenador-form">

    <?php $form = ActiveForm::begin(['method' => 'post','enableClientValidation' => true]); ?>

    

    <?=	$form->field($persona,'Nombre')->textInput() ?>

    <?=	$form->field($persona,'Ap_Paterno')->textInput() ?>

    <?=	$form->field($persona,'Ap_Materno')->textInput() ?>

    <?=	$form->field($persona,'Genero')->textInput()->dropDownList(
            ['Masculino' => 'Masculino','Femenino' => 'Femenino'],
            ['prompt'=>'Seleccionar un genero...']
        ) ?>
        
    <?=	$form->field($persona,'ECivil')->textInput()->dropDownList(
            ['Soltero/a' => 'Soltero/a','Casado/a'=> 'Casado/a'],
            ['prompt'=>'Seleccionar un estado civil...']
        ) ?>

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

    <?php $tipo=ArrayHelper::map(FhTipoEntrenador::find()->all(),'id_tipo_entrenador', 'tipo'); ?>
    <?php echo $form->field($entrenador,'id_tipo_entrenador')->dropDownList(
            $tipo,['prompt'=>'Seleccionar un tipo...'])->label('Tipo de Entrenador'); ?>

    <?= $form->field($entrenador,'estado')->checkbox(['label' => 'Activo']) ?>

    <div class="form-group">
        <?= Html::submitButton('Registrar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php //("-_-) Actualizar los modelos de fhentrenador y falistaregistroactividaddeportiva?>