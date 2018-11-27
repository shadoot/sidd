<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FaActividadDeportiva */

$this->title = $model->id_actividad_deportiva;
$this->params['breadcrumbs'][] = ['label' => 'Lista de Actividades Deportivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-actividad-deportiva-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id_actividad_deportiva], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id_actividad_deportiva], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Esta seguro de eliminar esta actividad? (Esta acción no se puede deshacer)',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_actividad_deportiva',
            'nombre',
            'rama',
            [
                'label' => 'estado',
                'value' => $model->getEstado(),
            ],
            //'estado',
            //'id_entrenador',
        ],
    ]) ?>

</div>
