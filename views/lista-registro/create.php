<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FaListaRegistro */

$this->title = 'Create Fa Lista Registro';
$this->params['breadcrumbs'][] = ['label' => 'Fa Lista Registros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-lista-registro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
