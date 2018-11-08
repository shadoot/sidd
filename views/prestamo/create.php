<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FiPrestamo */

$this->title = 'Create Fi Prestamo';
$this->params['breadcrumbs'][] = ['label' => 'Fi Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fi-prestamo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
