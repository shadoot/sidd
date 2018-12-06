<?php

namespace app\controllers;

use Yii;
use app\models\FaListaAsistencia;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ListaAsistenciaController implements the CRUD actions for FaListaAsistencia model.
 */
class ListaAsistenciaController extends Controller
{
    
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
     * Lists all FaListaAsistencia models.
     * @return mixed
     */
    public function actionIndex($id_actividad)
    {

        $query = (new \yii\db\Query())
                ->select(['id_lista_registro',
                    "CONCAT(p.Nombre,' ',p.Ap_Pataterno,' ',p.Ap_Materno) as nombre"])
                ->from('fa_lista_registro_alumno lra')
                ->innerjoin('fa_lista_registro_actividad_deportiva lrad',
                    'lra.id_lista_registro_actividad_deportiva=lrad.id_lista_registro_actividad_deportiva')
                ->innerjoin('fh_alumno a','lra.id_Alumno=a.id_Alumno')
                ->innerjoin('fh_persona p','a.id_Persona=p.id_Persona')
                ->where('lrad.id_lista_registro_actividad_deportiva='.$id_actividad);
        //$query->addParams([':id_lrad' => $id_actividad]); //no blindea los parametros
        $command = $query->createCommand();
            //$row = $command->queryAll();
        //var_dump($command->sql);
        //exit();
        $provider=new SqlDataProvider([
            'sql'=>$command->sql,
            'key' => 'id_lista_registro',
        ]);

        return $this->render('index', [
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single FaListaAsistencia model.
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
     * Creates a new FaListaAsistencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_actividad)
    {
        /*$model = new FaListaAsistencia();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_lista]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);*/
        $query = (new \yii\db\Query())
                ->select(['id_lista_registro',
                    "CONCAT(p.Nombre,' ',p.Ap_Pataterno,' ',p.Ap_Materno) as nombre"])
                ->from('fa_lista_registro_alumno lra')
                ->innerjoin('fa_lista_registro_actividad_deportiva lrad',
                    'lra.id_lista_registro_actividad_deportiva=lrad.id_lista_registro_actividad_deportiva')
                ->innerjoin('fh_alumno a','lra.id_Alumno=a.id_Alumno')
                ->innerjoin('fh_persona p','a.id_Persona=p.id_Persona')
                ->where('lrad.id_lista_registro_actividad_deportiva='.$id_actividad);
        //$query->addParams([':id_lrad' => $id_actividad]); //no blindea los parametros
        $command = $query->createCommand();
            //$row = $command->queryAll();
        //var_dump($command->sql);
        //exit();
        $provider=new SqlDataProvider([
            'sql'=>$command->sql,
            'key' => 'id_lista_registro',
        ]);

        if(Yii::$app->request->post())
        {
            //var_dump($_POST);
            //$params=Yii::$app->request->bodyParams;
            /*foreach ($params as $key => $param) {
                //echo $param."<br>";
                foreach ($param as $key => $value) {
                    echo $key.'<br>';
                }
                
            }*/
            
            //exit();
        }

        return $this->render('create', [
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Updates an existing FaListaAsistencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_lista]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FaListaAsistencia model.
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
     * Finds the FaListaAsistencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaListaAsistencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FaListaAsistencia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
