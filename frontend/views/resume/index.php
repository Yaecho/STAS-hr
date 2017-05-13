<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ResumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '简历管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-model-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'sid',
            'name',
            'sex'=>[
                'attribute' => 'sex',
                'filter' => ['男'=>'男','女'=>'女']
            ],
            //'birthday',
            'place',
            // 'identity',
            // 'college',
            // 'class',
            // 'dorm',
            // 'phone',
            // 'qq',
            'first_wish',
            // 'second_wish',
            // 'myself',
            // 'hope',
            [
                'label'=> '简历创建时间',
                'attribute' => 'created_time',
                'format' => ['date', 'php:m-d H:i'],
                //'filter'=>false,
            ],
            //'created_time:datetime',
            // 'hobbies',
            // 'sid',
            'is_send'=>[
                'attribute' => 'is_send',
                'value' => function($model){

                    return ($model->is_send == 1)?'已发送':'未发送';
                },
                'filter' => ['1'=>'已发送','0'=>'未发送']
            ],
            // 'code',
            'res'=>[
                'attribute' => 'res',
                'value' => function($model){

                    return ($model->res == 1)?'已确认':'未确认';
                },
            ],
            //'sign.is_sign',
            /*[
                'attribute' => 'is_sign',
                'value' => 'sign.is_sign',
                'label' => '签到',
            ],*/
            /*[
                'attribute' => 'iid',
                'value' => 'hire.iid',
                'label' => '录用',
            ],*/
            //'hire.iname',
            // 'not_recycling',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
