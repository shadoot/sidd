<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FiInventario */

$this->title = 'Control de inventario';
$this->params['breadcrumbs'][] = ['label' => 'inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fi-inventario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
