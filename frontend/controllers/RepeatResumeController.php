<?php
namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use Yii;
use yii\data\Pagination;
use frontend\models\ResumeForm;

class RepeatResumeController extends BaseController
{
    public function actionIndex()
    {
        $curPage = Yii::$app->request->get('page',1);

        $res = $this->getRepeatResume($curPage);
        $pages = new Pagination(['totalCount'=>$res['count'], 'pageSize' => $res['pageSize']]);
        $res['page'] = $pages;

        return $this->render('index', ['data' => $res,]);
    }

    public function actionDelete($id)
    {
        $model = new ResumeForm();

        if($model->recycling($id)){
            $this->success('移至回收站成功');
        }else{
            $this->error($model->_lastError);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    private function getRepeatResume($curPage = 1, $pageSize = 10)
    {
        $connection = Yii::$app->getDb();

        $count = $connection->createCommand('SELECT count(*) as num FROM resume WHERE sid in ( SELECT sid FROM resume WHERE not_recycling = 1 GROUP BY sid HAVING count(sid)>1) ORDER BY sid');
        $count = $count->queryOne();

        $data['count'] = $count['num'];
        if(!$data['count']){
            return ['count'=>0, 'curPage'=>$curPage, 'pageSize'=>$pageSize, 'start'=>0, 'end'=>0, 'data'=>[]];
        }

        //超出实际页数，不取curPage
        $curPage = (ceil($data['count']/$pageSize)<$curPage)
            ?ceil($data['count']/$pageSize):$curPage;
        //当前页
        $data['curPage'] = $curPage;
        //每页显示条数
        $data['pageSize'] = $pageSize;

        $data['start'] = ($curPage-1)*$pageSize+1;
        $data['end'] = (ceil($data['count']/$pageSize) == $curPage)?$data['count']:($curPage-1)*$pageSize+$pageSize;

        $start = ($curPage-1)*$pageSize;
        $end = $start + $pageSize;
        $command = $connection->createCommand("SELECT id,name,sid,sex,first_wish,second_wish,created_time FROM resume WHERE sid in ( SELECT sid FROM resume  WHERE not_recycling = 1 GROUP BY sid HAVING count(sid)>1) ORDER BY sid LIMIT :start,:end", [':start' => $start, ':end' => $end]);

        $data['data'] = $command->queryAll();

        return $data;
    }
}