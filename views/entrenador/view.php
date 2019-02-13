<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $entrenador app\models\FhEntrenador */
/* @var $persona app\models\FhPersona */
/* @var $contacto app\models\FhContacto */

$this->title = $row[0]['alumno'];
$this->params['breadcrumbs'][] = ['label' => 'Lista de Entrenadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fh-entrenador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => '1'/*$entrenador->id_entrenador*/], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => '1',/*$entrenador->id_entrenador*/], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $row,
        'attributes' => [
            [
                'label' => 'Nombre del alumno',
                'value' => $row[0]['alumno']
            ],
            [
                'label' => 'Estado',
                'value' => function($data)
                {
                    return ($data[0]['estado']=='1') ? 'Activo' : 'Inactivo' ;
                }
            ],
            [
                'label' => 'Genero',
                'value' => $row[0]['Genero']
            ],
            [
                'label' => 'Fecha de nacimiento',
                'value' => $row[0]['FNacimiento']
            ],
        ],
    ]) ?>

    <?php 
            foreach ($row as $key => $value) {
                if ($value['nombre']=='') {
                    echo "<h4>No ha impartido ninguna actividad deportiva o cultural</h4>";
                    echo "es del tipo ".$value['tipo'];
                }else{
                    echo DetailView::widget([
                        'model' => $row,
                        'attributes' => [
                            [
                                'label' => 'nombre',
                                'value' => $value['nombre']
                            ],
                            [
                                'label' => 'rama',
                                'value' => $value['rama']
                            ],
                            [
                                'label' => 'Periodo',
                                'value' => $value['Periodo']
                            ],
                            [
                                'label' => 'tipo',
                                'value' => $value['tipo']
                            ],
                            [
                                'label' => 'Año',
                                'value' => $value['Año']
                            ],
                        ],
                    ]);
                }
            }
     ?>

</div>
