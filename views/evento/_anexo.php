<?php 
use yii\widgets\ActiveForm;
//use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;

    $this->registerJsFile(
        '@web/js/contador.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );
?>



<?php

    if(isset($n)){
        $form = ActiveForm::begin(['action' => ['anexo'],
            'options'=>['enctype'=>'multipart/form-data','class' => 'iv-form',
            'id' => 'formulario', 'data-id' => $n,
            /*'onsubmit'=>"return false;"*/]]);
    }else{
        $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);
    }
?>

<?php /* echo $form->field($model, 'imagen')->widget(FileInput::classname(), [
    'options' => ['multiple' => true],
    'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],
    'showUpload' => true
	]
]); */ ?>

<?php 
if(isset($n)){
    //echo "N es real";   
    echo FileInput::widget([
        'model' => $model,
        'attribute' => 'image',
        'options' => ['accept' => 'img/*'],
        'pluginOptions'=>[
            'allowedFileExtensions'=>['jpg','gif','png'],
            'showUpload' => true,
        ],
        
    ]);
}else 

if ($model->imagen==null) {
    echo FileInput::widget([
        'model' => $model,
        'attribute' => 'image',
        'options' => ['accept' => 'img/*'],
        'pluginOptions'=>[
            'allowedFileExtensions'=>['jpg','gif','png'],
            'showUpload' => false,
        ]
    ]);
}else{
    echo FileInput::widget([
    'model' => $model,
    'attribute' => 'image',
    'options' => ['accept' => 'img/*'],
    'pluginOptions'=>[
        'initialPreview'=>[Url::base().'/img/evento/'.$model->imagen],
        'initialPreviewAsData'=>true,
        'allowedFileExtensions'=>['jpg','gif','png'],
        'showUpload' => false,
    ]
]);
}
 ?>

<?= $form->field($model, 'descripcion')->
textarea(["onkeyup" => "contadorCaracteres(this)"])->label('Descripción') ?>

<?= '<p id="numeroCaracteres"> 520 caracteres restantes </p>' ?> 



<?php 
    if (isset($n)) {
        echo Html::submitButton('Guardar', ['class' => 'btn btn-success',
        'id' => 'guardarAnexoAjax', 'data-id' => $n]);
        echo '   '.Html::button('Regresar', 
        ['id'=>'regresar','data-id' => $n,
        'class' => 'btn btn-primary']);
        echo Html::hiddenInput('n','v') ;
    }else{
       echo Html::submitButton('Guardar', ['class' => 'btn btn-success']);
    }
?> 

<?php ActiveForm::end(); ?>

<?php //print_r($model->errors);
    /*echo FileInput::widget([
        'name' => 'attachment_49[]',
        'options'=>[
            'multiple'=>true
        ],
        'pluginOptions' => [
            'initialPreview'=>[
                "http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg"
            ],
            'initialPreviewAsData'=>true,
            'initialCaption'=>"The Moon",
            'initialPreviewConfig' => [
                ['caption' => 'Moon.jpg', 'size' => '873727'],
            ],
            'overwriteInitial'=>false,
            'maxFileSize'=>2800
        ]
    ]);*/
 ?>

 