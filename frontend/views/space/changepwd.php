<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = '修改密码';
$this->params['breadcrumbs'][] = ['label' => '用户中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改密码';
?>

<?php $form = ActiveForm::begin(); ?>

<?php //$form->field($model, 'username')->textInput() ?>


<?= $form->field($model, 'oldPassword')->passwordInput() ?>
<?= $form->field($model, 'newPassword')->passwordInput() ?>
<?= $form->field($model, 'newPasswordVerity')->passwordInput() ?>



<div class="form-group">
    <?= Html::submitButton("修改", ['class' => 'btn btn-success']); ?>
</div>

<?php ActiveForm::end(); ?>
