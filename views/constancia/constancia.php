<?php 
use kartik\markdown\Markdown;

 /*Yii::$app->assetManager->bundles['app\assets\AppAsset']=[
 	'css' => ['css/site.css','css/font.css'],
 ];*/
 /*$this->registerCss("
    @font-face {
        font-family: '".$constanciaContent->nombre_fuente."';
        src: url('/".$constanciaContent->archivo_fuente."') format('truetype');
        font-weight: normal;
        font-weight: normal;
    }
");*/
//use cifras\CifrasEnLetras;

Yii::$classMap['CifrasEnLetras'] = '@vendor/cifras/CifrasEnLetras.php';

$content=$constanciaContent->contenido;
$nombre=strtoupper($datos[0]['nombre']);
$control=$datos[0]['numero_control'];
$carrera=strtoupper($datos[0]['carrera']);
$periodo='20'.substr($control, 0,2).'-'.date("Y");
$promedio=$datos[0]['promedio'];

$promedio=substr($promedio,0,(-(strpos($promedio,'.')))-2);
$rendimiento='';
if(strpos($content, ':rendimiento()')){
	if($promedio<70){
		$rendimiento='insuficiente';
	}else if($promedio<80){
		$rendimiento='suficiente';
	}else if($promedio<90){
		$rendimiento='bueno';
	}else if($promedio<100){
		$rendimiento='notable';
	}else if($promedio=100){
		$rendimiento='exelente';
	}
}
$diaLetra=CifrasEnLetras::convertirNumeroEnLetras(date('d'));
$yearLetra=CifrasEnLetras::convertirNumeroEnLetras(date('Y'));

$mesArreglo=[1 => "enero", 2 => "febrero", 3 => "marzo",
4 =>"abril", 5 => "mayo", 6 => "junio", 7 => "julio", 8 => "agosto",
 9 => "septiembre", 10 => "octubre", 11 => "noviembre", 12 => "diciembre"];

setlocale(LC_TIME, 'es_ES');
$fecha = DateTime::createFromFormat('!m', date('m'));
$mesLetra = strftime("%B", $fecha->getTimestamp());

//$control=CifrasEnLetras::convertirNumeroEnLetras($control);
//$promedio=CifrasEnLetras::convertirNumeroEnLetras($promedio);
 ?>
 <?php if($promedio==false){
 	echo "Este alumno no cumple con los requisitos necesarios";
 } else { ?>
 <?= Markdown::convert($content,['custom' => [
 	'{' => '<U>','}' => '</U>',':nombre' => $nombre,':control' => $control,
 	':carrera' => $carrera, ':rendimiento()' => strtoupper($rendimiento), ':promedio' => $promedio,
 	':dia()' => $diaLetra, ':mes()' => $mesLetra, ':year()' => $yearLetra,
 	':periodo()' => $periodo,
 	':dc' => '<div class="container">', ':dr' => '<div class="row">',
 	':dcm-1' => '<div class="col-md-1">',
 	':dcm-2' => '<div class="col-md-2">', ':dcm-3' => '<div class="col-md-3">',
 	':dcm-6' => '<div class="col-md-6">',
 	':dcm-12' => '<div class="col-md-12">',
 	':dcm-12-tc' => '<div class="col-md-12 text-center">',
 	':pl-3' => '<div class="pull-left col-md-3">', 
 	':pr-1' => '<div class="pull-right col-md-1">',
 	':pr-3' => '<div class="pull-right col-md-3">',
 	':ed' => '</div>',
 	':tb' => '<table style="width:580px" class="center-block">', ':etb' => '</table>',
 	':tr' => '<tr>', ':etr' => '</tr>',
 	':td' => '<td class="text-center">', ':etd' => '</td>',
 	'<p>|' => '<p class="text-justify">',
 	'<p>:sp' => '', ':sp</p>' => '',
 	]])?>

<?php } ?> 	