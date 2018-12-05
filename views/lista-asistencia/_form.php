<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\FaListaAsistencia */
/* @var $form yii\widgets\ActiveForm */

/*$array=[['id' => '11', 'name' => 'juan', '12-4' => ''],
		['id' => '3', 'name' => 'eduardo', '12-4' => ''],
		['id' => '8', 'name' => 'ana', '12-4' => ''],
		['id' => '1', 'name' => 'martin', '12-4' => ''],
		['id' => '6', 'name' => 'jesus', '12-4' => '']];
$provider = new ArrayDataProvider([
    'allModels' => $array,
    'sort' => [
        'attributes' => ['id', 'name', 'age'],
    ],
    'pagination' => [
        'pageSize' => 10,
    ],
]);*/
?>

<div class="fa-lista-asistencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'id_Alumno')->textInput() ?>

    <?php //$form->field($model, 'id_actividad_deportiva')->textInput() ?>

    <?php //$form->field($model, 'dia')->textInput() ?>

    <?php //$form->field($model, 'asistencia')->checkbox() ?>

    <?php /*GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_calificacion',
            //'calificacion',
            //'id_lista_registro',
            'id',
            'name',
            //'age',
            //'17',
            [
            	'attribute' => '12-4',
            	'label' => '03 Diciembre',
            	'value' => function($model){
        			return Html::checkbox('17',false,[]);
    			},
    			'format' => 'raw'
            ],
            [
            	'attribute' => '12-4',
            	'label' => '04/12',
            	'value' => function($model){
        			return Html::checkbox('17',false,[]);
    			},
    			'format' => 'raw'
            ],
            [
            	'attribute' => '12-4',
            	'label' => '05/12',
            	'value' => function($model){
        			return Html::checkbox('17',false,[]);
    			},
    			'format' => 'raw'
            ],
            [
            	'attribute' => '12-4',
            	'label' => '06/12',
            	'value' => function($model){
        			return Html::checkbox('17',false,[]);
    			},
    			'format' => 'raw'
            ],
            [
            	'attribute' => '12-4',
            	'label' => '07/12',
            	'value' => function($model){
        			return Html::checkbox('17',false,[]);
    			},
    			'format' => 'raw'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */ ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id_lista_registro',
            'nombre', 
                    
            ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>    
