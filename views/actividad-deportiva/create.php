<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $actividad app\models\FaActividadDeportiva */

$this->title = 'Registrar Actividad Deportiva';
$this->params['breadcrumbs'][] = ['label' => 'Lista de Actividades Deportivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-actividad-deportiva-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'actividad' => $actividad,
        'entrenador' => $entrenador,
        'persona' => $persona,
        'personaTemporal' => $personaTemporal,
    ]) ?>

</div>
