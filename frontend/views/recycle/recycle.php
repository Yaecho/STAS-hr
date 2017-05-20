<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ResumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '简历回收站';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-model-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                'attribute' => 'created_time',
                'format' => ['date', 'php:m-d H:i']
            ],
            //'created_time',
            // 'hobbies',
            // 'sid',
            /*'is_send'=>[
                'attribute' => 'is_send',
                'value' => function($model){

                    return ($model->is_send == 1)?'已发送':'未发送';
                },
                'filter' => ['1'=>'已发送','0'=>'未发送']
            ],*/
            // 'code',
            'res'=>[
                'attribute' => 'res',
                'value' => function($model){

                    return ($model->res == 1)?'已确认':'未确认';
                },
                'filter' => ['1'=>'已确认','0'=>'未确认']
            ],
            // 'not_recycling',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '删除或恢复',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{restore}{delete}',
                'buttons' => [
                    'restore' => function ($url, $model) {
                        return Html::a('恢复 ', $url, [
                            'title' => '恢复',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(' 删除', $url, [
                            'title' => '删除',
                        ]);
                    }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'restore') {
                        $url = \yii\helpers\Url::toRoute(['recycle/restore','id' => $model->id]);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = \yii\helpers\Url::toRoute(['recycle/true-delete','id' => $model->id]);
                        return $url;
                    }

                }
            ],
        ],
    ]); ?>
</div>
