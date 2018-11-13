<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FiArticulo */

$this->title = 'Registrar Articulos';
$this->params['breadcrumbs'][] = ['label' => ' Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fi-articulo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
