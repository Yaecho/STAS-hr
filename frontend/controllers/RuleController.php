<?php
namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use Yii;
use yii\db\Query;


class RuleController extends BaseController
{
    public $authManager;

    public $enableCsrfValidation = false;
    /**
     * ---------------------------------------
     * 构造方法
     * ---------------------------------------
     */
    public function init(){
        parent::init();
        $this->authManager = Yii::$app->authManager;
    }

    public function actionIndex()
    {
        $ruleList  = (new Query())
            ->select(['name','description','created_at','updated_at'])
            ->from('auth_item')
            ->where(['type'=>'2'])
            ->all();
        //var_dump($ruleList);exit();
        return $this->render('index',['rule' => $ruleList]);
    }

    public function actionAdd()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('param');

            if ($data['name']!=='' and $data['description']!==''){
                $rule = Yii::$app->authManager->createPermission($data['name']);
                $rule->type = 2;
                $rule->description = $data['description'];
                if (Yii::$app->authManager->add($rule)) {
                    return $this->redirect(['rule/index']);
                }
            }

        }
        return $this->render('add');
    }

    public function actionEdit($rule){

        $rule = Yii::$app->authManager->getPermission($rule);
        $ruleName = $rule->name;

        if (Yii::$app->request->isPost) {

            $data = Yii::$app->request->post('param');
            if ($data['name']!=='' and $data['description']!=='') {
                $rule->name = $data['name'];
                $rule->description = $data['description'];
                if (Yii::$app->authManager->update($ruleName, $rule)) {
                    return $this->redirect(['rule/index']);
                }
            }

        }

        return $this->render('edit',[
            'rule' => $rule,
        ]);
    }

    public function actionDelete($rule){
        $rule = Yii::$app->authManager->getPermission($rule);
        if (Yii::$app->authManager->remove($rule)) {
            return $this->redirect(['rule/index']);
        }
    }

}