<?php
namespace frontend\controllers;

use common\models\ResumeModel;
use common\models\ReviewModel;
use common\models\SignTableModel;
use frontend\models\ResumeForm;
use frontend\models\ReviewForm;
use frontend\models\SignTableForm;
use Yii;
use frontend\controllers\base\BaseController;
use yii\data\Pagination;

class InterviewerController extends BaseController
{
    public $layout = 'gandi.php';

    public function actionIndex()
    {
        $search = Yii::$app->request->post('Search',['name'=>'','sid'=>'','signId'=>'']);

        $curPage = Yii::$app->request->get('page',1);
        //查询条件
        $cond = [];
        if($search['name'] !=='' or $search['sid'] !== ''){
            $cond = ['or', ['name' => [$search['name']]], ['sid' => [$search['sid']]]];
            $res = ResumeForm::getlist($cond,$curPage,10);
            $data = [];
            foreach ($res['data'] as $k1=>$v1){
                $data[$k1]['id'] = $v1['sign']['id'];
                $data[$k1]['time'] = $v1['sign']['time'];
                foreach ($v1 as $k2=>$v2){
                    $data[$k1]['resume'][$k2] = $v2;
                }
            }
            unset($res['data']);
            $res['data'] = $data;
            //var_dump($res);
            //die();
        }else{
            if ($search['signId'] !== ''){
                $cond = ['id' => $search['signId']];
            }
            $res = SignTableForm::getlist($cond,$curPage,10);
        }

        $pages = new Pagination(['totalCount'=>$res['count'], 'pageSize' => $res['pageSize']]);
        $res['page'] = $pages;

        return $this->render('index', ['data'=>$res,'search'=>$search]);
    }

    public function actionDetail($id)
    {
        $model = new ResumeModel();
        $rModel = new ReviewModel();
        $reviews = $rModel::find()->where(['rid'=>$id])->asArray()->all();
        $res = $model::findOne(['id'=>$id])->toArray();
        return $this->render('detail',['data'=>$res,'reviews'=>$reviews,'department'=>\Yii::$app->params['department']]);
    }

    public function actionReview()
    {
        $model = new ReviewForm();

        if($model->load(Yii::$app->request->post())){
            if ($model->validate() and $model->create()) {
                Yii::$app->getSession()->setFlash('success', "评价提交成功！");
            }else{
                Yii::$app->getSession()->setFlash('error', "评价提交失败！");
            }
        }

        return $this->redirect(['detail','id'=>$model->rid]);

    }

    public function actionTransfer()
    {
        $model = new SignTableModel();
        $rid = Yii::$app->request->post('rid');
        $department = Yii::$app->request->post('department');

        $res = $model::findOne(['rid'=>$rid]);

        if ($res){
            $res->department = $department;
            if($res->save()){
                Yii::$app->getSession()->setFlash('success', "简历推送成功！");
                return $this->redirect(['index']);
            }
        }
        Yii::$app->getSession()->setFlash('error', "简历推送失败！");
        return $this->redirect(['index']);
    }
}
