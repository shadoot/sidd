<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FiPrestamoActividad */

$this->title = 'Update Fi Prestamo Actividad: ' . $model->id_prestamo_actividad;
$this->params['breadcrumbs'][] = ['label' => 'Fi Prestamo Actividads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prestamo_actividad, 'url' => ['view', 'id' => $model->id_prestamo_actividad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fi-prestamo-actividad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
