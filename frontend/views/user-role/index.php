<?php

$this->title = '用户授权';
$this->params['breadcrumbs'][] = '用户授权';
?>
<h3>用户授权</h3>
<form class="form-inline" method="post" action="<?=\yii\helpers\Url::toRoute(['index'])?>">
    <div class="form-group">
        <label for="sid">学号：</label>
        <input type="text" name="param[sid]" class="form-control" id="sid" placeholder="十位学号" required>
    </div>

    <div class="form-group">
        <label for="role">角色</label>
        <select id="role" name="param[role]" class="form-control" required>
            <?php foreach ($roles as $role):?>
            <option value="<?=$role->name?>"><?=$role->description?></option>
            <?php endforeach;?>
        </select>
    </div>

    <button type="submit" class="btn btn-default">授予</button>
</form>
<h3>搜索用户</h3>
<form class="form-inline" method="get" action="">
    <input type="hidden" name="r" value="user-role/search">
    <div class="form-group">
        <label for="sid">学号：</label>
        <input type="text" name="param[sid]" class="form-control" id="sid" placeholder="十位学号" required>
    </div>
    <button type="submit" class="btn btn-default">搜索</button>
</form>
