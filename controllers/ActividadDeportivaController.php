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
        /*$entrenador = new FhEntrenador();
        $persona = new FhPersona();

        $personaTemporal = new \yii\base\DynamicModel([
            'id_temporal',
            'nombre',
        ]);
        $personaTemporal->addRule(['nombre'], 'required')
            ->addRule(['id_temporal'],'integer')
            ->addRule('nombre', 'string',['max'=>107]);
        //if($personaTemporal->hasErrors()){ validation fails  }else{ validation succeeds}


        if ($personaTemporal->load(Yii::$app->request->post())) {
                $persona = FhPersona::findOne($personaTemporal->id_temporal);
                $entrenador=FhEntrenador::findOne(
                    FhEntrenador::getIdEntrenador($persona->id_Persona));
                //var_dump($entrenador);
                //echo "<br><br><br>";
                //exit();
                if ($actividad->load(Yii::$app->request->post())) {
                    $actividad->id_entrenador=$entrenador->id_entrenador;
                    //var_dump($actividad->id_entrenador);
                    //exit();
                    if($actividad->save()){
                        return $this->redirect(['view', 'id' => $actividad->id_actividad_deportiva]);
                    }
                }
                
            }    

        if (isset($id_entrenador)) {
            $entrenador=FhEntrenador::findOne($id_entrenador);
            //$persona=$entrenador->getPersona();
            $persona=FhPersona::findOne($entrenador->id_persona);
            
            $personaTemporal->nombre=$persona->Nombre.' '.$persona->Ap_Pataterno.
                ' '.$persona->Ap_Materno;
            $personaTemporal->id_temporal=$persona->id_Persona;    
        }*/

        if ($actividad->load(Yii::$app->request->post()) && $actividad->save() ) {
            return $this->redirect(['view', 'id' => $actividad->id_actividad_deportiva]);
        }

        return $this->render('create', [
            'actividad' => $actividad,
            /*'entrenador' => $entrenador,
            'persona' => $persona,
            'personaTemporal' => $personaTemporal,*/
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
    {   
        try {

            $this->findModel($id)->delete();
            
        } catch (IntegrityException $e) {
            Yii::warning("Violación de la restricción de integridad: 1451 No se puede eliminar ni actualizar una fila principal: una restricción de clave externa falla.");
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
