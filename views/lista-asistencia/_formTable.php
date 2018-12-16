<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\ArrayDataProvider;

$models=$dataProvider->getModels();
$contador=$dataProvider->totalCount;
//var_dump($contador);
$diaSemanaNombre=['0'=>'Domingo','1'=>'Lunes','2'=>'Martes','3'=>'Miercoles','4'=>'Jueves',
	'5'=>'Viernes','6'=>'Sabado',];
$monthNombre=['1'=>'Enero','2'=>'Febrero','3'=>'Marzo','4'=>'Abril',
	'5' => 'Mayo', '6' => 'Junio', '7'=>'Julio', '8' => 'Agosto',
	'9'=>'Septiembre', '10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'];
$attr;
$month=date("n")-1;
$year=date("Y");
$diaActual=date("j");

//echo $month;

$diaSemana=date("w",mktime(0,0,0,$month,1,$year));
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
echo $diaSemanaNombre[$diaSemana].'<br>';
echo $ultimoDiaMes.'<br>';

echo '<i class="fa fa-hand-grab-o" style="font-size:24px"></i>';

$diaNombre='';
$diaPrint=0;
$star=0;
$star=1;
$diaPrint=6;
for ($i=$star; $i <= $ultimoDiaMes; $i++) { 
    switch ($diaPrint) {
        case '0':
            //domingo
        $diaNombre='Domingo';
            break;
        case '1':
            //lunes
        $diaNombre='Lunes';
            break;
        case '2':
            //martes
        $diaNombre='Martes';
            break;
        case '3':
            //miercoles
        $diaNombre='Miercoles';
            break;
        case '4':
            //jueves
        $diaNombre='Jueves';
            break;
        case '5':
            //viernes
        $diaNombre='Viernes';
            break;
        case '6':
            //sabado
        $diaNombre='Sabado';
            break;
        
        default:
            # code...
            break;
    }
    //echo $diaNombre.'<br>';

    $attr[]=[
        'head' => $diaSemanaNombre[$diaSemana].' '.$i.' '.$monthNombre[$month],
        'body' => Html::checkbox('12-'.$i,false,[]),
    ];
    
    $diaSemana++;
    //echo $diaPrint."<br>";
    if($diaSemana>6){
        $diaSemana=0;
    }
}
var_dump($attr);

?>

<?= '<table class="table table-striped table-bordered">' ?>
<?= '<thead>' ?>
	<?= '<tr>' ?>
		<?= '<th>' ?>
		<?= 'Nombre' ?>
		<?= '</th>' ?>

	<?= '</tr>' ?>
<?= '</thead>' ?>
	<?php 
		echo '<tbody>';
		foreach ($models as $key => $model) {
			echo "<tr>";
			foreach ($model as $key => $value) {
				if ($key=='nombre') {
					echo "<td>";
					echo $value;
					echo "</td>";	
				}
				
			}
			if (is_numeric($contador) && $contador>0) {
				echo "<td>";
				echo $contador--;
				echo "</td>";
			}
			
		}
		
		echo "</tr>";
		echo '</tbody>';
	 ?>

<?= '</table>' ?>


