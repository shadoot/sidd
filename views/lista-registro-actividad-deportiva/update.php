<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaListaRegistroActividadDeportiva */

$this->title = 'Update Fa Lista Registro Actividad Deportiva: ' . $model->id_lista_registro_actividad_deportiva;
$this->params['breadcrumbs'][] = ['label' => 'Fa Lista Registro Actividad Deportivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lista_registro_actividad_deportiva, 'url' => ['view', 'id' => $model->id_lista_registro_actividad_deportiva]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fa-lista-registro-actividad-deportiva-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
