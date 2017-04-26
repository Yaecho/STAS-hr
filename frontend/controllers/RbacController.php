<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // 添加 "createPost" 权限
        /*$createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // 添加 "updatePost" 权限
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);*/

        // 添加 "author" 角色并赋予 "createPost" 权限
        $name = 'minister';
        $auth = Yii::$app->authManager;
        $role = $auth->createRole('interviewer');
        $role->description = '面试人员';
        $auth->add($role);
        //$auth->addChild($author, $createPost);

        // 添加 "admin" 角色并赋予 "updatePost"
        // 和 "author" 权限
        /*$admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // 为用户指派角色。其中 1 和 2 是由 IdentityInterface::getId() 返回的id （译者注：user表的id）
        // 通常在你的 User 模型中实现这个函数。
        $auth->assign($author, 2);
        $auth->assign($admin, 1);*/
    }

    public function actionPcreate()
    {
        $auth = Yii::$app->authManager;
        $createPost = $auth->createPermission('resume/index');
        $createPost->description = '查看所有简历';
        $auth->add($createPost);
    }

    public function actionChild()
    {
        $auth = Yii::$app->authManager;
        $parent = $auth->createRole('admin');                //创建角色对象
        $child = $auth->createPermission('resume/index');     //创建权限对象
        $auth->addChild($parent, $child);                           //添加对应关系
    }

    public function actionUser()
    {
        $auth = Yii::$app->authManager;
        $role = $auth->createRole('admin');                //创建角色对象
        $user_id = 1;                                             //获取用户id，此处假设用户id=1
        $auth->assign($role, $user_id);                           //添加对应关系
    }

}