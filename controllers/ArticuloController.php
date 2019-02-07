<?php

namespace app\controllers;

use Yii;
use app\models\FiArticulo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\ErrorHandler;
use yii\helpers\Json;
use yii\helpers\HtmlPurifier;
use kartik\markdown\Markdown;


/**
 * ArticuloController implements the CRUD actions for FiArticulo model.
 */
class ArticuloController extends Controller
{
    //private static $r=null;
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
     * Lists all FiArticulo models.
     * @return mixed
     */
    public function actionIndex()
    {
        //$session = Yii::$app->session;
        //$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
        //$error = $session->getFlash('error');
        /*if ($session->has('error')){
            $error = $session->get('error');
            //var_dump($error);
            //exit();
        }*/


        $dataProvider = new ActiveDataProvider([
            'query' => FiArticulo::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            //'error' => $error,
        ]);
    }

    /**
     * Displays a single FiArticulo model.
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
     * Creates a new FiArticulo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FiArticulo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_articulo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FiArticulo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_articulo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FiArticulo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {  
         
        try{
            $this->findModel($id)->delete();
            
        }catch(yii\db\IntegrityException $e){
            $error="Violación de la restricción de integridad: 1451 No se puede eliminar ni actualizar una fila principal: una restricción de clave externa falla.";
            /*
            //ErrorHandler::handleError(302,$error,__FILE__,__LINE__);
            $dataProvider = new ActiveDataProvider([
            'query' => FiArticulo::find(),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'error' => $error,
            ]);*/
            //global $r;
            //$r=1;
            $session = Yii::$app->session;
            //$session->set('error', $error);
            $session->addFlash('error', $error);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the FiArticulo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FiArticulo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FiArticulo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
}
