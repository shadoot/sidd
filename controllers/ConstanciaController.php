<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;
use app\models\FaConstancia;
use yii\helpers\Json;
use yii\helpers\HtmlPurifier;
use kartik\markdown\Markdown;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;


class ConstanciaController extends Controller
{
    public function actionIndex()
    {
    	$alumnoTemporal = new \yii\base\DynamicModel([
    		'id_alumno',
            'numero_control',
            'nombre',
            'carrera',
        ]);
        $alumnoTemporal->addRule(['nombre','carrera','numero_control'], 'required')
            ->addRule(['numero_control'],'integer')
            ->addRule(['nombre'], 'string',['max'=>107])
            ->addRule(['carrera'],'string');

        if(Yii::$app->request->post()){
        	$alumnoTemporal->load(Yii::$app->request->post());
        	
        	$query = (new \yii\db\Query())
        	->select(["(a.Num_Control) AS 'numero_control'",
        		"CONCAT( p.Ap_Paterno, ' ', p.Ap_Materno, ' ', p.Nombre) AS 'nombre'",
        		"(c.Nombre) AS 'carrera'","AVG(r.puntuacion) AS 'promedio'",
        		"COUNT(lra.id_lista_registro) AS 'actividades'"])
        	->from('fa_lista_registro_alumno lra')
        	->innerjoin('fh_alumno a','lra.id_Alumno = a.id_Alumno')
        	->innerjoin('fa_semestre s','s.id_Semestre = a.id_Semestre')
        	->innerjoin('fh_persona p','p.id_Persona = a.id_Persona')
        	->innerjoin('fa_carrera c','c.id_Carrera = a.id_Carrera')
        	->innerjoin('fa_rendimiento r','r.id_lista_registro_alumno = lra.id_lista_registro')
        	->where('r.puntuacion >= 70')
        	->andWhere('a.Num_Control =:numero');
        	$query->addParams([':numero' => $alumnoTemporal->numero_control]);
	        $command = $query->createCommand();
	        $row = $command->queryAll();
        	//var_dump($row);
	        return $this->render('preview',['datos' => $row]);
        	//exit();
        }
        //$alumnoTemporal->nombre=null;
        //$alumnoTemporal->carrera=null;
    	return $this->render('index',['alumnoTemporal' => $alumnoTemporal]);
    }

    public function actionConstancia($numero){
    	$constanciaContent = FaConstancia::find()
    	->where('activa=1')->one();
    	
    	if (is_null($constanciaContent)) {
    		$session = Yii::$app->session;
            $session->addFlash('error', 'No hay un Formato de constancia activo. Active uno y repita los pasos anteriores');

    		return $this->redirect(['index']);
    	}/*else{
            $file = fopen("fonts/custom_config.php", "w");

            fwrite($file, '$this->fontdata["miss"] = [' . PHP_EOL);
            fwrite($file, "'R' => '../".$constanciaContent->archivo_fuente."'," . PHP_EOL);
            //fwrite($file, "'B' => 'calibrib.ttf'," . PHP_EOL);
            fwrite($file, "];" . PHP_EOL);

            fclose($file);

            #$customFontsConfig = 'css/fonts/custom_config.php';
            #$customFonts = 'css/fonts';
            $customFontsConfig = Yii::$app->params['mpdfCustomFontsPath'];
            $customFonts = Yii::$app->params['mpdfCustomFonts'];

            define("_MPDF_SYSTEM_TTFONTS_CONFIG", $customFontsConfig);
            define("_MPDF_SYSTEM_TTFONTS", $customFonts);
        }*/
    	
    	$query = (new \yii\db\Query())
        	->select(["(a.Num_Control) AS 'numero_control'",
        		"CONCAT( p.Ap_Paterno, ' ', p.Ap_Materno, ' ', p.Nombre) AS 'nombre'",
        		"(c.Nombre) AS 'carrera'","AVG(r.puntuacion) AS 'promedio'"])
        	->from('fa_lista_registro_alumno lra')
        	->innerjoin('fh_alumno a','lra.id_Alumno = a.id_Alumno')
        	->innerjoin('fa_semestre s','s.id_Semestre = a.id_Semestre')
        	->innerjoin('fh_persona p','p.id_Persona = a.id_Persona')
        	->innerjoin('fa_carrera c','c.id_Carrera = a.id_Carrera')
        	->innerjoin('fa_rendimiento r','r.id_lista_registro_alumno = lra.id_lista_registro')
        	->where('r.puntuacion >= 70')
        	->andWhere('a.Num_Control =:numero');
        	$query->addParams([':numero' => $numero]);
	        $command = $query->createCommand();
	        $row = $command->queryAll();

    	//var_dump($constanciaContent);
        //exit();
        /*    return $this->render('constancia',[
                'constanciaContent' => $constanciaContent,
                'datos' => $row,
            ]);*/
    	$return = $this->renderPartial('constancia',[
    		'constanciaContent' =>$constanciaContent,
    		'datos' => $row,
    	]); 
        
    	$pdf = new Pdf([
	        //'mode' => Pdf::MODE_CORE, 
	        'format' => Pdf::FORMAT_A4, 
	        'orientation' => Pdf::ORIENT_PORTRAIT, 
	        'destination' => Pdf::DEST_BROWSER, 
	        'content' => $return,  
	        'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            //'cssFile' => 'css/font.css',
	        'cssInline' => '.kv-heading-1{font-size:18px}',
            //'cssInline' => '<body style="font-family: miss; font-size: 10pt;">',
            /*'cssInline' => "
            @font-face {
                font-family: '".$constanciaContent->nombre_fuente."';
                src: url('../../".$constanciaContent->archivo_fuente."') format('truetype');
                font-weight: normal;
                font-weight: normal;
            }
            body {font-family: '".$constanciaContent->nombre_fuente."',font-size:14px, serif;}",*/
	        'options' => [
                'title' => 'Constancia de actividades deportivas y culturales',
                'fontDir' => ['fonts'],
                'fontdata' => [
                    "'".$constanciaContent->nombre_fuente."'" => [
                        'R' => $constanciaContent->archivo_fuente,
                    ]
                ],
                'default_font' => "'".$constanciaContent->nombre_fuente."'",
            ],
	        /*'methods' => [ 
	            'SetHeader'=>['header'],
	            'SetFooter' => ['2017, "Un siglo de las constituciones"'],
        	] */
    	]);

        /*$pdf->api->fontdata=[
            'miss' => [
                'R' => 'fonts/MissFajardose-Regular.ttf',
            ]
        ];*/
        $pdf->defaultFont='felipa'; 

    	return $pdf->render(); 
    }

