<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FiInventario */

$this->title = 'Update Fi Inventario: ' . $model->id_inventario;
$this->params['breadcrumbs'][] = ['label' => 'Fi Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_inventario, 'url' => ['view', 'id' => $model->id_inventario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fi-inventario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
