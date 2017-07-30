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
        //$sms['is_send'] = $model->find()->where(['not_recycling'=>'1','is_send'=>'1'])->count();
        $sms['res'] = $model->find()->where(['not_recycling'=>'1','res'=>'1'])->count();

        $model = new SettingModel();
        $smsPost = Yii::$app->request->post('smscontect');
        $smsData = $model::findOne(['name' => 'smscontect']);

        if(!empty($smsPost)){
            if (!$smsData){
                $model->name = 'smscontect';
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

        $smsData = $model::findOne(['name' => 'smscontect']);
        if (!$smsData){
            $smsData['value'] = '';
        }else{
            $smsData['value'] = $smsData->value;
        }

        return $this->render('index', ['smsCount' => $sms, 'smsContect' => $smsData['value']]);
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
        require_once (__DIR__ . '/../lib/yunpian/config.php');

        $smsOperator = new SmsOperator();

        $status = true;
        $totalCount = 0;
        $totalFee =0;

        for($i=0;$i<3;$i++){
            $data = ResumeForm::smsData($i);
            $result = $smsOperator->multi_send($data);
            $status = ($status and $result->success);
            if($result->success){
                $totalCount += $result->responseData['total_count'];
                $totalFee += $result->responseData['total_fee'];
            }
        }
        
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
