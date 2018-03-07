<?php

namespace frontend\controllers;

use common\models\ResumeModel;
use common\models\SettingModel;
use frontend\lib\yunpian\lib\SmsOperator;
use Yii;
use yii\data\Pagination;

use frontend\controllers\base\BaseController;
use frontend\models\ResumeForm;

class SmsController extends BaseController
{
    public function actionIndex(){

        $model = new ResumeModel();
        $sms['all'] = $model->find()->where(['not_recycling'=>'1'])->count();
        $sms['is_send'] = $model->find()->where(['not_recycling'=>'1','is_send'=>'1'])->count();
        $sms['res'] = $model->find()->where(['not_recycling'=>'1', 'res' => '1'])->count();

        $model = new SettingModel();
        $smsPost = Yii::$app->request->post('sms_templete');
        $smsData = $model::findOne(['name' => 'sms_templete']);

        if(!empty($smsPost)){
            if (!$smsData){
                $model->name = 'sms_templete';
                $model->value = $smsPost;
            }else{
                $model = $smsData;
                $model->value = $smsPost;
            }
            if($model->save()){
                $this->success('模板保存成功');
            }else{
                $this->error('模板保存失败');
            }
        }

        $smsData = $model::findOne(['name' => 'sms_templete']);
        if (!$smsData){
            $smsData['value'] = '';
        }else{
            $smsData['value'] = $smsData->value;
        }

        return $this->render('index', ['smsCount' => $sms, 'sms_templete' => $smsData['value']]);
    }

    public function actionPhoneNumber()
    {
        $cond = [];
        $curPage = Yii::$app->request->get('page',1);

        $res = ResumeForm::getList($cond, $curPage, 10);
        $pages = new Pagination(['totalCount'=>$res['count'], 'pageSize' => $res['pageSize']]);
        $res['page'] = $pages;

        return $this->render('phone-number', ['data'=>$res]);
    }

    public function actionSmsSend()
    {
        $cache = Yii::$app->cache;
        $data = $cache->get('is_sending'); 
        if ($data === false or $data === 0) { 
            $cache->set('is_sending', 1, 5*60); 
        }
        if ($data === 1) {
            $this->error('短信发送任务进行中，请稍后5分钟后再试。');
            return $this->redirect(['index']);
        }

        ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
        set_time_limit(300);// 通过set_time_limit(0)可以让程序无限制的执行下去

        require_once (__DIR__ . '/../lib/yunpian/config.php');

        $smsOperator = new SmsOperator();

        $totalCount = 0;
        $totalFee =0;

        $partNum = 10;
        $model = new ResumeModel();
        $count = $model::find()->where(['not_recycling' => '1', 'res' => '0', 'is_send' => '0'])->count();
        if($count == 0){
            $this->error('没短信发送，瞎点什么。');
            $cache->set('is_sending', 0, 5*60);
            return $this->redirect(['index']);
        }
        $pageSize = ceil($count/$partNum);

        for($i=0;$i<$partNum;$i++){
            $data = ResumeForm::smsData($pageSize);
            if (empty($data['id'])) continue;

            if (!$data) {
                $this->error('没有短信需要发送。');
                $cache->set('is_sending', 0, 5*60);
                return $this->redirect(['index']);
            }
            $result = $smsOperator->multi_send($data['data']);
            if($result->success){
                $totalCount += $result->responseData['total_count'];
                $totalFee += $result->responseData['total_fee'];
                ResumeForm::updateIsSend($data['id']);
            }
        }
        $cache->set('is_sending', 0, 5*60); 
        $this->success('发送'.$totalCount.'条短信，花费'.$totalFee.'元。');
        
        return $this->redirect(['index']);
    }

    public function actionYunpianApi()
    {
        $api = Yii::$app->request->post('api');
        $setting = new SettingModel();
        if (!empty($api)) {
            $result = $setting->yunpian($api);
            if($result) {
                $this->success('密匙保存成功');
            }else{
                $this->error('密匙保存失败');
            }
        }
        $api = $setting->yunpian();
        return $this->render('yunpian-api', ['data' => $api]);
    }
}
