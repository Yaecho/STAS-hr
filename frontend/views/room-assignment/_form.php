<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;

/* @var $this yii\web\View */
/* @var $model common\models\RoomAssignmentModel */
/* @var $form yii\widgets\ActiveForm */
foreach (\Yii::$app->params['department'] as $v){
    $department[$v] =$v;
}
?>

<div class="room-assignment-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'department')->dropDownList($department) ?>

    <?= $form->field($model, 'classroom')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
