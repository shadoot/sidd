<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-lista-registro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            //'id_lista_registro',
            [
                'label' => 'Número de Control',
                'value' => 'alumno.Num_Control',
            ],
            //'id_Alumno',
            [
                'label' => 'Nombre Completo',
                'value' => 'alumno.persona.NombreCompleto',
            ],
            [
                'label' => 'Carrera',
                'value' => 'alumno.carrera.Nombre',
            ],
            //'id_lista_registro_actividad_deportiva',
            [
                'label' => 'Actividad Deportiva',
                'value' => 'listaRegistroActividadDeportiva.actividadDeportiva.nombre',
            ],
            //'nombre',
            'fecha_registro',
            //'Número de Control',
            //'Alumno',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
