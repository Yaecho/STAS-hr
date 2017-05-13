<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserModel */

$this->title = '新增用户';
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
