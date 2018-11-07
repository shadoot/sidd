<?php 
use yii\bootstrap\Modal;
 ?>
<?php 
	$this->registerJsFile(
	    '@web/js/calendar.js',
	    ['depends' => [\yii\web\JqueryAsset::className()]]
	);
 ?>
<?php 
	Modal::begin([
			'header'=>'<h3>Registro de Eventos</h3>',
			'id'=>'modal',
			'size'=>'modal-lg',
		]);
	echo "<div id='modalContent'></div>";
	Modal::end();
		 ?>
<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $eventos,
  ));
?>