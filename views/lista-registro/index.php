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

            'id_lista_registro',
            'id_Alumno',
            'id_actividad_deportiva',
            'fecha_registro',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>