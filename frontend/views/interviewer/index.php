<?php

use yii\helpers\Html;

$this->title = '面试';
?>
<div style="margin-bottom: 10px;">
    <form class="form-inline" method="post" action="<?= \yii\helpers\Url::to(['index'])?>">
        <input type="hidden" name="_csrf-frontend" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>"/>
        <div class="form-group">
            <label class="" for="signId">签到号</label>
            <input type="number" class="form-control" name="Search[signId]" value="<?=Html::encode($search['signId'])?>" id="signId" placeholder="签到号">
        </div>
        <div class="form-group">
            <label class="" for="name">OR 姓名</label>
            <input type="text" class="form-control" name="Search[name]" value="<?=Html::encode($search['name'])?>" id="name" placeholder="姓名">
        </div>
        <div class="form-group">
            <label class="" for="sid">OR 学号</label>
            <input type="number" class="form-control" name="Search[sid]" value="<?=Html::encode($search['sid'])?>" id="sid" placeholder="学号">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
</div>

<div style="border:1px solid #ddd">
    <table class="table table-hover" style="margin-bottom: 0;">
        <thead>
        <tr>
            <th>签到号</th>
            <th>姓名</th>
            <th>学号</th>
            <th>性别</th>
            <th>第一志愿</th>
            <th>第二志愿</th>
            <th>面试</th>
            <th>签到时间</th>
            <th>标记录用</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['data'] as $v): ?>
            <tr>
                <th scope="row"><?= Html::encode($v['sign']['id'])?></th>
                <td><?= Html::encode($v['name'])?></td>
                <td><?= Html::encode($v['sid'])?></td>
                <td><?= Html::encode($v['sex'])?></td>
                <td><?= Html::encode($v['first_wish'])?></td>
                <td><?= Html::encode($v['second_wish'])?></td>
                <td>
                    <a href="<?=\yii\helpers\Url::to(['detail','id'=>$v['id']])?>">查看简历</a>
                </td>
                <td>
                    <?= Html::encode(date('m-d H:i',$v['sign']['time']))?>
                </td>
                <td>
                    <?php
                    if(empty($v['hire'])){
                        echo '未标记';
                    }else{
                        echo '<div style="color: #00aa00">已标记</div>';
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<div class="page" style="text-align: center;"><?=\yii\widgets\LinkPager::widget(['pagination' => $data['page']]);?></div>