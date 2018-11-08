<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FiPrestamoEvento */

$this->title = 'Update Fi Prestamo Evento: ' . $model->id_prestamo_evento;
$this->params['breadcrumbs'][] = ['label' => 'Fi Prestamo Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prestamo_evento, 'url' => ['view', 'id' => $model->id_prestamo_evento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fi-prestamo-evento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
