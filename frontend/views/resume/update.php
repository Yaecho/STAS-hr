<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ResumeModel */

$this->title = '更新简历: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '简历管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resume-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
