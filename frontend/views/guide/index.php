<?php

use yii\helpers\Html;

$this->title = '签到';
?>

<div style="margin-bottom: 10px;">
    <form class="form-inline" method="post" action="<?= \yii\helpers\Url::to(['index'])?>">
        <input type="hidden" name="_csrf-frontend" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>"/>
        <div class="form-group">
            <label class="" for="name">姓名</label>
            <input type="text" class="form-control" name="name" value="<?=Html::encode($search['name'])?>" id="name" placeholder="姓名">
        </div>
        <div class="form-group">
            <label class="" for="sid">OR 学号</label>
            <input type="number" class="form-control" name="sid" value="<?=Html::encode($search['sid'])?>" id="sid" placeholder="学号">
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
            <th>面试部门</th>
            <th>签到</th>
            <th>签到时间</th>
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
            <td>
                <?php if (empty($v['sign'])) :?>
                    <?= Html::encode($v['first_wish'])?>
                <?php else:?>
                    <?= Html::encode($v['sign']['department'])?>
                <?php endif;?>
            </td>
            <td id="sign-<?= Html::encode($v['id'])?>">
                <?php if (empty($v['sign'])) :?>
                    <a href="javascript:;" onclick="sign('<?= Html::encode($v['id'])?>')">签到</a>
                <?php else:?>
                    <a href="javascript:;" onclick="getRoom('<?= Html::encode($v['id'])?>')">已签到</a>
                <?php endif;?>
            </td>
            <td id="signT-<?= Html::encode($v['id'])?>">
                <?php if (empty($v['sign'])) :?>
                    未签到
                <?php else:?>
                    <?= Html::encode(date('m-d h:i',$v['sign']['time']))?>
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