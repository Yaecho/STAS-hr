<?php
namespace frontend\controllers;

use common\models\HireModel;
use common\models\ResumeModel;
use common\models\ReviewModel;
use common\models\SignTableModel;
use frontend\models\ResumeForm;
use frontend\models\ReviewForm;
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
        $cond = ['sign_table.is_sign'=>'1'];

        if($search['name'] !=='' or $search['sid'] !== '' or $search['signId'] !== ''){
            $cond = ['and', $cond,
                [
                    'or',
                    ['resume.name' => [$search['name']]],
                    ['resume.sid' => [$search['sid']]],
                    ['sign_table.id' => [$search['signId']]],
                ],
            ];
        }

        $res = ResumeForm::getlist($cond,$curPage,10, ['sign_table.id' => SORT_DESC]);

        $pages = new Pagination(['totalCount'=>$res['count'], 'pageSize' => $res['pageSize']]);
        $res['page'] = $pages;

        return $this->render('index', ['data'=>$res,'search'=>$search]);
    }

    /*
     * 简历详情
     */
    public function actionDetail($id)
    {
        if(!$this->queryCheck($id)){
            return $this->redirect(['index']);
        }

        $rModel = new ReviewModel();
        $reviews = $rModel::find()->where(['rid'=>$id])->asArray()->all();

        $res = ResumeModel::find()->where(['id'=>$id, 'not_recycling' => '1'])->with('sign','hire')->asArray()->one();

        if(!$res){
            $this->error('没有权限查看此简历！');
            return $this->redirect(['index']);
        }

        return $this->render('detail',['data'=>$res,'reviews'=>$reviews,]);
    }

    /*
     * 评价
     */
    public function actionReview()
    {
        $model = new ReviewForm();

        if($model->load(Yii::$app->request->post())){

            if(!$this->queryCheck($model->rid)){
                return $this->redirect(['index']);
            }

            if ($model->validate() and $model->create()) {
                $this->success('评价提交成功！');
            }else{
                $this->error('评价提交失败！');
            }
        }

        return $this->redirect(['detail','id'=>$model->rid]);

    }

    /*
     * 推送简历
     */
    public function actionTransfer()
    {
        $rid = Yii::$app->request->post('rid');
        $department = Yii::$app->request->post('department');

        if(!$this->queryCheck($rid)){
            return $this->redirect(['index']);
        }

        $model = new SignTableModel();
        $res = $model::findOne(['rid'=>$rid]);

        if ($res){
            $res->department = $department;
            if($res->save()){
                $this->success('简历推送成功！');
                return $this->redirect(['index']);
            }
        }
        $this->error('简历推送失败！');
        return $this->redirect(['index']);
    }

    /*
     * 标记录用
     */
    public function actionHire()
    {
        $hireAction = Yii::$app->request->post('hireAction');
        $rid = Yii::$app->request->post('rid');

        if(!$this->queryCheck($rid)){
            return $this->redirect(['index']);
        }

        $model = new HireModel();

        if($hireAction === 'save') {
            $model->rid = $rid;
            $model->iid = Yii::$app->user->identity->getId();
            $model->iname = Yii::$app->user->identity->department . '-' . Yii::$app->user->identity->truename;
            $model->time = time();
            if ($model->save()) {
                $this->success('标记录用成功！');
            } else {
                $this->error('标记录用失败！');
            }
        }

        if($hireAction === 'delete'){
            $res = $model::findOne(['rid'=>$rid]);
            $userId = Yii::$app->user->getId();

            if($userId !== 1 and $res->iid !== $userId){
                $this->error('请使用超管帐号或标记本简历的帐号取消录用！');
            }else{
                if($res->delete()){
                    $this->success('取消录用成功！');
                }else{
                    $this->error('取消录用失败！');
                }
            }
        }

        return $this->redirect(['detail','id'=>$rid]);

    }

    private function queryCheck($rid){
        if (!Yii::$app->user->can('[EditAllResume]')) {
            $signData = SignTableModel::findOne(['rid' => $rid]);
            if (empty($signData->department) or Yii::$app->user->identity->department !== $signData->department) {
                $this->error('没有权限查看编辑此简历！');
                return false;
            }
        }
        return true;
    }
}
