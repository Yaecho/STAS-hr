<?php

use yii\helpers\Html;

$this->title = '添加规则';
$this->params['breadcrumbs'][] = ['label' => '规则管理','url' => ['rule/index']];
$this->params['breadcrumbs'][] = '添加规则';
?>

<div class="portlet light bordered">
    <div class="portlet-title">
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form action="<?=\yii\helpers\Url::toRoute(['add'])?>" method="post" >

            <div class="form-group">
                <div>
                    <label>路径</label>
                    <span class="help-inline">（模块/方法）</span>
                </div>
                <input type="text" class="form-control c-md-2" name="param[name]" value="" placeholder="英文名"/>
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <div>
                    <label>规则描述</label>
                    <span class="help-inline">（规则描述）</span>
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
