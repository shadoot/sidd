<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestamos a Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fi-prestamo-evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar Prestamo ', ['create'], ['class' => 'btn btn-success']) ?>
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
