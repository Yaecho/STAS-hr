<?php
namespace frontend\controllers;

use common\models\RoomAssignmentModel;
use common\models\SignTableModel;
use Yii;
use frontend\controllers\base\BaseController;
use frontend\models\ResumeForm;
use yii\data\Pagination;
use yii\helpers\Url;

class GuideController extends BaseController
{
    public $layout = 'gandi.php';

    public function actionIndex()
    {
        $search['name'] = Yii::$app->request->post('name','');
        $search['sid'] = Yii::$app->request->post('sid','');
        $curPage = Yii::$app->request->get('page',1);
        $cond = [];
        if($search['name'] !=='' or $search['sid'] !== ''){
            $cond = ['or', ['name' => [$search['name']]], ['sid' => [$search['sid']]]];
        }
        $res = ResumeForm::getlist($cond,$curPage,10, ['resume.id' => SORT_DESC], true);

        $pages = new Pagination(['totalCount'=>$res['count'], 'pageSize' => $res['pageSize']]);
        $res['page'] = $pages;

        return $this->render('index',['data'=>$res,'search'=>$search]);
    }

    public function actionSign($id)
    {
        $model = new ResumeForm();
        $data = $model->signSave($id);
        if($data !== false){
            return date('m-d H:i',$data);
        }else{
            return 'fail';
        }
    }

    public function actionGetRoom($id)
    {
        $sModel = new SignTableModel();
        $sData = $sModel::findOne(['rid'=>$id]);

        if($sData){
            $sData = $sData->toArray();
            $rModel = new RoomAssignmentModel();
            $rData = $rModel::findOne(['department'=>$sData['department']]);
            if ($rData){
                $rData = $rData->toArray();
                return '面试地点：'.$rData['classroom'].'<br>签到号：'.$sData['id'];
            }
        }

        return '查询不到数据！';

    }
}