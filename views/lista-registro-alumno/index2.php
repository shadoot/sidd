<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-lista-registro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'nombre',
            'rama',
            'Periodo',
            'Año',
            'Alumnos inscritos',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{edit}',
                'buttons' => [
                    'edit' => function ($url, $model, $key){
                        return Html::a(
                            '<span class="glyphicon glyphicon-ok"></span>',
                            Url::to(['lista-registro-alumno/edit', 'id' => $model['id_lista_registro_actividad_deportiva']]));
                    },
                ],
            ],
        ],
    ]); ?>
</div>