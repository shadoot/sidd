<?php

namespace app\controllers;

use Yii;
use app\models\FaListaRegistroActividadDeportiva;
use app\models\FhEntrenador;
use app\models\FaActividadDeportiva;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ListaRegistroActividadDeportivaController implements the CRUD actions for FaListaRegistroActividadDeportiva model.
 */
class ListaRegistroActividadDeportivaController extends Controller
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
     * Lists all FaListaRegistroActividadDeportiva models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FaListaRegistroActividadDeportiva::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FaListaRegistroActividadDeportiva model.
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
     * Creates a new FaListaRegistroActividadDeportiva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $rad = new FaListaRegistroActividadDeportiva();
        $entrenador = new FhEntrenador();
        $actividad = new FaActividadDeportiva();

        $personaTemporal = new \yii\base\DynamicModel([
            'id_temporal',
            'nombre',
        ]);
        $personaTemporal->addRule(['nombre'], 'required')
            ->addRule(['id_temporal'],'integer')
            ->addRule('nombre', 'string',['max'=>107]);
        //if($personaTemporal->hasErrors()){ validation fails  }else{ validation succeeds}
        if ($personaTemporal->load(Yii::$app->request->post())) {
            //$personaTemporal->load(Yii::$app->request->post());
            $entrenador = FhEntrenador::findOne($personaTemporal->id_temporal);
            if ($rad->load(Yii::$app->request->post())) {
                $rad->id_entrenador = $entrenador->id_entrenador;
                if ($rad->save()) {
                    return $this->redirect(['view', 'id' => $rad->id_lista_registro_actividad_deportiva]);
                }
            }
        }

        /*if ($rad->load(Yii::$app->request->post()) && $rad->save()) {
            return $this->redirect(['view', 'id' => $rad->id_lista_registro_actividad_deportiva]);
        }*/

        return $this->render('create', [
            'rad' => $rad,
            'entrenador' => $entrenador,
            'actividad' => $actividad,
            'personaTemporal' => $personaTemporal,
        ]);
    }

    /**
     * Updates an existing FaListaRegistroActividadDeportiva model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $rad = new FaListaRegistroActividadDeportiva();
        $entrenador = new FhEntrenador();
        $actividad = new FaActividadDeportiva();

        $rad=FaListaRegistroActividadDeportiva::findOne($id);
        $entrenador=FhEntrenador::findOne($rad->id_entrenador);
        $actividad=FaActividadDeportiva::findOne($rad->id_actividad_deportiva);
         
        $personaTemporal = new \yii\base\DynamicModel([
            'id_temporal',
            'nombre',
        ]);
        $personaTemporal->addRule(['nombre'], 'required')
            ->addRule(['id_temporal'],'integer')
            ->addRule('nombre', 'string',['max'=>107]);
            
        $personaTemporal->load(Yii::$app->request->post());    
        if ($personaTemporal->nombre==null && is_object($entrenador)) {
                $personaTemporal->nombre=
                FhEntrenador::getNombreCompleto($entrenador->id_entrenador);
                $personaTemporal->id_temporal=$entrenador->id_entrenador;
                
           }   
        //if($personaTemporal->hasErrors()){ validation fails  }else{ validation succeeds}
        if ($personaTemporal->load(Yii::$app->request->post())) {
            //$personaTemporal->load(Yii::$app->request->post());
            if($entrenador->id_entrenador==null)
            {
                $entrenador = FhEntrenador::findOne($personaTemporal->id_temporal);
            }
            
            if ($rad->load(Yii::$app->request->post())) {
                $rad->id_entrenador = $entrenador->id_entrenador;
                if ($rad->save()) {
                    return $this->redirect(['view', 'id' => $rad->id_lista_registro_actividad_deportiva]);
                }
            }
        }

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_lista_registro_actividad_deportiva]);
        }*/

        return $this->render('update', [
            'rad' => $rad,
            'entrenador' => $entrenador,
            'actividad' => $actividad,
            'personaTemporal' => $personaTemporal,
        ]);
    }

    /**
     * Deletes an existing FaListaRegistroActividadDeportiva model.
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
     * Finds the FaListaRegistroActividadDeportiva model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaListaRegistroActividadDeportiva the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FaListaRegistroActividadDeportiva::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
