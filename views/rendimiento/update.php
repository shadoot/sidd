<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaRendimiento */

$this->title = 'Modificar Rendimiento: ' . $model->id_rendimiento;
$this->params['breadcrumbs'][] = ['label' => 'Rendimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_rendimiento, 'url' => ['view', 'id' => $model->id_rendimiento]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="fa-rendimiento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
