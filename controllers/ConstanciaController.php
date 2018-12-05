<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;


class ConstanciaController extends Controller
{
	public function actionIndex()
    {
        $content = $this->renderPartial('_constanciaView',[
        	'alumno' => 'Roberto Piñeda José',
        	'carrera' => 'Humanidades',
        	'numero' => '182650051'
        ]);

        $header = $this->renderPartial('_constanciaHeader');

        $pdf = new Pdf([
	        
	        'mode' => Pdf::MODE_CORE, 
	        
	        'format' => Pdf::FORMAT_A4, 
	        
	        'orientation' => Pdf::ORIENT_PORTRAIT, 
	        
	        'destination' => Pdf::DEST_BROWSER, 
	        
	        'content' => $content,  
	        
	        'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
	        
	        'cssInline' => '.kv-heading-1{font-size:18px}', 
	         
	        'options' => ['title' => 'Constancia de actividades deportivas y culturales'],
	        
	        'methods' => [ 
	            'SetHeader'=>['Constancia deportiva'],
	            'SetFooter' => ['2017, "Un siglo de las constituciones"'],
        	]
    	]);

        return $pdf->render(); 
        /*return $this->renderPartial('_constanciaView',[
        	'alumno' => 'Roberto Piñeda José',
        	'carrera' => 'Humanidades',
        	'numero' => '182650051'
        ]);*/
        //return $this->renderPartial('_constanciaHeader');
    }
}

 ?>