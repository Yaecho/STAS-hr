<?php

use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\helpers\Html;

$this->title = '短信发送';
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this);
AppAsset::addScript($this,'@web/statics/js/clipboard.min.js');
?>
<h3>手动发送</h3>
<div style="margin-top: 15px;">
    <!-- Target -->
    <textarea id="bar" class="form-control" rows="3">
        <?php
            foreach ($data['data'] as $v){
                echo Html::encode($v['phone']).';';
            }
        ?>
    </textarea>

    <!-- Trigger -->
    <button class="btn btn-default" id="copy" data-clipboard-target="#bar" style="margin-top: 15px;">
        <i class="fa fa-clipboard"></i> 点击复制
    </button>
</div>
<div class="page" style="text-align: center;"><?=\yii\widgets\LinkPager::widget(['pagination' => $data['page']]);?></div>

<?php $this->beginBlock('copy'); ?>

new Clipboard('#copy');

<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['copy'], \yii\web\View::POS_END); ?>
