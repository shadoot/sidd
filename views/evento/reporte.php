<?php 
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
    
    /*
    echo '<div>';
    
    echo GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'imagen',
                'value' => function ($provider) {   
                        if ($provider['imagen']!=''){
                          return '<img src="'.Url::base(). '/img/evento/'.$provider['imagen'].'" width="100px" height="auto">';
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
                   'view' => function ($url, $provider) {     
                     return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'img/evento/'.$provider['imagen'], ['title' => Yii::t('yii', 'View'),]);   
                              }
                            ],
                  ],
        ]
    ]);
    echo '</div>';
    */
    echo ListView::widget([
        'dataProvider' => $provider,
        'options' => [
          'tag' => 'div',
          'class' => 'list-wrapper',
          'id' => 'list-wrapper',
        ],
        'layout' => "{pager}\n{items}",
        'itemView' => function ($model, $key, $index, $widget) {
          
          return $this->render('_evento_lista_item',['model' => $model]);
        },
        'emptyText' =>'("-_-)',
    ]);
 ?>