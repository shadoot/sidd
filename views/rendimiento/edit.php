<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaRendimiento */

$this->title = 'Registrar Rendimiento';
$this->params['breadcrumbs'][] = ['label' => 'Rendimiento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-rendimiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'provider' => $provider,
    ]) ?>

</div>