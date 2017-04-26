<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ResumeModel */

$this->title = 'Update Resume Model: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Resume Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resume-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
