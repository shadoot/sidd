<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FaEvento */

$this->title = $model->Nombre;
$this->params['breadcrumbs'][] = ['label' => 'Fa Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-evento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar Evento', ['update', 'id' => $model->id_Evento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar Evento', ['delete', 'id' => $model->id_Evento], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de eliminar este evento?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Agregar Nuevo Evento', ['create'], ['class' => 'btn btn-primary', 'id' => 'nuevoEventoModal', 'data-date' => $model->Fecha]) ?>
        <br>
        <?= Html::button('Agregar Nuevo Evento', 
        ['id'=>'nuevoEventoModal','data-date' => $model->Fecha,
        'class' => 'btn btn-primary']);?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_Evento',
            'Nombre',
            'Fecha',
            'Lugar',
            'Descripcion',
            'Hr_Evento',
        ],
    ]) ?>

</div>
