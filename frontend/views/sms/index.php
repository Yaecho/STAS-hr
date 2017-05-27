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
            <label control-label">短信模板</label>
            <textarea name="smscontect" class="form-control" rows="3"><?=Html::encode($smsContect)?></textarea>
        </div>
        <button type="submit" class="btn btn-default">提交保存</button>
    </form>


<p style="margin-top: 15px;">全部：<?=Html::encode($smsCount['all'])?> <!--已发送：-->
    已确认：<?=Html::encode($smsCount['res'])?></p>
<a class="btn btn-default" href="<?=Url::to(['sms-send'])?>">发送</a>
