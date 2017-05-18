<?php
namespace frontend\controllers;

use common\models\UserModel;
use frontend\controllers\base\BaseController;
use frontend\models\UserForm;
use Yii;

class SpaceController extends BaseController
{
    public function actionIndex(){
        return $this->render('index');
    }

    public function actionChangePassword()
    {
        $model = new UserForm();
        $model->setScenario(UserForm::SCENARIOS_CHANGEPWD);
        if ($model->load(Yii::$app->request->post())) {
            if($model->changePassword()){
                $this->success('密码修改成功！');
                $model = new UserForm();
            }else{
                $this->error($model->_lastError);
            }
        }

        return $this->render('changepwd', ['model'=>$model]);
    }

    public function actionUpdateInfo()
    {
        $model = new UserForm();
        $model->setScenario(UserForm::SCENARIOS_UPDATEINFO);
        if ($model->load(Yii::$app->request->post())) {
            if($model->updateInfo()){
                $this->success('个人信息修改成功！');
            }else{
                $this->error($model->_lastError);
            }
        }else{
            $model = $model->getInfo(Yii::$app->user->identity->getId());
        }

        return $this->render('updateInfo', ['model'=>$model]);
    }
}