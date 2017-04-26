<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ResumeModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resume-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'identity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'college')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dorm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qq')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_wish')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'second_wish')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'myself')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hope')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_time')->textInput() ?>

    <?= $form->field($model, 'hobbies')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'res')->textInput() ?>

    <?= $form->field($model, 'not_recycling')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
