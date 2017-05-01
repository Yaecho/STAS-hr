<?php

namespace frontend\controllers;

use common\models\UserModel;
use Yii;
use frontend\controllers\base\BaseController;
use yii\helpers\Url;
use yii\web\HttpException;

class UserRoleController extends BaseController
{
    public $enableCsrfValidation = false;

    public function actionIndex(){
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('param');
            /* 创建角色 */
            if ($data['sid']!=='' and $data['role']!=='') {
                $users = new UserModel();
                $user = $users::findOne(['username'=>$data['sid']])->toArray();

                if($user){
                    $auth = Yii::$app->authManager;
                    $role = $auth->getRole($data['role']);
                    $user_id = $user['id'];

                    if ($auth->assign($role, $user_id)) {
                        return $this->redirect(['user-role/index']);
                    }
                }
            }

        }
        $roles = Yii::$app->authManager->getRoles();

        return $this->render('index', [
            'roles' => $roles,
        ]);
    }

    public function actionSearch()
    {
        $data = Yii::$app->request->get('param');
         if ($data['sid']!==''){
             $users = new UserModel();
             $user = $users::findOne(['username'=>$data['sid']]);
             if($user){
                 $user = $user->toArray();
                 $auth = Yii::$app->authManager;
                 $role = $auth->getRolesByUser($user['id']);
                 return $this->render('search',['user'=>$user,'role'=>$role]);
             }
         }

         throw new HttpException('404','没有匹配结果');
    }

    public function actionDelete($role,$userId,$sid)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($role);
        $auth->revoke($role,$userId);
        return $this->redirect(['user-role/search','param[sid]'=>$sid]);
    }
}