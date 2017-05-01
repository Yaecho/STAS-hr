<?php

$this->title = '用户授权搜索结果';
$this->params['breadcrumbs'][] = ['label'=>'用户授权','url'=>['user-role/index']];
$this->params['breadcrumbs'][] = '用户授权搜索结果';
?>

<p>姓名：<?=$user['truename']?></p>
<p>学号：<?=$user['username']?></p>
<p>部门：<?=$user['department']?></p>
<p>角色：
    <?php foreach ($role as $v){
        echo '<strong>',$v->description,'</strong>';
        echo '<a href="',\yii\helpers\Url::toRoute(['delete','userId'=>$user['id'],'role'=>$v->name,'sid'=>$user['username']]),'"> 移除</a>',' | ';
    }?>
</p>