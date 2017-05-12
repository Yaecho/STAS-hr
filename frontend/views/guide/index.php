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
            <th>签到时间</th>
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
                    <a href="javascript:;" onclick="getRoom('<?= $v['id']?>')">已签到</a>
                <?php endif;?>
            </td>
            <td id="signT-<?= $v['id']?>">
                <?php if (empty($v['sign'])) :?>
                    未签到
                <?php else:?>
                    <?= date('m-d h:i',$v['sign']['time'])?>
                <?php endif;?>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<div class="page" style="text-align: center;"><?=\yii\widgets\LinkPager::widget(['pagination' => $data['page']]);?></div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="mymodel" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="mySmallModalLabel">系统信息</h4>
            </div>
            <div class="modal-body" id="info"> ... </div>
        </div>
    </div>
</div>

    <!-- 定义数据块 -->
<?php $this->beginBlock('sign'); ?>
    function sign(id)
    {

        $.get("<?= \yii\helpers\Url::to(['sign'])?>&id="+id,function(data,status){
            if(data != 'fail'){
                $('#sign-'+id).html('<a href="javascript:;" onclick="getRoom('+"'"+id+"'"+')">已签到</a>');
                $('#signT-'+id).html(data);
                getRoom(id);
            }else{
                alert('签到失败！');
            }
        });
    }
    function getRoom(id)
    {

        $.get("<?= \yii\helpers\Url::to(['get-room'])?>&id="+id,function(data,status){
            $('#info').html(data);
            $('#mymodel').modal();
        });
    }
<?php $this->endBlock() ?>
    <!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['sign'], \yii\web\View::POS_END); ?>