<?php

use yii\helpers\Url;

$this->title = '云片网API';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>云片网API</h3>
<div style="margin-top: 15px;">
<form method="post" action="<?=Url::to(['yunpian-api'])?>">
    <input type="hidden" name="_csrf-frontend" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>"/>
  <div class="form-group">
    <label>密匙</label>
    <input type="text" name="api" class="form-control" value="<?=$data?>">
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>
</div>
