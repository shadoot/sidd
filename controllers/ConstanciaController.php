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
    	}
    	
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

    	//var_dump($articulo);
        /*    return $this->render('constancia',[
                'constanciaContent' => $constanciaContent,
                'datos' => $row,
            ]);*/
    	$return = $this->renderPartial('constancia',[
    		'constanciaContent' =>$constanciaContent,
    		'datos' => $row,
    	]); 
    	$pdf = new Pdf([
	        'mode' => Pdf::MODE_CORE, 
	        'format' => Pdf::FORMAT_A4, 
	        'orientation' => Pdf::ORIENT_PORTRAIT, 
	        'destination' => Pdf::DEST_BROWSER, 
	        'content' => $return,  
	        'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
	        //'cssInline' => '.kv-heading-1{font-size:18px}',
            'cssInline' => "body {font-family: 'monserrat',font-size:14px, serif;}", 
	        'options' => ['title' => 'Constancia de actividades deportivas y culturales'],
	        /*'methods' => [ 
	            'SetHeader'=>['header'],
	            'SetFooter' => ['2017, "Un siglo de las constituciones"'],
        	]*/
    	]);
    	return $pdf->render(); 
    }

    public function actionCrear(){
    	$model = new FaConstancia();
    	if($model->load(Yii::$app->request->post()) && $model->save()){
    		return $this->redirect(['gestionar']);
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
    	if($model->load(Yii::$app->request->post()) && $model->save()){
    		return $this->redirect(['gestionar']);
    	}
    	return $this->render('crear',[
    		'model' => $model,
    	]);
    }
}

 ?>