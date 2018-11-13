<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FaListaRegistro */

$this->title = $model->id_lista_registro;
$this->params['breadcrumbs'][] = ['label' => 'Lista Registros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-lista-registro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_lista_registro], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_lista_registro], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_lista_registro',
            'id_Alumno',
            'id_actividad_deportiva',
            'fecha_registro',
        ],
    ]) ?>

</div>
