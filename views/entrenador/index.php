<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entrenadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fh-entrenador-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar Entrenador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_entrenador',
            'id_persona',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
