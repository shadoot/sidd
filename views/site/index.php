<?php

use yii\console\widgets\Table;
/* @var $this yii\web\View */

$this->title = 'Coordinación de deportes y cultura';
?>

	<div class="container">
		<div class="row" >
			<h1> Proximos Eventos</h1>
		</div>
		<?php foreach ($proximosEventos as $key => $evento) {
			echo '<div class="row" > <p>';
			echo '<h3>'.$evento['Nombre'].'</h3><spam>'.
			$evento['Fecha'].' '.$evento['Descripcion'].'</spam>';
			echo "</p></div>";
		} ?>
	</div>
	

</body>
</html>