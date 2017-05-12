<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RoomAssignmentModel */

$this->title = '新建面试教室';
$this->params['breadcrumbs'][] = ['label' => '面试教室', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-assignment-model-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
