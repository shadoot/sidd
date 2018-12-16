<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
//use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\builder\TabularForm;
//use kartik\grid\GridView;

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

    $attr;
    $attr[]=[
                'attribute' => 'nombre',
            ];

    for ($i=1; $i <= 31; $i++) {

        $attr[]=[
                'label' => $i.' Diciembre',
                'value' => function($model,$i){

                    return Html::checkbox($model['id_lista_registro'].'_12-'.$i++,false,[]);
                },
                'format' => 'raw'
            ];            
    }        
    
        
        //var_dump($attr);
        
?>
<div class="fa-lista-asistencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'id_Alumno')->textInput() ?>

    <?php //$form->field($model, 'id_actividad_deportiva')->textInput() ?>

    <?php //$form->field($model, 'dia')->textInput() ?>

    <?php //$form->field($model, 'asistencia')->checkbox() ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns'=>$attr,
        /*'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_calificacion',
            //'calificacion',
            //'id_lista_registro',
            'id_lista_registro',
            'nombre',
            //'age',
            //'17',
            [
            	//'attribute' => '12-4',
            	'label' => '03 Diciembre',
            	'value' => function($model){
        			return Html::checkbox($model['id_lista_registro'].'_12-3',false,[]);
    			},
    			'format' => 'raw'
            ],
            [
            	//'attribute' => '12-4',
            	'label' => '04/12',
            	'value' => function($model){
        			return Html::checkbox($model['id_lista_registro'].'_12-4',false,[]);
    			},
    			'format' => 'raw'
            ],
            [
            	//'attribute' => '12-4',
            	'label' => '05/12',
            	'value' => function($model){
        			return Html::checkbox($model['id_lista_registro'].'_12-5',false,[]);
    			},
    			'format' => 'raw'
            ],
            [
            	//'attribute' => '12-4',
            	'label' => '06/12',
            	'value' => function($model){
        			return Html::checkbox($model['id_lista_registro'].'_12-6',false,[]);
    			},
    			'format' => 'raw'
            ],
            [
            	'attribute' => '12-4',
            	'label' => '07/12',
            	'value' => function($model){
        			return Html::checkbox($model['id_lista_registro'].'_12-7',false,[]);
    			},
    			'format' => 'raw'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],*/
    ]); ?>
    <?php  /*GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id_lista_registro',
            'nombre', 
                    
            ],
    ]); */?>

    

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>    
