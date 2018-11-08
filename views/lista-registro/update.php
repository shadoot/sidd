<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaListaRegistro */

$this->title = 'Update Fa Lista Registro: ' . $model->id_lista_registro;
$this->params['breadcrumbs'][] = ['label' => 'Fa Lista Registros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lista_registro, 'url' => ['view', 'id' => $model->id_lista_registro]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fa-lista-registro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
