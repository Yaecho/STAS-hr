<?php
namespace frontend\controllers;

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
        //查询条件
        $cond = [];
        if($search['name'] !=='' or $search['sid'] !== ''){
            $cond = ['or', ['name' => [$search['name']]], ['sid' => [$search['sid']]]];
        }
        $res = ResumeForm::getlist($cond,$curPage,10);
        /*$result['title'] = $this->title?:'最新文章';
        $result['more'] = Url::to(['post/index']);
        $result['body'] = $res['data']?:[];*/


        $pages = new Pagination(['totalCount'=>$res['count'], 'pageSize' => $res['pageSize']]);
        $res['page'] = $pages;

        return $this->render('index',['data'=>$res,'search'=>$search]);
    }

    public function actionSign($id)
    {
        $model = new ResumeForm();
        if($model->signSave($id)){
            return 'success';
        }else{
            return 'fail';
        }
    }
}