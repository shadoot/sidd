<?php

namespace app\controllers;

use Yii;
use app\models\FaRendimiento;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\RendimientoSearch;
use yii\base\Model;

/**
 * RendimientoController implements the CRUD actions for FaRendimiento model.
 */
class RendimientoController extends Controller
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
     * Lists all FaRendimiento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $sql="SELECT 
                    lrad.id_lista_registro_actividad_deportiva,
                    d.nombre AS 'Nombre de la actividad',
                    d.rama,
                    per.Periodo,
                    per.Año,
                    COUNT(r.id_lista_registro_alumno) AS 'Alumnos calificados',
                    COUNT(d.nombre) AS 'Cantidad total'
                FROM
                    fa_lista_registro_alumno ra
                        INNER JOIN
                    fa_lista_registro_actividad_deportiva lrad ON lrad.id_lista_registro_actividad_deportiva = ra.id_lista_registro_actividad_deportiva
                        INNER JOIN
                    fa_actividad_deportiva d ON lrad.id_actividad_deportiva = d.id_actividad_deportiva
                        INNER JOIN
                    fa_periodo per ON per.id_Periodo = lrad.id_periodo
                        LEFT JOIN
                    fa_rendimiento r ON r.id_lista_registro_alumno = ra.id_lista_registro
                WHERE
                    lrad.en_curso = 1
                GROUP BY d.nombre , per.Periodo , per.Año";

        $provider=new SqlDataProvider([
            'sql'=>$sql,
            'key' => 'id_lista_registro_actividad_deportiva',
        ]);

        return $this->render('index', [
            'dataProvider' => $provider,
        ]);
    }

    /**
     * Displays a single FaRendimiento model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'models' => $this->findModelAll($id),
        ]);
    }

    /**
     * Creates a new FaRendimiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FaRendimiento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_rendimiento]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FaRendimiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_rendimiento]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FaRendimiento model.
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

    public function actionEdit($id)
    {
        $query = (new \yii\db\Query())
        ->select(['lra.id_lista_registro','a.Num_Control',"CONCAT(p.Ap_Paterno,' ',p.Ap_Materno,' ', p.Nombre) AS 'Nombre del alumno'",'puntuacion','id_rendimiento'])
        ->from('fa_lista_registro_alumno lra')
        ->innerjoin('fa_lista_registro_actividad_deportiva lrad','lrad.id_lista_registro_actividad_deportiva = lra.id_lista_registro_actividad_deportiva')
        ->innerjoin('fh_alumno a','lra.id_Alumno = a.id_Alumno')
        ->innerjoin('fh_persona p','p.id_Persona = a.id_Persona')
        ->leftjoin('fa_rendimiento r','r.id_lista_registro_alumno = lra.id_lista_registro')
        ->where('lrad.id_lista_registro_actividad_deportiva=:id');
        $query->orderBy([
            'p.Ap_Paterno' => SORT_ASC,
            'p.Ap_Materno' => SORT_ASC,
            'p.Nombre' => SORT_ASC,
        ]);

        $command = $query->createCommand();

        $provider=new SqlDataProvider([
            'sql'=>$command->sql,
            'params' => [':id' => $id],
        ]);

        if(Yii::$app->request->post()){
            /*$queryRendimiento = (new \yii\db\Query())
            ->select(['lrad.id_lista_registro_actividad_deportiva','puntuacion'])
            ->from('fa_lista_registro_alumno lra')
            ->innerjoin('fa_lista_registro_actividad_deportiva lrad','lrad.id_lista_registro_actividad_deportiva = lra.id_lista_registro_actividad_deportiva')
            ->innerjoin('fh_alumno a','lra.id_Alumno = a.id_Alumno')
            ->innerjoin('fh_persona p','p.id_Persona = a.id_Persona')
            ->leftjoin('fa_rendimiento r','r.id_lista_registro_alumno = lra.id_lista_registro')
            ->where('lrad.id_lista_registro_actividad_deportiva=:id');
            $commandRendimiento = $queryRendimiento->createCommand();*/
            $sourceModel = new RendimientoSearch;
            $dataProvider = $sourceModel->searchSqlProvider(Yii::$app->request->getQueryParams()['id']);
            $models = $dataProvider->getModels();
            //$models=FaRendimiento::findBySql($commandRendimiento->sql,[':id' => $id])->all();
            //var_dump($_POST['kvTabForm']);
            $datos=$_POST['kvTabForm'];
            //var_dump(FaRendimiento::find($id)->all());
            //print_r($models);
            //exit();
            //if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {
                
            $count = 0;
            foreach ($datos as $datoModelo) {
                // populate and save records for each model
                //print_r($datoModelo);

                $model=new FaRendimiento();
                if($datoModelo['id_rendimiento']!==''){
                    $model=FaRendimiento::findOne($datoModelo['id_rendimiento']);
                }
                //$model->id_rendimiento=$datoModelo['id_rendimiento'];
                
                $model->id_lista_registro_alumno=$datoModelo['id_lista_registro'];
                if($model->puntuacion!=$datoModelo['puntuacion']){
                    $model->puntuacion=$datoModelo['puntuacion'];
                    if ($model->save()) {
                        $count++;
                    }
                }
                
            }
            Yii::$app->session->setFlash('success', "Se han registrado {$count}.");
            //    return $this->redirect(['index']); // redirect to your next desired page
            //    exit();
            
        }

        return $this->render('edit',[
            'provider' => $provider,
        ]);

    }
    /**
     * Finds the FaRendimiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaRendimiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FaRendimiento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBatchUpdate()
    {
        
    }
}
