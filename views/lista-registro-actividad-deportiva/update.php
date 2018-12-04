<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaListaRegistroActividadDeportiva */

$this->title = 'Modificar Registro de Actividad Deportiva: ' . $actividad->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Registros de Actividades Deportivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $actividad->nombre, 'url' => ['view', 'id' => $rad->id_lista_registro_actividad_deportiva]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="fa-lista-registro-actividad-deportiva-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'rad' => $rad,
        'entrenador' => $entrenador,
        'actividad' => $actividad,
        'personaTemporal' => $personaTemporal,
    ]) ?>

</div>
