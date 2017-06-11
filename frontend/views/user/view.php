<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$auth = Yii::$app->authManager;
$roleData = $auth->getRolesByUser($model->id);
$roles = Yii::$app->authManager->getRoles();
?>
<div class="user-model-view">

    <h3><?= Html::encode($this->title) ?></h3>

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
    <br>
    <p><strong>角色：</strong>
        <?php foreach ($roleData as $v):?>
            <strong><?= Html::encode($v->description)?></strong> |
        <?php endforeach;?>
    </p>

</div>
