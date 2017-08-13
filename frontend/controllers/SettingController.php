<?php
namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use Yii;
use common\models\SettingModel;


class SettingController extends BaseController
{
    /*
    *设置主页
    */
    public function actionIndex()
    {
        $iUrl = Yii::$app->request->post('iUrl');
        $setting = new SettingModel();
        if (!empty($iUrl)) {
            $result = $setting->IUrl($iUrl);
            if($result) {
                $this->success('网址保存成功');
            }else{
                $this->error('网址保存失败');
            }
        }

        $data = SettingModel::find()->where(['or',['name'=>'resume'],['name'=>'rescode'], ['name' => 'i_url']])->asArray()->all();
        foreach( $data as $k=>$v){
            $data[$v['name']] = $v['value'];
            unset($data[$k]);
        }
    
        return $this->render('index', ['data' => $data]);
    }

    /*
    * 动作开关
    */
    public function actionSwitch()
    {
        $action = Yii::$app->request->post('action');
        $value = Yii::$app->request->post('value');
        if($action!=='' and $value!==''){
            $model = new SettingModel();
            $res = $model::findOne(['name' => $action]);
            if(!$res){
                return 'fail';
            }

            $res->value = $value;
            
            return $res->save()?'success':'fail';
        }
    }

}