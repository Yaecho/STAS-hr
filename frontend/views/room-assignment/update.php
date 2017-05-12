<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RoomAssignmentModel */

$this->title = '面试教室: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '面试教室', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="room-assignment-model-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
