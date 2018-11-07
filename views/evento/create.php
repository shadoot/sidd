<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FaEvento */

$this->title = 'Create Fa Evento';
$this->params['breadcrumbs'][] = ['label' => 'Fa Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-evento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
