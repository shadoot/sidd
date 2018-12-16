<?php 
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\grid\GridView;

//echo Url::base();


if(is_array($model)){
    //echo "La variable model es un arreglo de ";
    //echo sizeof($model)." Elementos";
    //print_r($model['0']['id_evento']);
    //exit();
    echo Html::a('Nuevo Anexo', 
        ['anexo', 'id' => $model['0']['id_evento'],'n'=>'n'],
         ['class' => 'btn btn-primary']);
    echo "  ";
    echo Html::a('Editar anexo', ['_anexo', 'id' => $model['0']['id_evento']], ['class' => 'btn btn-primary']);
    echo "  ";
    echo Html::button('Nuevo Anexo', 
        ['id'=>'nuevoAnexo','data-id' => $model['0']['id_evento'],
        'class' => 'btn btn-primary']);
    echo '<br><br>';
    echo '<div>';
    
    if(sizeof($model)==1){
        echo DetailView::widget([
            'model' => $model['0'],
            'attributes' => [
                [
                    'attribute' => 'imagen',
                    'value' => Url::base().'/img/evento/'.$model['0']['imagen'],
                    'format' => ['image',['height'=>'100']],
                ],
                'descripcion',
            ],
        ]);
    }
    echo '</div>';
}
if(is_object($model)){
    //echo "Resulto se un objeto";
    
    echo Html::button('Nuevo Anexo', 
        ['id'=>'nuevoAnexo','data-id' => $model->getModels()['0']['id_evento'],
        'class' => 'btn btn-primary']);
    echo '<br><br>';
    echo GridView::widget([
        'dataProvider' => $model,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'imagen',
                'value' => function ($model) {   
                        if ($model->imagen!=''){
                          return '<img src="'.Url::base(). '/img/evento/'.$model->imagen.'" width="100px" height="auto">';
                        }
                        else{ 
                            return 'no image';
                        }
                     },
                'format' => 'raw',
            ],
            'descripcion',
            ['class' => 'yii\grid\ActionColumn',
                      'template'=>'{view} {update} {delete}',
                        'buttons'=>[
                   'view' => function ($url, $model) {     
                     return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'img/evento/'.$model->imagen, ['title' => Yii::t('yii', 'View'),]);   
                              }
                            ],
                  ],
        ]
    ]);
}
/*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
            	'attribute' => 'imagen',
            	'value' => Url::base().'/img/evento/'.$model->imagen,
            	'format' => ['image',['height'=>'100']],
            ],
            'descripcion',
        ],
    ]);*/

//echo '<br> <p><img src="'.Url::base().'/img/evento/'.$model->imagen.'" heigth="400" width="400"></p>';

//echo Html::img(Url::base().'/img/evento/'.$model->imagen,['heigth' => '40%', 'width' => '40%']);

//echo '<br> <p>'.$model->imagen.'</p>';

 ?>