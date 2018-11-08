<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FiPrestamoEvento */

$this->title = 'Create Fi Prestamo Evento';
$this->params['breadcrumbs'][] = ['label' => 'Fi Prestamo Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fi-prestamo-evento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
