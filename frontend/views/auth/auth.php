<?php

use yii\helpers\Html;

$this->title = '角色授权管理';
$this->params['breadcrumbs'][] = ['label' => '角色管理','url' => ['auth/index']];;
$this->params['breadcrumbs'][] = '角色授权管理';
?>

<div class="portlet light bordered">
    <div class="portlet-title">
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form action="<?=\yii\helpers\Url::toRoute(['auth','role'=>$role])?>" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">角色权限授予</div>
                <div class="panel-body">
                    <?php foreach ($node_list as $node): ?>
                        <?php if ($node['type'] === '1' and $node['name']!==$role):?>
                            <div class="form-group" style="margin-bottom:0px;">
                                <div class="mt-checkbox-inline" style="padding:2px 0;">
                                    <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom:0px;">
                                        <input type="checkbox" name="roles[]" value="<?=$node['name']?>" <?php echo in_array($node['name'],$auth_rules) ?'checked':''; ?> />
                                        <span></span>
                                        <?=$node['description']?>
                                    </label>
                                </div>
                            </div>
                        <?php endif;?>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">基本权限授予</h3>
                </div>
                <div class="panel-body">
                    <?php foreach ($node_list as $node): ?>
                        <?php if($node['type'] === '2'):?>
                            <div class="form-group" style="margin-bottom:0px;">
                                <div class="mt-checkbox-inline" style="padding:2px 0;">
                                    <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom:0px;">
                                        <input type="checkbox" name="rules[]" value="<?=$node['name']?>" <?php echo in_array($node['name'],$auth_rules) ?'checked':''; ?> />
                                        <span></span>
                                        <?=$node['description']?>
                                    </label>
                                </div>
                            </div>
                        <?php endif;?>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="form-actions">
                <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-aaa']) ?>
                <?= Html::button('取消', ['class' => 'btn']) ?>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
