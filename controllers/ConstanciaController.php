<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;


class ConstanciaController extends Controller
{
	public function actionIndexExt()
    {
        /*$content = $this->renderPartial('_constanciaView',[
        	'alumno' => 'Roberto Piñeda José',
        	'carrera' => 'Humanidades',
        	'numero' => '182650051'
        ]);*/

        $header = $this->renderPartial('_constanciaHeader');
        //return $header;
        $pdf = new Pdf([
	        
	        'mode' => Pdf::MODE_CORE, 
	        
	        'format' => Pdf::FORMAT_A4, 
	        
	        'orientation' => Pdf::ORIENT_PORTRAIT, 
	        
	        'destination' => Pdf::DEST_BROWSER, 
	        
	        //'content' => $content,  
	        
	        //'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
	        'cssFile' => 'css/pdf.css',

	        'cssInline' => '.kv-heading-1{font-size:18px}', 
	        //'cssInline' => 'css/pdf.css',

	        'options' => ['title' => 'Constancia de actividades deportivas y culturales'],
	        
	        /*'methods' => [ 
	            'SetHeader'=>['header'],
	            'SetFooter' => ['2017, "Un siglo de las constituciones"'],
        	]*/
    	]);

    	//$pdf->api->SetHeader($header);
    	//$pdf->api->Cell(0,25,'ALGÚN TÍTULO DE ALGÚN LUGAR',0,0,'C', $pdf->api->Image('img/1280px-SEP_logo_2012.svg.png',20,12,20));
    	/*$header="<html>
		<body>
		    <div>imagen</div>
		    <img src='img/1280px-SEP_logo_2012.svg.png' />
		</body>
		</html>";*/
    	$pdf->api->SetHeader($this->header());
    	$pdf->api->WriteHtml($this->content());
    	//$pdf->api->Output();
        return $pdf->render(); 
        /*return $this->renderPartial('_constanciaView',[
        	'alumno' => 'Roberto Piñeda José',
        	'carrera' => 'Humanidades',
        	'numero' => '182650051'
        ]);*/
        //return $this->renderPartial('_constanciaHeader');
    }

    function header(){
    	return 
    	"<html>
		<body>
		    <div >
		    	<img src='img/1280px-SEP_logo_2012.svg.png' width='300' height='104' align='left'/>
		    </div>
		    <div class='center'>
		    	ANEXO XVI. CONSTANCIA DE CUMPLIMIENTO DE ACTIVIDAD COMPLEMENTARIA	
		    </div>
		    
		</body>
		</html>";
    }
    function content(){
    	return
    		"<html>
			<body>
			<br><br><br><br><br><br>
				<font face='arial'>
			    <div>
			    	<p>
			    		<B>LIC. CLEMENTE DE JESÚS ACHUTEGUI CAMACHO
			    		
			    	<br>
						ENCARGADO DEL DEPARTAMENTO DE  
					<br>						
						SERVICIOS ESCOLARES 
					<br>
						PRESENTE.</B> 
			    	</p>
			    	
			    </div>
			    <div>
			    	
			    	<p ALIGN='justify'>
			    	El que suscribe Ing. Javier Ruiz Aguilar, por este medio se permite hacer de su conocimiento que el estudiante <U> Erick Giovani Lara Moctezuma</U>, con número de control <U>13227055</U> de la carrera de <U>INGENIERÍA INDUSTRIAL</U> ha cumplido su actividad complementaria con el nivel de desempeño _____________ y una valor numérico de _________, durante el período escolar 2013-2016 con un valor curricular de 1 créditos. 
			    	</p>
			    	
			    </div>
			    <div>
			    	<p>
			    		Se extiende la presente en la Ciudad de Rioverde, S.L.P., a los nueve días del mes de abril del año dos mil dieciocho. 
			    	</p>
			    </div>
			    <div>
			    	<p ALIGN='center'>
			    		A T E N T A M E N T E <br> Tecnológicamente Superior
			    	</p>
			    </div>
			    <div style='float:left'>
			    	<p>
			    		ING. JAVIER RUIZ AGUILAR 
			    		<br>ENCARGADO DE LA DIVISIÓN DE
			    		<br> ESTUDIOS PROFESIONALES
			    		<br>____________________________
			    	</p>
			    </div>
			    <div style='float:left'>
			    	<p ALIGN='right'>
			    		LIC. EDUARDO DARIO MATA TORRES 
			    		<br>SUBDIRECTOR ACADÉMICO
			    		<br>____________________________
			    	</p>
			    </div>
			    <div style='clear:both'></div>
			    <div>
			    	<p>
			    		L’EDMT/*dcr
			    	</p>
			    </div>
			    </FONT>
			</body>
		</html>"
    	;
    }

    public function actionIndex()
    {
    	return $this->render('index');
    }
}

 ?>