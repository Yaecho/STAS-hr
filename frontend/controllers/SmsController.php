<?php

namespace frontend\controllers;

use common\models\ResumeModel;
use common\models\SettingModel;
use Yii;
use yii\data\Pagination;

use frontend\controllers\base\BaseController;
use frontend\models\ResumeForm;

class SmsController extends BaseController
{
    public function actionIndex()
    {

        $model = new ResumeModel();
        $sms['all'] = $model->find()->where(['not_recycling' => '1'])->count();
        $sms['is_send'] = $model->find()->where(['not_recycling' => '1', 'is_send' => '1'])->count();
        $sms['res'] = $model->find()->where(['not_recycling' => '1', 'res' => '1'])->count();

        $model = new SettingModel();
        $smsPost = Yii::$app->request->post('sms_templete');
        $smsData = $model::findOne(['name' => 'sms_templete']);

        if (!empty($smsPost)) {
            $smsData->value = $smsPost;
            if ($smsData->save()) {
                $this->success('模板保存成功');
            } else {
                $this->error('模板保存失败');
            }
        }

        $sendSms = $model::findOne(['name' => 'send_sms'])->value;
        $smsData['value'] = $smsData->value ?: '';

        return $this->render('index', ['smsCount' => $sms, 'sms_templete' => $smsData['value'], 'send_sms' => $sendSms]);
    }

    public function actionPhoneNumber()
    {
        $cond = [];
        $curPage = Yii::$app->request->get('page', 1);

        $res = ResumeForm::getList($cond, $curPage, 10);
        $pages = new Pagination(['totalCount' => $res['count'], 'pageSize' => $res['pageSize']]);
        $res['page'] = $pages;

        return $this->render('phone-number', ['data' => $res]);
    }

    public function actionSmsSend()
    {
        $setting = new SettingModel();
        if ($setting->changeSendSms()) {
            $this->success('短信发送服务状态修改成功');
        } else {
            $this->error('短信发送服务状态修改失败');
        }
        return $this->redirect(['index']);
    }

    public function actionYunpianApi()
    {
        $api = Yii::$app->request->post('api');
        $setting = new SettingModel();
        if (!empty($api)) {
            $result = $setting->yunpian($api);
            if ($result) {
                $this->success('密匙保存成功');
            } else {
                $this->error('密匙保存失败');
            }
        }
        $api = $setting->yunpian();
        return $this->render('yunpian-api', ['data' => $api]);
    }
}
