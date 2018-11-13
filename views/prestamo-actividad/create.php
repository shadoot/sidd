<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FiPrestamoActividad */

$this->title = 'Registrar prestamos a las Actividades ';
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fi-prestamo-actividad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
