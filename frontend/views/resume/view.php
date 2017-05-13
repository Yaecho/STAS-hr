<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ResumeModel */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '简历管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'name',
            'sex',
            'birthday',
            'place',
            'identity',
            'college',
            'class',
            'dorm',
            'phone',
            'qq',
            'first_wish',
            'second_wish',
            'myself',
            'hope',
            'created_time:datetime',
            'hobbies',
            'sid',
            'is_send',
            'code',
            'res',
            'not_recycling',
        ],
    ]) ?>

</div>
