<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $actividad app\models\FaActividadDeportiva */

/*$this->registerJsFile(
	    '@web/js/entrenador.js',
	    ['depends' => [\yii\web\JqueryAsset::className()]]
);*/

$this->title = 'Registrar Actividad Deportiva';
$this->params['breadcrumbs'][] = ['label' => 'Lista de Actividades Deportivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-actividad-deportiva-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'actividad' => $actividad,
        /*'entrenador' => $entrenador,
        'persona' => $persona,
        'personaTemporal' => $personaTemporal,*/
    ]) ?>

</div>
<?php 
	/*Modal::begin([
			'header'=>'<h3>Registro de Entrenador</h3>',
			'id'=>'modal',
			'size'=>'modal-lg',
		]);
	echo "<div id='modalContent'></div>";
	Modal::end();*/
?>