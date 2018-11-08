<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fi Prestamo Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fi-prestamo-evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fi Prestamo Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_prestamo_evento',
            'id_prestamo',
            'id_evento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
