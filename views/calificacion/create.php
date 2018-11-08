<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FaCalificacion */

$this->title = 'Create Fa Calificacion';
$this->params['breadcrumbs'][] = ['label' => 'Fa Calificacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-calificacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
