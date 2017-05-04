<?php

$this->title = '签到';
?>

<div style="margin-bottom: 10px;">
    <form class="form-inline" method="post" action="<?= \yii\helpers\Url::to(['index'])?>">
        <input type="hidden" name="_csrf-frontend" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>"/>
        <div class="form-group">
            <label class="" for="name">姓名</label>
            <input type="text" class="form-control" name="name" value="<?=$search['name']?>" id="name" placeholder="姓名">
        </div>
        <div class="form-group">
            <label class="" for="sid">OR 学号</label>
            <input type="number" class="form-control" name="sid" value="<?=$search['sid']?>" id="sid" placeholder="学号">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
</div>

<div style="border:1px solid #ddd">
    <table class="table table-hover" style="margin-bottom: 0;">
        <thead>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>学号</th>
            <th>性别</th>
            <th>第一志愿</th>
            <th>第二志愿</th>
            <th>签到</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['data'] as $v): ?>
        <tr>
            <th scope="row"><?= $v['id']?></th>
            <td><?= $v['name']?></td>
            <td><?= $v['sid']?></td>
            <td><?= $v['sex']?></td>
            <td><?= $v['first_wish']?></td>
            <td><?= $v['second_wish']?></td>
            <td id="sign-<?= $v['id']?>">
                <?php if (empty($v['sign'])) :?>
                    <a href="javascript:;" onclick="sign('<?= $v['id']?>')">签到</a>
                <?php else:?>
                    已签到
                <?php endif;?>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<div class="page" style="text-align: center;"><?=\yii\widgets\LinkPager::widget(['pagination' => $data['page']]);?></div>

    <!-- 定义数据块 -->
<?php $this->beginBlock('sign'); ?>
    function sign(id)
    {

        $.get("demo_test.asp",function(data,status){
            alert("Data: " + data + "\nStatus: " + status);
        });

        var temp ='#sign-'+id;
        $(temp).html('已签到');
    }
<?php $this->endBlock() ?>
    <!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['sign'], \yii\web\View::POS_END); ?>