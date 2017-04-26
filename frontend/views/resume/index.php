<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ResumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resume Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-model-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'sex',
            'birthday',
            'place',
            // 'identity',
            // 'college',
            // 'class',
            // 'dorm',
            // 'phone',
            // 'qq',
            // 'first_wish',
            // 'second_wish',
            // 'myself',
            // 'hope',
            // 'created_time:datetime',
            // 'hobbies',
            // 'sid',
            // 'is_send',
            // 'code',
            // 'res',
            // 'not_recycling',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
