<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FaListaAsistencia */

$this->title = 'Create Fa Lista Asistencia';
$this->params['breadcrumbs'][] = ['label' => 'Fa Lista Asistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-lista-asistencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
