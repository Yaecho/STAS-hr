<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <div class="form-group field-usermodel-password">
        <label class="control-label" for="usermodel-password">Password</label>
        <input type="password" id="usermodel-password" class="form-control" name="password">

        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'truename')->textInput() ?>
    <?= $form->field($model, 'class')->textInput() ?>
    <?= $form->field($model, 'phone')->textInput() ?>
    <?= $form->field($model, 'qq')->textInput() ?>
    <?= $form->field($model, 'department')->textInput() ?>
    <?= $form->field($model, 'duty')->textInput() ?>
    <?= $form->field($model, 'birthday')->textInput() ?>
    <?= $form->field($model, 'appearance')->textInput() ?>
    <?= $form->field($model, 'dorm')->textInput() ?>
    <?= $form->field($model, 'role')->textInput() ?>
    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
