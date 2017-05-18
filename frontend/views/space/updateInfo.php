<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = '修改密码';
$this->params['breadcrumbs'][] = ['label' => '用户中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改个人信息';
?>

<?php $form = ActiveForm::begin(); ?>

<?php //$form->field($model, 'username')->textInput() ?>

<?= $form->field($model, 'class')->textInput() ?>
<?= $form->field($model, 'phone')->textInput() ?>
<?= $form->field($model, 'qq')->textInput() ?>
<?= $form->field($model, 'birthday')->textInput() ?>
<?= $form->field($model, 'appearance')->textInput() ?>
<?= $form->field($model, 'dorm')->textInput() ?>


<div class="form-group">
    <?= Html::submitButton("修改", ['class' => 'btn btn-success']); ?>
</div>

<?php ActiveForm::end(); ?>
