<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fa Lista Registros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-lista-registro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fa Lista Registro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'fecha_registro',
            'Número de Control',
            'Alumno',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
