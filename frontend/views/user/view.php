<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'username',
            'truename',
            'department',
            'class',
            'phone',
            'qq',
            'duty',
            'birthday',
            'appearance',
            'dorm',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email_validate_token:email',
            'email:email',
            'role',
            'status',
            'avatar',
            'vip_lv',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
