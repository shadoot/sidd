<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'Número de Control',
            'Alumno',
            'Actividad Extracurricular',
            'Periodo',
            'Año',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
