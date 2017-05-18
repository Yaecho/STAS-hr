<?php

use yii\helpers\Html;

$this->title = '编辑规则';
$this->params['breadcrumbs'][] = ['label' => '规则管理','url' => ['rule/index']];
$this->params['breadcrumbs'][] = '编辑规则';
?>

<div class="portlet light bordered">
    <div class="portlet-title">
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form action="<?=\yii\helpers\Url::toRoute(['edit','rule'=>$rule->name])?>" method="post">

            <div class="form-group">
                <div>
                    <label>规则名</label>
                    <span class="help-inline">（模块/方法）</span>
                </div>
                <input type="text" class="form-control c-md-2" name="param[name]" value="<?=$rule->name?>"/>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <div>
                    <label>规则描述</label>
                    <span class="help-inline">（规则描述）</span>
                </div>
                <textarea name="param[description]" class="form-control c-md-4" rows="3"><?=$rule->description?></textarea>
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
