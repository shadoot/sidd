<?php 
use kartik\markdown\MarkdownEditor;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

 ?>

 <div class="fa-constancia-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?=	$form->field($model,'titulo')->textInput()->label('Titulo Del Formato') ?>

    <?= MarkdownEditor::widget([
		'model' => $model, 
		'attribute' => 'contenido',
		'previewAction' => 'constancia/preview',
	]) ?>
	<br>
	<?= $form->field($model,'nombre_fuente')->textInput() ?>

	<?php //$form->field($model,'archivo_fuente')->textInput() ?>

	<?php if (isset($model->archivo_fuente) && $model->archivo_fuente!==''
				&& !is_null($model->archivo_fuente)) {
		echo Html::HiddenInput('fontSource', $model->archivo_fuente);
		$name=$model->archivo_fuente;
		$model->archivo_fuente='
			<object class="kv-preview-data file-preview-object file-object type-default" data="blob:http://localhost/0d486097-8cfa-4701-a1b3-7280f213a9cc" type="font/ttf" style="width:213px;height:160px;">
			<param name="movie" value="Felipa-Regular.ttf">
			<param name="controller" value="true">
			<param name="allowFullScreen" value="true">
			<param name="allowScriptAccess" value="always">
			<param name="autoPlay" value="false">
			<param name="autoStart" value="false">
			<param name="quality" value="high">
			 <div class="file-preview-other">
			<span class="file-other-icon"><i class="glyphicon glyphicon-file"></i></span>
			</div>
			</object>
			</div><div class="file-thumbnail-footer">
			    <div class="file-footer-caption" title="'.$name.'">
			        <div class="file-caption-info">'.$name.'</div>
			        
			    </div>';
	}  ?>

	<?php echo FileInput::widget([
        'model' => $model,
        'attribute' => 'archivo_fuente',
        'options' => ['multiple' => false],
        'pluginOptions'=>[
        	'initialPreview' => [
        		$model->archivo_fuente,
        	],
        	//'initialPreviewAsData'=>true,
        	'initialPreviewAsOther' => true,
        	'previewFileType' => 'other',
        	'initialCaption'=>$model->archivo_fuente,
            'allowedFileExtensions'=>['ttf'],
            'showUpload' => false,
        ]
    ]) ?>

    <br>

	<?= $form->field($model,'activa')->checkbox(['label' => 'Activa']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div>
	<pre>
El salto de linea se hace un un &ltbr&gt		

parametos:
:nombre			Para mostrar el nombre del alumno comenzando por apellidos
:control		Para mostrar el número de control del alumno
:carrera		Para mostrar la carrera del alumno
:promedio		Para mostrar el promedio del alumno de todas las actividades aprovadas que haya tomado
:rendimiento()		Para mostrar con letras el nivel adquirido ejemplo 80 = bueno
:dia()			Para mostrar el dia en que se crea la constancia
:mes()			Para mostrar el mes en que se crea la constancia
:year()			Para mostrar el año en que se crea la constancia
Para subrayar una parte del texto tiene que se encerrada con {} ejemplo.
esta parte no sera subrayada y {esta parte si}
Para poner en negritas una parte del texto tiene que se encerrada con ** ** ejemplo.
esta parte no estará en negritas y **esta parte si**
procura no dejar espacio entre una letra y los **
por ejemplo ** esta parte no esta en negritas ** solo se muestran los **
y **esta parte si esta en negritas** y no se muestran los **
	</pre>


</div>
