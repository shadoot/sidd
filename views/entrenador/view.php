<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $entrenador app\models\FhEntrenador */
/* @var $persona app\models\FhPersona */
/* @var $contacto app\models\FhContacto */

$this->title = $entrenador->id_entrenador;
$this->params['breadcrumbs'][] = ['label' => 'Fh Entrenadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fh-entrenador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $entrenador->id_entrenador], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $entrenador->id_entrenador], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $entrenador,
        'attributes' => [
            [
                'label' => 'Nombre Completo',
                'value' => $persona->Nombre . ' ' . $persona->Ap_Pataterno. ' ' . $persona->Ap_Materno,
            ],
            /*[
                'label' => 'Telefono',
                'value' => $contacto->Tel_Movil,
            ],*/
        ],
    ]) ?>

</div>
