<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

    <?php /*  GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_articulo',
            'nombre',
            'descripcion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>
</div>
<?php 
    $files=['FaEventoAnexo' => ['name' => ['image' => '82.jpg'],
     'type' => ['image' => 'image/jpeg'], 'tmp_name' => 
     ['image' => '/opt/lampp/temp/php82P2oA'], 'error'=> ['image' => '0'],
    'size' => ['image' => '1091984']]];


    print_r($files);
 ?>