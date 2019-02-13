<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\FhTipoEntrenador;
use app\models\FhEntrenador;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\SqlProvider */

$this->title = 'Lista de entrenadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fh-entrenador-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar Entrenador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php /* GridView::widget([
        'dataProvider' => $provider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Nombre Completo',
            'Celular',
            /*[
                'label' => 'Telefono Movil',
                'value' => $provider,
            ],#
            'Correo Electrónico',
            [
                'attribute' => 'estado',
                'label' => 'Estado',
                'value' => function($data)
                {
                    //var_dump($data);
                    //exit();
                    return ($data['estado']=='1') ? 'Activo' : 'Inactivo' ;
                },
                //'filter' => Html::activeDropDownList($searchModel,)
            ],
            [
                'attribute' => 'tipo',
                'label' => 'Tipo de Entrenador',
                'value' => 'tipo',
                'filter' => Html::activeDropDownList($searchModel,'tipo',
                ArrayHelper::map(FhTipoEntrenador::find()->all(),'id_tipo_entrenador', 'tipo'),
                [ 'prompt' => 'Seleccione un estado','class' => 'form-control']),
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);*/ ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id_persona',
                'label' => 'Nombre',
                'value' => 'persona.nombreCompleto',
            ],
            [
                'attribute' => 'id_tipo_entrenador',
                'value' => 'tipoEntrenador.tipo',
                'filter' => Html::activeDropDownList($searchModel,'id_tipo_entrenador',
                ArrayHelper::map(FhTipoEntrenador::find()->all(),'id_tipo_entrenador', 'tipo'),
                [ 'prompt' => 'Seleccione un tipo...','class' => 'form-control']),
            ],
            [
                'attribute' => 'estado',
                'label' => 'Estado',
                'value' => function($data)
                {
                    
                    return ($data['estado']=='1') ? 'Activo' : 'Inactivo' ;
                },
                'filter' => Html::activeDropDownList($searchModel,'estado',
                ['1' => 'Activo','0'=> 'Inactivo'],
                [ 'prompt' => 'Seleccione un estado...','class' => 'form-control']),
                
            ],
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
