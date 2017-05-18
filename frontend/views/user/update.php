<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */

$this->title = '更新用户: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';

$auth = Yii::$app->authManager;
$roleData = $auth->getRolesByUser($model->id);
$roles = Yii::$app->authManager->getRoles();

//var_dump($role);exit;
//if(empty($role))
?>
<div class="user-model-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<div class="user-model-update">
    <h3>权限</h3>
    <form class="form-inline" method="post" action="<?=Url::toRoute(['assign-auth'])?>">
        <input type="hidden" name="_csrf-frontend" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>"/>
        <input type="hidden" name="param[id]" value="<?=Html::encode($model->id)?>" >

        <div class="form-group">
            <label for="role">角色：</label>
            <select id="role" name="param[role]" class="form-control" required>
                <?php foreach ($roles as $role):?>
                    <option value="<?=Html::encode($role->name)?>"><?=Html::encode($role->description)?></option>
                <?php endforeach;?>
            </select>
        </div>

        <button type="submit" class="btn btn-default">授予</button>
    </form>
</div>
<br>
<p><strong>角色：</strong>
    <?php foreach ($roleData as $v):?>
        <strong><?= Html::encode($v->description)?></strong>
        <a href="<?=Url::toRoute(['remove-auth','id'=>$model->id,'role'=>$v->name])?>"> 移除</a> |
    <?php endforeach;?>
</p>