<?php

use yii\helpers\Url;

$this->title = '用户中心';
$this->params['breadcrumbs'][] = '用户中心';
?>

<ul class="nav nav-pills">
    <li role="presentation"><a href="<?=Url::to(['change-password'])?>">修改密码</a></li>
    <li role="presentation"><a href="<?=Url::to(['update-info'])?>">修改个人信息</a></li>
    <li role="presentation"><a href="#">通知</a></li>
</ul>
<p style="margin-left: 20px;">这个页面做得比较粗糙，日后再改。</p>