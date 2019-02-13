<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\FaPeriodo;

$this->title = 'Generador de graficas';
 ?>
 <div class="reporte-index">
   
   <h1><?= Html::encode($this->title) ?></h1>
   <?php $form = ActiveForm::begin(['method' => 'post','enableClientValidation' => true]); ?>

      <?php 
        $actividad_deportiva=ArrayHelper::map(FaPeriodo::getPeriodo(),
          'id_Periodo','Periodo');
        echo $form->field($temporal,'id_periodo')->dropDownList(
          $actividad_deportiva,['prompt'=>'Seleccionar un periodo...'])->label('Periodo a graficar');
     ?>

      <?= $form->field($temporal,'tipo_visualizacion')->textInput()->dropDownList(
            ['1' => 'General','2' => 'Por carrera'],
            ['prompt'=>'Seleccionar un tipo...']
        )->label('Tipo de grafica') ?>

      <?= $form->field($temporal,'tipo_indice')->textInput()->dropDownList(
            ['1' => 'Aprovacion','2' => 'Genero'],
            ['prompt'=>'Seleccionar un indice...']
        )->label('Tipo de indice') ?>

   <div class="form-group">
        <?= Html::submitButton('Visualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
 </div>