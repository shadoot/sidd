<?php 
use yii\widgets\DetailView;
use yii\helpers\Html;

//var_dump($datos);
 ?>

 <?= DetailView::widget([
    'model' => $datos,
    'attributes' => [
        [
        	'label' => 'Nombre',
        	'value' => $datos[0]['nombre'],
        ],
        [
        	'label' => 'Número de Control',
        	'value' => $datos[0]['numero_control'],
        ],
        [
        	'label' => 'Carrera',
        	'value' => $datos[0]['carrera'],
        ],
        [
        	'label' => 'Promedio',
        	'value' => $datos[0]['promedio'],
        ],
        [
        	'label' => 'Número de Actividades Aprovadas',
        	'value' => $datos[0]['actividades'],
        ],
    ],
]) ?>

<?php 
	if($datos[0]['promedio']>=70 && $datos[0]['actividades']>=2){
		echo "<div class='row text-center'>";
		echo "<h1 class='bg-success text-center'> ";
		echo "SUFICIENTE";
		echo "</h1>";
		echo Html::a('Visualizar constancia', ['constancia','numero' => $datos[0]['numero_control']], ['class' => 'btn btn-success', 'target' => '_blank']);
		echo "</div>";
	}else{
		echo "<div class='row'>";
		echo "<h1 class='bg-danger text-center'> ";
		echo "INSUFICIENTE";
		echo "</h1>";
		echo "</div>";
	}

 ?>