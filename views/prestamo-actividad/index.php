<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fi Prestamo Actividads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fi-prestamo-actividad-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fi Prestamo Actividad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_prestamo_actividad',
            'id_prestamo',
            'id_actividad_deportiva',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
