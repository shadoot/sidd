<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $actividad app\models\FaActividadDeportiva */

$this->title = 'Modificar Actividad Deportiva: ' . $actividad->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Actividades Deportivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $actividad->id_actividad_deportiva, 'url' => ['view', 'id' => $actividad->id_actividad_deportiva]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fa-actividad-deportiva-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'actividad' => $actividad,
    ]) ?>

</div>
