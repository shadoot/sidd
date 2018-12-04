<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FaListaRegistro */

$this->title = 'Registrar';
$this->params['breadcrumbs'][] = ['label' => 'Lista Registros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fa-lista-registro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'alumnoTemporal' => $alumnoTemporal,
    ]) ?>

</div>
