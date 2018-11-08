<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaCalificacion */

$this->title = 'Update Fa Calificacion: ' . $model->id_calificacion;
$this->params['breadcrumbs'][] = ['label' => 'Fa Calificacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_calificacion, 'url' => ['view', 'id' => $model->id_calificacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fa-calificacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
