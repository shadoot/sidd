<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\ConstanciaController;
use yii\web\JsExpression; 
//use yii\base\View;
use  yii\web\View;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestionar Constancias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-constancia-gestionar">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Formato de Constancia', ['crear'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=   GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'titulo',
            'activa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>