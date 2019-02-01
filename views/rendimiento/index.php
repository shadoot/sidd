<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rendimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-rendimiento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //Html::a('Registrar Rendimiento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_lista_registro_actividad_deportiva',
            'Nombre de la actividad',
            'rama',
            'Periodo',
            'Año',
            'Alumnos calificados',
            'Cantidad total',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{edit}',
                'buttons' => [
                    'edit' => function ($url, $model, $key){
                        return Html::a(
                            '<span class="glyphicon glyphicon-edit"></span>',
                            Url::to(['rendimiento/edit', 'id' => $model['id_lista_registro_actividad_deportiva']]));
                    },
                ],
            ],
        ],
    ]); ?>
</div>
