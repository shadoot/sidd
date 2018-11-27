<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $rad app\models\FaListaRegistroActividadDeportiva */

$this->title = 'Registrar Actividad Deportiva';
$this->params['breadcrumbs'][] = ['label' => 'Lista de Registro de Actividades Deportivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-lista-registro-actividad-deportiva-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'rad' => $rad,
        'entrenador' => $entrenador,
        'actividad' => $actividad,
        'personaTemporal' => $personaTemporal,
    ]) ?>

</div>
