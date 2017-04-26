<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ResumeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resume-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'sex') ?>

    <?= $form->field($model, 'birthday') ?>

    <?= $form->field($model, 'place') ?>

    <?php // echo $form->field($model, 'identity') ?>

    <?php // echo $form->field($model, 'college') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'dorm') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'qq') ?>

    <?php // echo $form->field($model, 'first_wish') ?>

    <?php // echo $form->field($model, 'second_wish') ?>

    <?php // echo $form->field($model, 'myself') ?>

    <?php // echo $form->field($model, 'hope') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'hobbies') ?>

    <?php // echo $form->field($model, 'sid') ?>

    <?php // echo $form->field($model, 'is_send') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'res') ?>

    <?php // echo $form->field($model, 'not_recycling') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
