<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use app\models\FaEventoAnexo;
use yii\data\ActiveDataProvider;

?>

<article class="item" data-key="<?php $model['id_Evento']; ?>">
    <h2 class="title">
    	<?= $model['Nombre'] ?>
    </h2>

    <?= 'Fecha del evento '.$model['Fecha'] ?>
    <br>
    <?= 'Lugar del evento '.$model['Lugar'] ?>
    <br>
    <?= 'Hora del evento '.$model['Hr_Evento'] ?>

    <div class="item-excerpt">
    <?= Html::encode($model['descripcion_evento']); ?>
    </div>

	<?php // Html::img('img/evento/'.$model['imagen']) ?>    

	<?php // $model['descripcion_anexo'] ?>

	<?php 

		$dataProvider = new ActiveDataProvider([
        	'query' => FaEventoAnexo::find()->where(['id_evento'=>$model['id_Evento']]),
    	]);

		echo ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
          'tag' => 'div',
          'class' => 'list-wrapper',
          'id' => 'list-wrapper',
        ],
        'layout' => "{pager}\n{items}",
        'itemView' => function ($model, $key, $index, $widget) {
          
          	
          return $this->render('_anexo_lista',['model' => $model]);
        }
    ]);
	 ?>

</article>
