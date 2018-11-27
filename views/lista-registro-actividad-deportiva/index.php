<?php

use app\models\FhEntrenador;
use app\models\FaActividadDeportiva;
use app\models\FaPeriodo;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Registro de Actividades Deportivas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-lista-registro-actividad-deportiva-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar Actividad Deportiva', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_lista_registro_actividad_deportiva',
            //'id_entrenador',
            [
                'attribute' => 'id_entrenador',
                'label' => 'Nombre del Entrenador',
                'value' => function ($data)
                {
                    return FhEntrenador::getNombreCompleto($data->id_entrenador);
                },
            ],
            //'id_actividad_deportiva',
            [
                'attribute' => 'id_actividad_deportiva',
                'label' => 'Nombre de Actividad',
                'value' => function($data)
                {
                    return FaActividadDeportiva::getNombreActividadDeportiva($data->id_actividad_deportiva);
                },
            ],
            'fecha',
            //'en_curso',

            [
                'attribute' => 'en_curso',
                //'label' => 'Curso',
                'value' => function ($data)
                {
                    return ($data->en_curso) ? 'Abierta' : 'Cerrado' ;
                }
            ],
            [
                'attribute' => 'id_periodo',
                'label' => 'Periodo',
                'value' => function($data)
                {
                    return FaPeriodo::getPeriodoByID($data->id_periodo);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
