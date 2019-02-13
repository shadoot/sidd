<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrestamoController implements the CRUD actions for FiPrestamo model.
 */
class ReporteController extends Controller
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

    public function actionIndex()
    {
        $temporal = new \yii\base\DynamicModel([
            'id_periodo',
            'tipo_visualizacion',
            'tipo_indice'
        ]);
        $temporal->addRule(
            ['id_periodo','tipo_visualizacion','tipo_indice'],'required');
        if(Yii::$app->request->post()){
            $temporal->load(Yii::$app->request->post());
            if ($temporal->tipo_visualizacion=='1') {
                return $this->redirect(['indice', 'id_periodo' => $temporal->id_periodo]);
            }else{
                return $this->redirect(['indicecarrera', 'id_periodo' => $temporal->id_periodo]);
            }
        }
        return $this->render('index', [
            'temporal'=> $temporal,
        ]);
    }

    public function actionIndice($id_periodo){
        $query = (new \yii\db\Query())
        ->select(['p.Periodo','p.Año',"COUNT(IF(r.puntuacion >= 70, 'a', NULL)) AS 'aprovado'",
            "COUNT(IF(r.puntuacion < 70, 'r', NULL)) AS 'reprobado'"])
        ->from('fa_rendimiento r')
        ->innerjoin('fa_lista_registro_alumno lra','lra.id_lista_registro = r.id_lista_registro_alumno')
        ->innerjoin('fa_lista_registro_actividad_deportiva lrad','lrad.id_lista_registro_actividad_deportiva = lra.id_lista_registro_actividad_deportiva')
        ->innerjoin('fa_periodo p','p.id_Periodo = lrad.id_periodo')
        ->where('p.id_Periodo = :periodo');
        $query->addParams([':periodo' => $id_periodo]);
        $command = $query->createCommand();
        $row = $command->queryAll();

        return $this->render('indice',[
            'periodo' => $row[0]['Periodo'],
            'year' => $row[0]['Año'],
            'aprovado' => $row[0]['aprovado'],
            'reprobado' => $row[0]['reprobado'],
        ]);
    }

    public function actionIndicecarrera($id_periodo){
        $queryListaCarreras= (new \yii\db\Query)
        ->select(['id_Carrera'])
        ->from('fa_carrera');
        $commandCarreras = $queryListaCarreras->createCommand();
        $carreras = $commandCarreras->queryAll();

        $ListaCarreras=[];
        $DatosAprovados=[];
        $DatosReprovados=[];
        $periodo=null;
        foreach ($carreras as $key => $key_id_carrera) {
            foreach ($key_id_carrera as $key => $id_carrera) {
                $query = (new \yii\db\Query())
                ->select(["(c.Nombre) as 'Carrera'", 'p.Periodo', 'p.Año', 
                    "COUNT(IF(r.puntuacion >= 70, 'a', NULL)) AS 'aprovado'",
                    "COUNT(IF(r.puntuacion < 70, 'r', NULL)) AS 'reprobado'"])
                ->from('fa_rendimiento r')
                ->innerjoin('fa_lista_registro_alumno lra','lra.id_lista_registro = r.id_lista_registro_alumno')
                ->innerjoin('fa_lista_registro_actividad_deportiva lrad','lrad.id_lista_registro_actividad_deportiva = lra.id_lista_registro_actividad_deportiva')
                ->innerjoin('fh_alumno a','a.id_Alumno = lra.id_Alumno')
                ->innerjoin('fa_carrera c','c.id_Carrera = a.id_Carrera')
                ->innerjoin('fa_periodo p','p.id_Periodo = lrad.id_periodo')
                ->where('p.id_Periodo = :periodo')
                ->andWhere('c.id_Carrera = :id_carrera');
                $query->addParams([
                    ':periodo' => $id_periodo, 
                    ':id_carrera' => $id_carrera,
                ]);
                $command = $query->createCommand();
                $row = $command->queryAll();
                $ListaCarreras[]=$row[0]['Carrera'];
                $DatosAprovados[]=$row[0]['aprovado'];
                $DatosReprovados[]=$row[0]['reprobado'];
                if (is_null($periodo)) {
                    $periodo=$row[0]['Periodo'].' '.$row[0]['Año'];
                }
            }
        }
        
        return $this->render('indicecarrera',[
            'periodo' => $periodo,
            'ListaCarreras' => $ListaCarreras,
            'DatosAprovados' => $DatosAprovados,
            'DatosReprovados' => $DatosReprovados,
        ]);
    }
}