<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FhEntrenador */

$this->title = 'Update Fh Entrenador: ' . $model->id_entrenador;
$this->params['breadcrumbs'][] = ['label' => 'Fh Entrenadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_entrenador, 'url' => ['view', 'id' => $model->id_entrenador]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fh-entrenador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
