<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-model-index">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Model', ['create'], ['class' => 'btn btn-success']) ?>
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
            'class',
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
            'role',
            'status',
            // 'avatar',
            // 'vip_lv',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
