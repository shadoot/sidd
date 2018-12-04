<?php

use app\models\FhEntrenador;
use app\models\FaActividadDeportiva;
use app\models\FaPeriodo;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FaListaRegistroActividadDeportiva */

$this->title = FaActividadDeportiva::getNombreActividadDeportiva($model->id_actividad_deportiva);
$this->params['breadcrumbs'][] = ['label' => 'Lista de Registro de Actividades Deportivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-lista-registro-actividad-deportiva-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id_lista_registro_actividad_deportiva], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id_lista_registro_actividad_deportiva], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_lista_registro_actividad_deportiva',
            //'id_entrenador',
            [
                'attribute' => 'id_entrenador',
                'label' => 'Nombre del Entrenador',
                'value' => FhEntrenador::getNombreCompleto($model->id_entrenador),
            ],
            //'id_actividad_deportiva',
            [
                'attribute' => 'id_actividad_deportiva',
                'label' => 'Nombre de la Actividad Deportiva',
                'value' => FaActividadDeportiva::getNombreActividadDeportiva($model->id_actividad_deportiva),
            ],
            'fecha',
            //'en_curso',
            [
                'attribute' => 'en_curso',
                'label' => 'En Curso',
                'value' => ($model->en_curso) ? 'Abierta' : 'Cerrado',
            ],
            [
                'attribute' => 'id_periodo',
                'label' => 'Periodo de la Actividad',
                'value' => FaPeriodo::getPeriodoByID($model->id_periodo),
            ],
            [
                'label' => 'Rama',
                'value' => FaActividadDeportiva::getRamaActividad($model->id_actividad_deportiva),
            ],
        ],
    ]) ?>

</div>
