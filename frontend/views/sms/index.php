<?php

use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\helpers\Html;

$this->title = '短信发送';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>通过API发送</h3>
    <form action="<?=Url::to(['index'])?>" method="post">
        <input type="hidden" name="_csrf-frontend" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>"/>
        <div class="form-group">
            <label control-label>短信模板</label>
            <textarea name="sms_templete" class="form-control" rows="3"><?=Html::encode($sms_templete)?></textarea>
        </div>
        <button type="submit" class="btn btn-default">提交保存</button>
    </form>

<hr>
<p style="margin-top: 15px;">短信发送服务状态：<?=Html::encode($send_sms === 'true'?'开启':'关闭')?> </p>
<p style="margin-top: 15px;">全部：<?=Html::encode($smsCount['all'])?> 已发送：<?=Html::encode($smsCount['is_send'])?>
    已确认：<?=Html::encode($smsCount['res'])?></p>

<a class="btn btn-default" href="<?=Url::to(['sms-send'])?>">修改状态</a>
