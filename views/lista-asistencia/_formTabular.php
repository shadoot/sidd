<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\builder\TabularForm;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\FaListaAsistencia */
/* @var $form yii\widgets\ActiveForm */

?>


<div class="fa-lista-asistencia-form">

    <?php $form = ActiveForm::begin(); ?>

<?php 

    //var_dump($dataProvider->getModels());
    
    $attr=[
                'nombre' => ['type' => TabularForm::INPUT_STATIC, 'columnOptions'=>['hAlign'=>GridView::ALIGN_CENTER]],
                
            ];
    //var_dump($attr);
    $attr;
    $month=date("n");
    $year=date("Y");
    $diaActual=date("j");

    $diaSemana=date("w",mktime(0,0,0,$month,1,$year));
    $ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
    echo $diaSemana.'<br>';
    echo $ultimoDiaMes.'<br>';
    $diaNombre='';
    $diaPrint=0;
    $star=0;
    switch ($diaSemana) {
        case '0':
                //domingo
                break;
            case '1':
                //lunes
                break;
            case '2':
                //martes
                break;
            case '3':
                //miercoles
                break;
            case '4':
                //jueves
                break;
            case '5':
                //viernes
                break;
            case '6':
                //sabado
            $star=2;
                break;
            
            default:
                # code...
                break;
    }
    $star=1;
    $diaPrint=6;
    for ($i=$star; $i <= $ultimoDiaMes; $i++) { 
        switch ($diaPrint) {
            case '0':
                //domingo
            $diaNombre='Domingo';
                break;
            case '1':
                //lunes
            $diaNombre='Lunes';
                break;
            case '2':
                //martes
            $diaNombre='Martes';
                break;
            case '3':
                //miercoles
            $diaNombre='Miercoles';
                break;
            case '4':
                //jueves
            $diaNombre='Jueves';
                break;
            case '5':
                //viernes
            $diaNombre='Viernes';
                break;
            case '6':
                //sabado
            $diaNombre='Sabado';
                break;
            
            default:
                # code...
                break;
        }
        //echo $diaNombre.'<br>';
        if($diaNombre!=''){
            $attr[]=[
                'label' => $diaNombre.' '.$i.' Dic',
                'type' =>  TabularForm::INPUT_CHECKBOX,
                'columnOptions' => ['hAlign'=>GridView::ALIGN_CENTER],
            ];
        }
        $diaPrint++;
        $diaNombre='';
        //echo $diaPrint."<br>";
        if($diaPrint>6){
            $diaPrint=0;
        }
    }
    
        //$attr[]=[$key=>['type' => TabularForm::INPUT_CHECKBOX]];
        /*foreach ($models[0] as $key => $value) {
            $attr[][]=[[$key=>['type' => TabularForm::INPUT_CHECKBOX]]];
            echo $key;
        }*/
      //  echo "<br><br><br><br><br><br><br><br><br>";
    //var_dump($attr);


    $createUrl='/create';
    $deleteUrl='/delete';
        echo TabularForm::widget([
            'form' => $form,
            'dataProvider' => $dataProvider,
            /*'attributes' => [
                'nombre' => ['type' => TabularForm::INPUT_STATIC, 'columnOptions'=>['hAlign'=>GridView::ALIGN_CENTER]],
                'name' => ['type' => TabularForm::INPUT_CHECKBOX, 'columnOptions'=>['hAlign'=>GridView::ALIGN_CENTER]],
            ],*/
            'attributes' => $attr,
            'gridSettings' => [
                //'floatHeader' => true,
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="fas fa-book"></i> Registro de Asistencia</h3>',
                    'type' => GridView::TYPE_PRIMARY,
                    'after'=> 
                        Html::a(
                            '<i class="fas fa-plus"></i> Add New', 
                            $createUrl, 
                            ['class'=>'btn btn-success']
                        ) . '&nbsp;' . 
                        Html::a(
                            '<i class="fas fa-times"></i> Delete', 
                            $deleteUrl, 
                            ['class'=>'btn btn-danger']
                        ) . '&nbsp;' .
                        Html::submitButton(
                            '<i class="fas fa-save"></i> Guardar', 
                            ['class'=>'btn btn-success']
                        )
                ]
            ]     
        ]); 
     ?>

     <div class="form-group">
        <?php Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>      