<?php
namespace frontend\controllers\base;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class BaseController extends Controller
{

    public function beforeAction($action,$other = Null)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (isset(Yii::$app->user->identity->id) and Yii::$app->user->identity->id === 1){
            if ($other !== Null){
                return 'othersuccess';
            }
            return true;
        }

        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;

        if ($controller === 'site'){
            return true;
        }
        if (\Yii::$app->user->getIsGuest()) {
            return $this->redirect(['/site/login']);
        }


        $permissionName = $controller.'/'.$action;
        $permissionCan = (\Yii::$app->user->can($permissionName) or \Yii::$app->user->can(($controller.'/*')));

        if ($other !== Null){
           if ($permissionCan and \Yii::$app->user->can($other))
               return 'othersuccess';
        }


        if(!$permissionCan && Yii::$app->getErrorHandler()->exception === null){

            throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
        }
        return true;
    }
}