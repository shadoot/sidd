<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;

?>

    
    <?php //$model->id_evento_anexo ?>
    <br>
    <?= Html::img(Url::base(). '/img/evento/'.$model->imagen) ?>
    <br>
    <?= $model->descripcion ?>
    <br>
    

	<?php
    //var_dump($model);
		/*echo ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
          'tag' => 'div',
          'class' => 'list-wrapper',
          'id' => 'list-wrapper',
        ],
        'layout' => "{pager}\n{items}",
        'itemView' => function ($model, $key, $index, $widget) {
          
          return $this->render('_evento_lista_item',['model' => $model]);
        }
    ]);*/
	 ?>