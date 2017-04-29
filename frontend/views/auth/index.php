<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '角色管理';
$this->params['breadcrumbs'][] = '角色管理';
?>
<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="actions">
            <div class="btn-group btn-group-devided">
                <?=Html::a('添加 <i class="fa fa-plus"></i>',['add'],['class'=>'btn btn-success','style'=>'margin-bottom:10px;'])?>
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container table-scrollable">
            <!--<form class="ids">-->

            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th style="width:8px;">#</th>
                    <th>角色名</th>
                    <th class="hidden-480">描述</th>
                    <th style="width:140px;">添加时间</th>
                    <th style="width:140px;">更新时间</th>
                    <th class="hidden-480">操作</th>
                </tr>
                </thead>
                <tbody>

                <?php $nn=0;?>
                <?php foreach ($roles as $key => $value): ?>
                    <tr class="odd gradeX">
                        <?php $nn++;?>
                        <td><?=$nn?></td>
                        <td><?=$value->name?></td>
                        <td><?=$value->description?></td>
                        <td><?=date('Y-m-d H:i',$value->createdAt)?></td>
                        <td><?=date('Y-m-d H:i',$value->updatedAt)?></td>
                        <td>
                            <a href="<?=Url::toRoute(['auth', 'role'=>$key])?>" class="btn btn-xs purple"><i class="fa fa-key"></i> 授权</a>
                            <a href="<?=Url::toRoute(['user', 'role'=>$key])?>" class="btn btn-xs purple"><i class="fa fa-user"></i> 用户</a>
                            <a href="<?=Url::toRoute(['edit', 'role'=>$key])?>" class="btn btn-xs purple"><i class="fa fa-edit"></i> 编辑</a>
                            <a href="<?=Url::toRoute(['delete', 'role'=>$key])?>" class="btn btn-xs red ajax-get confirm"><i class="fa fa-times"></i> 删除</a>
                        </td>
                    </tr>
                <?php endforeach ?>

                </tbody>
            </table>

            <!--</form>-->
        </div>
    </div>
</div>