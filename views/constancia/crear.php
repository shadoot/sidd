<?php 
use kartik\markdown\MarkdownEditor;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

 ?>

 <div class="fa-constancia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=	$form->field($model,'titulo')->textInput()->label('Titulo Del Formato') ?>

    <?= MarkdownEditor::widget([
		'model' => $model, 
		'attribute' => 'contenido',
		'previewAction' => 'constancia/preview',
	]) ?>

	<?= $form->field($model,'activa')->checkbox(['label' => 'Activa']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div>
	<pre>
El salto de linea se hace un un < br >		

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