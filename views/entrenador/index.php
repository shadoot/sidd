<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\SqlProvider */

$this->title = 'Entrenadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fh-entrenador-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar Entrenador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Nombre Completo',
            'Celular',
            /*[
                'label' => 'Telefono Movil',
                'value' => $provider,
            ],*/
            'Correo Electrónico',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
