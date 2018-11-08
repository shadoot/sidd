<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FaActividadDeportiva */

$this->title = 'Create Fa Actividad Deportiva';
$this->params['breadcrumbs'][] = ['label' => 'Fa Actividad Deportivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-actividad-deportiva-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
