<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\grid\GridView;


$this->title = '用户管理';
$this->params['breadcrumbs'][] = ['label' => '角色管理','url' => ['auth/index']];;
$this->params['breadcrumbs'][] = '角色授权管理';
?>
<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-dark sbold uppercase">管理信息</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
        <?php
            foreach ($users as $user){
                echo '<p>',$user['department'],'-',$user['truename'],'(',$user['username'],')</p>';
            }
        ?>
        </div>
    </div>
</div>