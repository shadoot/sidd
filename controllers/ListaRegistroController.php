<?php

namespace app\controllers;

use Yii;
use app\models\FaListaRegistro;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FhAlumno;

/**
 * ListaRegistroController implements the CRUD actions for FaListaRegistro model.
 */
class ListaRegistroController extends Controller
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
     * Lists all FaListaRegistro models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$dataProvider = new ActiveDataProvider([
            'query' => FaListaRegistro::find()->getAlumno(),
        ]);*/
        /*$sql1="SELECT d.nombre, fecha_registro,Num_Control, CONCAT(p.Nombre,' ', p.Ap_Pataterno,' ', p.Ap_Materno) FROM fa_lista_registro r, fa_actividad_deportiva d, fh_alumno a, fh_persona p WHERE r.id_actividad_deportiva=d.id_actividad_deportiva AND r.id_Alumno=a.id_Alumno AND a.id_Persona=p.id_Persona;";
        $provider=new SqlDataProvider([
            'sql'=>$sql1,
        ]);*/

        $sql1="SELECT r.id_lista_registro, d.nombre, r.fecha_registro,a.Num_Control as 'Número de Control', CONCAT(p.Nombre,' ', p.Ap_Pataterno,' ',p.Ap_Materno) as Alumno FROM fa_lista_registro r, fa_actividad_deportiva d, fh_persona p, fh_alumno a WHERE a.id_Persona=p.id_Persona AND r.id_Alumno=a.id_Alumno AND r.id_actividad_deportiva = d.id_actividad_deportiva";
        $provider=new SqlDataProvider([
            'sql'=>$sql1,
            'key' => 'id_lista_registro',
        ]);

        return $this->render('index', [
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single FaListaRegistro model.
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
     * Creates a new FaListaRegistro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FaListaRegistro();
        if ($model->load(Yii::$app->request->post())) {
            $query = (new \yii\db\Query())
                ->select('id_Alumno')
                ->from('fh_alumno')
                ->where('Num_Control=:Num_Control');
            $query->addParams([':Num_Control' => $model->id_Alumno]);
            $command = $query->createCommand();
            $row = $command->queryAll();
            $model->id_Alumno=$row[0]['id_Alumno'];
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id_lista_registro]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FaListaRegistro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_lista_registro]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FaListaRegistro model.
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
     * Finds the FaListaRegistro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaListaRegistro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FaListaRegistro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
