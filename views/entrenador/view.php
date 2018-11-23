<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $entrenador app\models\FhEntrenador */
/* @var $persona app\models\FhPersona */
/* @var $contacto app\models\FhContacto */

$this->title = $persona->Nombre . ' ' . $persona->Ap_Pataterno. ' ' . $persona->Ap_Materno;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Entrenadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fh-entrenador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $entrenador->id_entrenador], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $entrenador->id_entrenador], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de eliminar este elemento?',
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
            [
                'label' => 'Telefono',
                'value' => $contacto->Tel_Movil,
            ],
            [
                'label' => 'Correo Electronico',
                'value' => $contacto->e_mail,
            ],
        ],
    ]) ?>

</div>
