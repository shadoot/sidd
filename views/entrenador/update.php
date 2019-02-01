<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $entrenador app\models\FhEntrenador */
/* @var $persona app\models\FhPersona */
/* @var $contacto app\models\FhContacto */
$nombre=$persona->Nombre . ' ' . $persona->Ap_Paterno. ' ' . $persona->Ap_Materno;
$this->title = 'Modificar Entrenador: ' . $nombre;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Entrenadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $nombre, 'url' => ['view', 'id' => $entrenador->id_entrenador]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="fh-entrenador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'entrenador' => $entrenador,
        'persona' => $persona,
        'contacto' => $contacto,
    ]) ?>

</div>
