<?php

use yii\helpers\Html;

$this->title = '重复简历筛选';
$this->params['breadcrumbs'][] = $this->title;
?>
<table class="table table-hover" style="margin-bottom: 0;">
    <thead>
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>学号</th>
        <th>性别</th>
        <th>第一志愿</th>
        <th>第二志愿</th>
        <th>填报时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['data'] as $v): ?>
        <tr>
            <th scope="row"><?= Html::encode($v['id'])?></th>
            <td><?= Html::encode($v['name'])?></td>
            <td><?= Html::encode($v['sid'])?></td>
            <td><?= Html::encode($v['sex'])?></td>
            <td><?= Html::encode($v['first_wish'])?></td>
            <td><?= Html::encode($v['second_wish'])?></td>
            <td><?= Html::encode(date('m-d H:i', $v['created_time']))?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['resume/view', 'id' => $v['id']])?>">查看</a>
                <a href="<?=\yii\helpers\Url::to(['delete', 'id' => $v['id']])?>">删除</a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
</div>
<div class="page" style="text-align: center;"><?=\yii\widgets\LinkPager::widget(['pagination' => $data['page']]);?></div>
