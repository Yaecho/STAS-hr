<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '面试教室';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-assignment-model-index">
    <p>
        <?= Html::a('新建', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'department',
            'classroom',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
