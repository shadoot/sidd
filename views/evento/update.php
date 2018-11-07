<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaEvento */

$this->title = 'Update Fa Evento: ' . $model->id_Evento;
$this->params['breadcrumbs'][] = ['label' => 'Fa Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_Evento, 'url' => ['view', 'id' => $model->id_Evento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fa-evento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
