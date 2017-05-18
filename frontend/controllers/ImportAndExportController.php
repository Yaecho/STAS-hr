<?php

namespace frontend\controllers;

use common\widgets\Csv;
use frontend\controllers\base\BaseController;
use frontend\models\ResumeForm;
use frontend\models\UserForm;

class ImportAndExportController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUploadCsv()
    {
        $csv = new Csv();
        $csv->startRow = 1;
        $csv->startColumn= 1;
        $data = $csv->importCSV();

        $res = UserForm::addAll($data);
        if(!$res){
            $this->error('导入用户失败！');
        }else{
            $this->success('导入'.$res.'个用户');
        }
        return $this->redirect(['index']);
    }

    public function actionDownloadCsv()
    {
        $data = ResumeForm::exportData();
        $csv = new Csv();
        $header = new ResumeForm();
        $headerData = $header->attributeLabels();

        $headerData[] = '签到';
        $headerData[] = '录用';

        $csv->header = $headerData;
        $csv->writeCSVDown('resume-'.date('Y-m-d H:i', time()).'.csv', $data);
    }

    public function actionTemplate()
    {
        $csv = new Csv();
        $data = [];
        $csv->header = ['序号', '姓名', '学号', '密码', '班级', '手机', 'QQ', '部门', '职务', '出生年月', '政治面貌', '宿舍区'];
        $csv->writeCSVDown('user.csv', $data);
    }
}