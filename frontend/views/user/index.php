<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-model-index">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'truename',
            'department',
            //'class',
            'phone',
            'qq',
            'duty',
            // 'birthday',
            // 'appearance',
            'dorm',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'email_validate_token:email',
            // 'email:email',
            //'role',
            'status' => [
                'label' => '状态',
                'attribute' => 'status',
                'value' => function($model){

                    return ($model->status == 10)?'激活':'未激活';
                },
                'filter' => ['0'=>'未激活','10'=>'激活']
            ],
            // 'avatar',
            // 'vip_lv',
            //'created_at:datetime',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
