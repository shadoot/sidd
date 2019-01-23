<?php

namespace app\controllers;

use Yii;
use app\models\FaActividadDeportiva;
use app\models\FhEntrenador;
use app\models\FhPersona;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\ErrorException;
use yii\db\IntegrityException;

/**
 * ActividadDeportivaController implements the CRUD actions for FaActividadDeportiva model.
 */
class ActividadDeportivaController extends Controller
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
     * Lists all FaActividadDeportiva models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FaActividadDeportiva::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FaActividadDeportiva model.
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
     * Creates a new FaActividadDeportiva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(/*$id_entrenador=null*/)
    {
        $actividad = new FaActividadDeportiva();

        if ($actividad->load(Yii::$app->request->post()) && $actividad->save() ) {
            return $this->redirect(['view', 'id' => $actividad->id_actividad_deportiva]);
        }

        return $this->render('create', [
            'actividad' => $actividad,
        ]);
    }

    /**
     * Updates an existing FaActividadDeportiva model actividad.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the actividad cannot be found
     */
    public function actionUpdate($id)
    {
        $actividad = $this->findModel($id);

        if ($actividad->load(Yii::$app->request->post()) && $actividad->save()) {
            return $this->redirect(['view', 'id' => $actividad->id_actividad_deportiva]);
        }

        return $this->render('update', [
            'actividad' => $actividad,
        ]);
    }

    /**
     * Deletes an existing FaActividadDeportiva model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   $session = Yii::$app->session;
        try {

            $this->findModel($id)->delete();
            $session->addFlash('success','Elemento eliminado');
        } catch (IntegrityException $e) {
            
            $error="1451 No se puede eliminar el elemento porque esta relacionado con otra tabla";
            $session->addFlash('error', $error);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the FaActividadDeportiva model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaActividadDeportiva the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FaActividadDeportiva::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
