<?php

namespace app\controllers;

use Yii;
use app\models\FhEntrenador;
use app\models\FhPersona;
use app\models\FhContacto;
use app\models\EntrenadorSearch;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\ErrorException;
use yii\db\IntegrityException;

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
        /*$searchModel = new EntrenadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = (new \yii\db\Query())
            ->select(['id_entrenador','p.id_Persona',
                "CONCAT(Nombre,' ',Ap_Paterno,' ',Ap_Materno) AS 'Nombre Completo'",
                'Tel_Movil AS Celular','(e_mail) as "Correo Electrónico"',//(-_-) porque lo acepto solo con ()
                'e.estado','t.tipo'])
            ->from('fh_entrenador e')
            ->innerjoin('fh_persona p','e.id_persona = p.id_Persona')
            ->innerjoin('fh_contacto c','p.id_Persona = c.id_Persona')
            ->innerjoin('fh_tipo_entrenador t','t.id_tipo_entrenador = e.id_tipo_entrenador');
        $command = $query->createCommand();

        $provider=new SqlDataProvider([
            'sql' => $command->sql,
            'key' => 'id_entrenador',
        ]);

        return $this->render('index', [
            'provider' => $provider,
            'searchModel' => $searchModel,
        ]);*/
        $searchModel = new EntrenadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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
        $query= (new \yii\db\Query)
        ->select(['e.id_entrenador',"concat(p.Nombre,' ',p.Ap_Paterno,' ',p.Ap_Materno) as 'alumno'",'e.estado','p.Genero','p.FNacimiento','t.tipo',
            'd.nombre','d.rama','per.Periodo','per.Año'])
        ->from('fh_entrenador e')
        ->leftjoin('fh_persona p','p.id_Persona = e.id_persona')
        ->leftjoin('fh_tipo_entrenador t','t.id_tipo_entrenador = e.id_tipo_entrenador')
        ->leftjoin('fa_lista_registro_actividad_deportiva lrad','lrad.id_entrenador = e.id_entrenador')
        ->leftjoin('fa_actividad_deportiva d','d.id_actividad_deportiva = lrad.id_actividad_deportiva')
        ->leftjoin('fa_periodo per','per.id_Periodo = lrad.id_periodo')
        ->where('e.id_entrenador = :id');
        $query->addParams([':id' => $id]);
        $command = $query->createCommand();
        $row = $command->queryAll();
        
        return $this->render('view', [
            'row' => $row
        ]);
    }

    /**
     * Creates a new FhEntrenador,FhPersona and FhContacto models.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($data=null)
    {
        $entrenador = new FhEntrenador();
        $persona = new FhPersona();
        $contacto = new FhContacto();
        
        if ($persona->load(Yii::$app->request->post()) && $contacto->load(Yii::$app->request->post()) && !isset($data)) {
            
            if ($persona->save()) {
                $contacto->id_Persona=$persona->id_Persona;

                if($contacto->save()){
                    $entrenador->load(Yii::$app->request->post());
                    $entrenador->id_persona=$persona->id_Persona;
                    
                    if ($entrenador->save()) {
                        return $this->redirect(['view', 'id' => $entrenador->id_entrenador]);
                    }
                    
                }
            }            
        }

        if (isset($data)) {

            if ($persona->load(Yii::$app->request->post()) && $contacto->load(Yii::$app->request->post())) {
            if ($persona->save()) {
                    $contacto->id_Persona=$persona->id_Persona;
                    if($contacto->save()){
                        $entrenador->load(Yii::$app->request->post());
                        $entrenador->id_persona=$persona->id_Persona;
                        if ($entrenador->save()) {
                            return $this->redirect(
                                [
                                    '/actividad-deportiva/create',
                                    'id_entrenador' => $entrenador->id_entrenador
                                ]);
                        }
                    }
                }                
            }

            return $this->renderAjax('create', [
                'entrenador' => $entrenador,
                'persona' => $persona,
                'contacto' => $contacto,
            ]);
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
        $entrenador=FhEntrenador::findOne($id);
        $persona=FhPersona::findOne($entrenador->id_persona);
        $contacto=FhContacto::findOne(FhContacto::getContacto($persona->id_Persona));

        if ($persona->load(Yii::$app->request->post()) && $contacto->load(Yii::$app->request->post())) {
            if ($persona->save()) {
                $contacto->id_Persona=$persona->id_Persona;
                if($contacto->save()){
                    $entrenador->load(Yii::$app->request->post());
                    $entrenador->id_persona=$persona->id_Persona;
                    if ($entrenador->save()) {
                        return $this->redirect(['view', 'id' => $entrenador->id_entrenador]);
                    }
                }
            }
        }

        return $this->render('update', [
            'entrenador' => $entrenador,
            'persona' => $persona,
            'contacto' => $contacto,
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
        $session = Yii::$app->session;
        try {

            $this->findModel($id)->delete();
            $session->addFlash('success','Elemento eliminado');
        } catch (IntegrityException $e) {
            
            $error="1451 No se puede eliminar el entrenador porque esta vinculado con otra tabla";
            $session->addFlash('error', $error);
        }
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
