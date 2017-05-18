<?php


$this->title = '导入导出';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>数据导入</h3>
<form action="<?=\yii\helpers\Url::to(['upload-csv'])?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_csrf-frontend" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>"/>
    <div class="form-group">
        <input name="csv" type="file" id="InputFile">
        <p class="help-block">导入用户，请上传csv格式文件 <a href="<?=\yii\helpers\Url::to(['template'])?>">模板下载</a></p>
    </div>

    <button type="submit" class="btn btn-default">上传</button>
</form>
<hr>
<h3>数据导出</h3>
<a class="btn btn-default" href="<?=\yii\helpers\Url::to(['download-csv'])?>">导出简历</a>
