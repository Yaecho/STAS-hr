<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RoomAssignmentModel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '面试教室', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-assignment-model-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'department',
            'classroom',
        ],
    ]) ?>

</div>
