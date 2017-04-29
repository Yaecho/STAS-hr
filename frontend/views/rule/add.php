<?php

use yii\helpers\Html;

$this->title = '添加角色';
$this->params['breadcrumbs'][] = ['label' => '角色管理','url' => ['auth/index']];;
$this->params['breadcrumbs'][] = '添加角色';
?>

<div class="portlet light bordered">
    <div class="portlet-title">
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form action="<?=\yii\helpers\Url::toRoute(['add'])?>" method="post" class="form-aaa ">

            <div class="form-group">
                <div>
                    <label>角色名</label>
                    <span class="help-inline">（角色（用户组）名称）</span>
                </div>
                <input type="text" class="form-control c-md-2" name="param[name]" value="" placeholder="英文名"/>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <div>
                    <label>角色描述</label>
                    <span class="help-inline">（角色描述）</span>
                </div>
                <textarea class="form-control c-md-4" name="param[description]" rows="3"></textarea>
                <span class="help-block"></span>
            </div>

            <div class="form-actions">
                <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-aaa']) ?>
                <?= Html::button('取消', ['class' => 'btn']) ?>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
