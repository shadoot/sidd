<?php

namespace app\controllers;

use Yii;
use app\models\FhEntrenador;
use app\models\FhPersona;
use app\models\FhContacto;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntrenadorController implements the CRUD actions for FhEntrenador model.
 */
class EntrenadorController extends Controller
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
     * Lists all FhEntrenador models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FhEntrenador::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FhEntrenador model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $entrenador=FhEntrenador::findOne($id);
        $persona=FhPersona::findOne($entrenador->id_persona);
        $contacto=FhContacto::findOne($persona->id_Persona,'id_Persona');
        //var_dump($entrenador);
        //echo "<br><br><br><br><br>";
        //var_dump($persona);
        //echo "<br><br><br><br><br>";
        //var_dump($contacto);

        return $this->render('view', [
            'entrenador' => $entrenador,
            'persona' => $persona,
            'contacto' => $contacto,
        ]);
    }

    /**
     * Creates a new FhEntrenador,FhPersona and FhContacto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $entrenador = new FhEntrenador();
        $persona = new FhPersona();
        $contacto = new FhContacto();


        if ($persona->load(Yii::$app->request->post()) && $contacto->load(Yii::$app->request->post())) {
            
            if ($persona->save()) {
                $contacto->id_Persona=$persona->id_Persona;
                if($contacto->save()){
                    $entrenador->id_persona=$persona->id_Persona;
                    if ($entrenador->save()) {
                        return $this->redirect(['view', 'id' => $entrenador->id_entrenador]);
                    }
                }
            }
            
            
        }

        return $this->render('create', [
            'entrenador' => $entrenador,
            'persona' => $persona,
            'contacto' => $contacto,
        ]);
    }

    /**
     * Updates an existing FhEntrenador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_entrenador]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FhEntrenador model.
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
     * Finds the FhEntrenador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FhEntrenador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FhEntrenador::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
