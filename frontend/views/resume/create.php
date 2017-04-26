<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ResumeModel */

$this->title = 'Create Resume Model';
$this->params['breadcrumbs'][] = ['label' => 'Resume Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
