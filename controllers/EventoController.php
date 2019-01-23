<?php

namespace app\controllers;

use Yii;
use app\models\FaEvento;
use app\models\FaEventoAnexo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\base\ErrorException;
use yii\data\ArrayDataProvider;
use kartik\mpdf\Pdf;
use yii\data\SqlDataProvider;

/**
 * EventoController implements the CRUD actions for FaEvento model.
 */
class EventoController extends Controller
{
    public static $defaultColor='#337ab7';
    public static $imagenColor='#8976ea';
    public static $advertenciaColor='#ff0303d9';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FaEvento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FaEvento::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FaEvento model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FaEvento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($date=null)
    {
        $model = new FaEvento();
        if (isset($date)) {
            
            $model = $this->findModels($date);
            $count=sizeof($model);
            if($count>0){
                if($count==1){
                    return $this->renderAjax('view', [
                        'model' => $model[0],
                    ]);
                }else{
                    $dataProvider = new ActiveDataProvider([
                        'query' => FaEvento::find()->where('Fecha=:fecha')
                            ->addParams([':fecha' => $date]),
                    ]);
                    return $this->renderAjax('index', [
                        'dataProvider' => $dataProvider,
                    ]);
                }
            }else{
                $model = new FaEvento();
            }
            $model->Fecha=$date;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //var_dump($model->Hr_Evento);
            //exit();
            return $this->redirect(['calendar']);
        }
        if (isset($date)) {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FaEvento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_Evento]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FaEvento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FaEvento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaEvento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FaEvento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModels($fecha){
        /*$query = (new \yii\db\Query())
            ->select('id_Evento')
            ->from('fa_evento')
            ->where('Fecha=:fecha');
        $query->addParams([':fecha' => $fecha]);
        $command = $query->createCommand();
        $row = $command->queryAll();*/
        $model = FaEvento::find()->where('Fecha=:fecha')
        ->addParams([':fecha' => $fecha])->all();
        return $model;
    }

    public function actionCalendar(){
        date_default_timezone_set('America/Mexico_City');
        //$lista_eventos=FaEvento::find()->all();
        $lista_eventos = FaEvento::getEventos();
        $eventos;
        $hoy=date("Y-m-d"); //$hoy=date("Y-m-d_G:i:s");
        
        foreach ($lista_eventos as $evento) {
            $event=new \yii2fullcalendar\models\Event();
            $event->id=$evento['id_Evento'];
            $event->title=$evento['Nombre'];
            $event->start=$evento['Fecha'];
            $dataExtra=' "data-id="'.$evento['id_Evento'].'"';
            $event->className=$dataExtra;
            
            if(!is_null($evento['id_evento_anexo'])){
                $event->color=EventoController::$imagenColor;
                $event->className=$dataExtra.' data-titulo="Visualizar contenido"';
            }else{
                $event->color=EventoController::$defaultColor;
                $event->className=$dataExtra.' data-titulo="Agregar Anexo"';
            }
            if ($evento['Fecha']==$hoy) {
                $event->color=EventoController::$advertenciaColor;
            }

            
            //$event->url='index.php?r=evento/'.$evento->id_Evento;
            $eventos[]=$event;
            /*$Event = new \yii2fullcalendar\models\Event();
            $Event->id = 1;
            $Event->title = 'Testing';
            $Event->start = date('Y-m-d\Th:m:s\Z');
            $eventos[] = $Event;*/
        }
        return $this->render('calendar',['eventos'=>$eventos]);
    }

    public function actionAnexo($id=null,$id_anexo=null,$n=null)
    {
        //print_r($n);
        //exit();
        if(isset($id) && !isset($n) || $n=='r'){
            $model = FaEventoAnexo::findAll(['id_evento' => $id]);
            if(sizeof($model)>0){
                if(sizeof($model)==1){
                    return $this->renderAjax('image_view', [
                        'model' => $model,
                    ]);
                }else{
                    $provider = new ArrayDataProvider([
                        'allModels' => $model,
                        'pagination' => [
                            'pageSize' => 10,
                        ],
                    ]);
                    return $this->renderAjax('image_view',[
                        'model' => $provider,
                    ]);
                }
            }
        }

        $model =new FaEventoAnexo();
        

        if (Yii::$app->request->post()) {

            $model->load(Yii::$app->request->post());
            
            $img = UploadedFile::getInstance($model, 'image');
            //echo 'busco archivo por modelo';


            if (isset($id)) {
                $model->id_evento=$id;
            }
            
                
            if (!is_null($img)) {
                
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/img/evento/';
                $path = Yii::$app->params['uploadPath'] . $img->name;
                if(file_exists($path)){

                    if(md5_file($path)!=md5_file($img->tempName)){
                        while(file_exists($path)) {
                            //echo 'MD5 file hash of ' . $img->name . ' : ' . md5_file($path).' ';
                            //echo 'MD5 temp file hash of ' . $img->name . ' : ' . md5_file($img->tempName).' ';
                            $temp=$img->name;
                            $img->name=Yii::$app->security->generateRandomString().'--'.$temp;
                            $path=Yii::$app->params['uploadPath']. $img->name;
                        }
                    }
                }

                $img->saveAs($path);
                $model->imagen=$img->name;
                
                if ($model->save()) {
                    
                    if(isset($n) && $n=='a'){
                            $model = FaEventoAnexo::findAll(['id_evento' => $id]);
                            if(sizeof($model)>0){
                                if(sizeof($model)==1){
                                    return $this->renderAjax('image_view', [
                                        'model' => $model,
                                    ]);
                                }else{
                                    $provider = new ArrayDataProvider([
                                        'allModels' => $model,
                                        'pagination' => [
                                            'pageSize' => 10,
                                        ],
                                    ]);
                                    return $this->renderAjax('image_view',[
                                        'model' => $provider,
                                    ]);
                            }
                        }
                    }else{
                        return $this->redirect(['calendar']);    
                    }
                    
                }
            }
            //echo "imagen es nula";
            //exit();
        }
        if (isset($id) && Yii::$app->request->isAjax) {
            //echo "entra en la validacion ajax";
            
            //exit();
            return $this->renderAjax('_anexo', [
                'model' => $model,
                'n' => (isset($n)) ? $id : null,
            ]);
        }
        return $this->render('_anexo',['model' => $model]);
    }

    public function actionReporte(){

        /*$query = (new \yii\db\Query())
            ->select(['a.id_Evento', 'Nombre', 'Fecha', 'Lugar', 'e.Descripcion as "descripcion_evento"', 'Hr_Evento', 'id_evento_anexo', 'imagen', 'a.descripcion as "descripcion_anexo"'])
            ->from('fa_evento e')
            ->innerjoin('fa_evento_anexo a','e.id_Evento=a.id_evento')
            ->where(['between','e.Fecha', ':f1',':f2']);

        //$query->addParams([':f1' => '2018-11-01',':f2' => '2018-11-31']);
            
        $command = $query->createCommand();*/

        $count = Yii::$app->db->createCommand('
            SELECT count(e.id_Evento) from fa_evento e inner join fa_evento_anexo a on e.id_Evento=a.id_evento where Fecha between ":f1" and ":f2"',
                 [':f1' => '2018-11-01', ':f2' => '2018-11-31'])->queryScalar();

        $provider=new SqlDataProvider([
            'sql' => "select a.id_Evento, Nombre, Fecha, Lugar, e.Descripcion as 'descripcion_evento', Hr_Evento, id_evento_anexo, imagen, a.descripcion as 'descripcion_anexo'from fa_evento e inner join fa_evento_anexo a on e.id_Evento=a.id_evento where e.Fecha between :f1 and :f2",
            //'totalCount' => $count,
            'params' => [':f1' => '2018-08-01',':f2' => '2018-12-31'],
            'key' => 'id_Evento',
            'pagination' => [
                'pageSize' => $count,
            ],
        ]);


        $content = $this->renderPartial('reporte',['provider' => $provider]);
        //return $this->render('reporte',['provider' => $provider]);
        $pdf = new Pdf([
            
            'mode' => Pdf::MODE_CORE, 
            
            'format' => Pdf::FORMAT_A4, 
            
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            
            'destination' => Pdf::DEST_BROWSER, 
            
            'content' => $content,  
            
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',

            'cssInline' => '.kv-heading-1{font-size:18px}', 

            'options' => ['title' => 'Constancia de actividades deportivas y culturales'],
            
            /*'methods' => [ 
                'SetHeader'=>['header'],
                'SetFooter' => ['2017, "Un siglo de las constituciones"'],
            ]*/
        ]);



        return $pdf->render();
        //return $content;
    }
}