    public function actionCrear(){
    	$model = new FaConstancia();
    	if($model->load(Yii::$app->request->post())){

            $font = UploadedFile::getInstance($model, 'archivo_fuente');
            //var_dump($font);
            exit();
            if (!is_null($font)) {
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/fonts/';
                $path = Yii::$app->params['uploadPath'] . $font->name;
                if(file_exists($path)){

                    if(md5_file($path)!=md5_file($font->tempName)){
                        while(file_exists($path)) {
                            $temp=$font->name;
                            $font->name=Yii::$app->security->generateRandomString().'--'.$temp;
                            $path=Yii::$app->params['uploadPath']. $font->name;
                        }
                    }
                }
                $font->saveAs($path);
                $model->archivo_fuente=$font->name;
            }
            if ($model->save()) {
                
                //return $this->redirect(['gestionar']);
            }
    		
    	}
    	return $this->render('crear',[
    		'model' => $model,
    	]);
    }

    public function actionPreview()
    {
        $module = Yii::$app->getModule('markdown');
        /*if (\Yii::$app->user->can('smarty')) {
            $module->smarty = true;
            $module->smartyYiiApp = \Yii::$app->user->can('smartyYiiApp') ? true : false;
            $module->smartyYiiParams = Yii::$app->user->can('smartyYiiParams') ? true : false;
        }*/
        if (isset($_POST['source'])) {
            $output = (strlen($_POST['source']) > 0) ? Markdown::convert($_POST['source'], ['custom' => $module->customConversion]) : $_POST['nullMsg'];
        }
        echo Json::encode(HtmlPurifier::process($output));
    }

    public function actionGestionar(){
    	$dataProvider = new ActiveDataProvider([
            'query' => FaConstancia::find(),
        ]);
        return $this->render('gestionar', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id){
    	$model = FaConstancia::findOne($id);
        $fontSource=null;

        if($model->load(Yii::$app->request->post())){
            $fontSource=Yii::$app->request->post('fontSource');
            //var_dump(Yii::$app->request->post('fontSource'));
            $font = UploadedFile::getInstance($model, 'archivo_fuente');
            //var_dump(is_null($fontSource));
            //var_dump(is_null($font));
            //exit();
            if(!is_null($font)){
                
                
                if (!is_null($font)) {
                    Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/fonts/';
                    $path = Yii::$app->params['uploadPath'] . $font->name;
                    if(file_exists($path)){

                        if(md5_file($path)!=md5_file($font->tempName)){
                            while(file_exists($path) /*&& (md5_file($path)!=md5_file($font->tempName))*/) {
                                $temp=$font->name;
                                $font->name=Yii::$app->security->generateRandomString().'--'.$temp;
                                //$font->name=md5_file($path).'--'.$temp;
                                $path=Yii::$app->params['uploadPath']. $font->name;
                            }
                        }
                    }
                    $font->saveAs($path);
                    $model->archivo_fuente=$font->name;
                }
            }else{
                $model->archivo_fuente=$fontSource;
            }

            if ($model->save()) {
                
                return $this->redirect(['gestionar']);
            }
            
        }
    	
    	return $this->render('crear',[
    		'model' => $model,
    	]);
    }
}

 ?>