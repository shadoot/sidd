<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear eventos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Calendario',['calendar'],['class'=>'btn btn-success'])?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_Evento',
            'Nombre',
            'Fecha',
            'Lugar',
            'Descripcion',
            //'Hr_Evento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
