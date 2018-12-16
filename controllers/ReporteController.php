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
        $hombres='23';
        $mujeres='60';
        
        return $this->render('index', [
            'hombres' => $hombres,
            'mujeres' => $mujeres
        ]);
    }
}