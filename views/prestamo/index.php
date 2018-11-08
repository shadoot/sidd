<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fi Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fi-prestamo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fi Prestamo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_prestamo',
            'id_Articulo',
            'cantidad',
            'fecha_solicitud',
            'fecha_entrega',
            //'concepto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
