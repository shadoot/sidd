<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $entrenador app\models\FhEntrenador */
/* @var $persona app\models\FhPersona */
/* @var $contacto app\models\FhContacto */

$this->title = 'Registrar Entrenador';
$this->params['breadcrumbs'][] = ['label' => 'Registro de Entrenadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fh-entrenador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'entrenador' => $entrenador,
        'persona' => $persona,
        'contacto' => $contacto,
    ]) ?>

</div>
