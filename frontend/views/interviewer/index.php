<?php

$this->title = '面试';
?>
<div style="margin-bottom: 10px;">
    <form class="form-inline" method="post" action="<?= \yii\helpers\Url::to(['index'])?>">
        <input type="hidden" name="_csrf-frontend" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>"/>
        <div class="form-group">
            <label class="" for="signId">签到号</label>
            <input type="number" class="form-control" name="Search[signId]" value="<?=$search['signId']?>" id="signId" placeholder="签到号">
        </div>
        <div class="form-group">
            <label class="" for="name">OR 姓名</label>
            <input type="text" class="form-control" name="Search[name]" value="<?=$search['name']?>" id="name" placeholder="姓名">
        </div>
        <div class="form-group">
            <label class="" for="sid">OR 学号</label>
            <input type="number" class="form-control" name="Search[sid]" value="<?=$search['sid']?>" id="sid" placeholder="学号">
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
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['data'] as $v): ?>
            <tr>
                <th scope="row"><?= $v['id']?></th>
                <td><?= $v['resume']['name']?></td>
                <td><?= $v['resume']['sid']?></td>
                <td><?= $v['resume']['sex']?></td>
                <td><?= $v['resume']['first_wish']?></td>
                <td><?= $v['resume']['second_wish']?></td>
                <td>
                    <a href="<?=\yii\helpers\Url::to(['detail','id'=>$v['resume']['id']])?>">查看简历</a>
                </td>
                <td>
                    <?= date('m-d h:i',$v['time'])?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<div class="page" style="text-align: center;"><?=\yii\widgets\LinkPager::widget(['pagination' => $data['page']]);?></div>