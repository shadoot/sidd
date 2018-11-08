<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FiPrestamo */

$this->title = 'Update Fi Prestamo: ' . $model->id_prestamo;
$this->params['breadcrumbs'][] = ['label' => 'Fi Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prestamo, 'url' => ['view', 'id' => $model->id_prestamo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fi-prestamo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
