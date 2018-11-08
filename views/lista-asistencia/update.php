<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaListaAsistencia */

$this->title = 'Update Fa Lista Asistencia: ' . $model->id_lista;
$this->params['breadcrumbs'][] = ['label' => 'Fa Lista Asistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lista, 'url' => ['view', 'id' => $model->id_lista]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fa-lista-asistencia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
