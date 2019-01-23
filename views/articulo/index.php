<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\ArticuloController;
use yii\web\JsExpression; 
//use yii\base\View;
use  yii\web\View;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fi-articulo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar Articulo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=   GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_articulo',
            'nombre',
            'descripcion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php 
    /*if (isset($error)) {
        $this->registerJs('alert("'.$error[0].'");', View::POS_READY);
    }*/
 ?>