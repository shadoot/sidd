<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaActividadDeportiva */

$this->title = 'Update Fa Actividad Deportiva: ' . $model->id_actividad_deportiva;
$this->params['breadcrumbs'][] = ['label' => 'Fa Actividad Deportivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_actividad_deportiva, 'url' => ['view', 'id' => $model->id_actividad_deportiva]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fa-actividad-deportiva-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
