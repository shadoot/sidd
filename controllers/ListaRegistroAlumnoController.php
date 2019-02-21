<?php

namespace app\controllers;

use Yii;
use app\models\FaListaRegistroAlumno;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FhAlumno;

/**
 * ListaRegistroController implements the CRUD actions for FaListaRegistro model.
 */
class ListaRegistroAlumnoController extends Controller
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
            'query' => FaListaRegistroAlumno::find(),
        ]);*/
        

        $sql1="SELECT 
                ra.id_lista_registro,
                a.Num_Control AS 'Número de Control',
                CONCAT(p.Nombre,
                        ' ',
                        p.Ap_Paterno,
                        ' ',
                        p.Ap_Materno) AS 'Alumno',
                d.nombre AS 'Actividad Extracurricular',
                fp.Periodo AS 'Periodo',
                fp.Año AS 'Año'
            FROM
                fa_lista_registro_alumno ra
                    INNER JOIN
                fh_alumno a ON ra.id_Alumno = a.id_Alumno
                    INNER JOIN
                fh_persona p ON a.id_Persona = p.id_Persona
                    INNER JOIN
                fa_lista_registro_actividad_deportiva rd ON ra.id_lista_registro_actividad_deportiva = rd.id_lista_registro_actividad_deportiva
                    INNER JOIN
                fa_actividad_deportiva d ON rd.id_actividad_deportiva = d.id_actividad_deportiva
                    INNER JOIN
                fa_periodo fp ON fp.id_Periodo = rd.id_periodo";

        $provider=new SqlDataProvider([
            'sql'=>$sql1,
            'key' => 'id_lista_registro',
        ]);

        return $this->render('index', [
            'dataProvider' => $provider,
        ]);
    }

    public function actionIndex2(){
        $query = (new \yii\db\Query())
            ->select(['lrad.id_lista_registro_actividad_deportiva',
                        'd.nombre',
                        'd.rama',
                        'p.Periodo',
                        'p.Año',
                        "COUNT(lra.id_Alumno) as 'Alumnos inscritos'"])
            ->from('fa_lista_registro_alumno lra')
            ->rightjoin('fa_lista_registro_actividad_deportiva lrad','lrad.id_lista_registro_actividad_deportiva = lra.id_lista_registro_actividad_deportiva')
            ->innerjoin('fa_actividad_deportiva d','d.id_actividad_deportiva = lrad.id_actividad_deportiva')
            ->innerjoin('fa_periodo p','p.id_Periodo = lrad.id_periodo')
            ->where('lrad.en_curso = 1')
            ->groupby('lrad.id_actividad_deportiva');
        $command = $query->createCommand();

        $provider=new SqlDataProvider([
            'sql' => $command->sql,
            'key' => 'id_lista_registro_actividad_deportiva',
        ]);
        return $this->render('index2',[
            'provider'=> $provider
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
        $model = new FaListaRegistroAlumno();

        $alumnoTemporal = new \yii\base\DynamicModel([
            'id_alumno_temp',
            'nombre_temp',
            'numero_control',
            'carrera',
        ]);
        $alumnoTemporal->addRule(
            ['nombre_temp','numero_control','carrera'], 'required')
            ->addRule(['id_alumno_temp'],'integer')
            ->addRule('nombre_temp', 'string',['max'=>107]);

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
            'alumnoTemporal' => $alumnoTemporal,
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

        $alumnoTemporal = new \yii\base\DynamicModel([
            'id_alumno_temp',
            'nombre_temp',
            'numero_control',
            'carrera',
        ]);
        $alumnoTemporal->addRule(
            ['nombre_temp','numero_control','carrera'], 'required')
            ->addRule(['id_alumno_temp'],'integer')
            ->addRule('nombre', 'string',['max'=>107]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_lista_registro]);
        }

        return $this->render('update', [
            'model' => $model,
            'alumnoTemporal' => $alumnoTemporal,
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
        if (($model = FaListaRegistroAlumno::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEdit($id)
    {

        return $this->render('edit',[
            'id' => $id,
        ]);
    }
}
