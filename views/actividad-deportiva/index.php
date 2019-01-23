<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listas de Actividades Deportivas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-actividad-deportiva-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registar Actividad Deportiva', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_actividad_deportiva',
            'nombre',
            'rama',
            //'estado',
            [   
                'attribute' => 'estado',
                'label' => 'Estado',
                'value' => function($data)
                {
                    return ($data->estado=='1') ? 'Vigente' : 'Cancelado' ;
                },
            ],
            //'id_entrenador',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>