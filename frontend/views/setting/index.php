<?php

use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\helpers\Html;

$this->title = '其他设置';
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
AppAsset::addScript($this,'@web/statics/js/bootstrap-switch.min.js');
AppAsset::addCss($this,'@web/statics/css/bootstrap-switch.min.css');
?>
<h3><?=Html::encode($this->title)?></h3>
 <div class="form-group">
    <label style="margin-right:52px;">允许报名 </label>
    <input type="checkbox" class="form-control" name="resume" <?php if($data['resume'] ==='true') echo 'checked';?>>
</div>
<div class="form-group">
    <label style="margin-right:10px;">短信确认码开关 </label>
    <input type="checkbox" class="form-control" name="rescode" <?php if($data['rescode'] ==='true') echo 'checked';?>>
</div>
<h4>首页介绍网址</h4>
<div style="margin-top: 15px;"></div>
<form method="post" action="<?=Url::to(['index'])?>">
    <input type="hidden" name="_csrf-frontend" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>"/>
  <div class="form-group">
    <label>网址</label>
    <input type="url" name="iUrl" class="form-control" value="<?=$data['i_url']?>">
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>

<?php $this->beginBlock('switch'); ?>

    $("[name='resume'],[name='rescode']").bootstrapSwitch();
    $("[name='resume'],[name='rescode']").on('switchChange.bootstrapSwitch', function(event, state) {
        input = $(this);
        postData = {
            action:input.attr("name"),
            value:state
        }
        $.post( "<?=\yii\helpers\Url::to(['switch'])?>", postData, function(data) {
            if(data != 'success'){
                location.reload();
            }
        });
    });
    
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['switch'], \yii\web\View::POS_END); ?>