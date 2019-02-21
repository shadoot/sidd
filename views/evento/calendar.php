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
			'header'=>'<h3 id="evento" >Registro de Eventos</h3>',
			'id'=>'modalEvento',
			'size'=>'modal-lg',
		]);
	echo "<div id='modalContentEvento'></div>";
	Modal::end();
		 ?>
	<?php 
	Modal::begin([
			'header'=>'<h3 id="anexo" >Agregar Anexo</h3>',
			'id'=>'modalAnexo',
			'size'=>'modal-lg',
		]);
	echo "<div id='modalContentAnexo'></div>";
	Modal::end();
		 ?>	 
<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $eventos,
  ));
?>