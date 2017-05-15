<?php
namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use common\models\ResumeSearch;
use frontend\models\ResumeForm;
use Yii;

/*
 * 回收站
 */
class RecycleController extends BaseController
{
    public function actionRecycle()
    {
        $searchModel = new ResumeSearch();
        $queryParams = Yii::$app->request->queryParams;
        $queryParams["ResumeSearch"]['not_recycling'] = '0';
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('recycle', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRestore($id)
    {
        $model = ResumeForm::findModelById($id,'0');
        $model->not_recycling = '1';

        if($model->save()){
            $this->success('恢复成功');
        }else{
            $this->error('恢复失败');
        }

        return $this->redirect(['recycle']);
    }

    public function actionTrueDelete($id)
    {
        $model = new ResumeForm();

        if($model->trueDetele($id)){
            $this->success('删除成功');
        }else{
            $this->error($model->_lastError);
        }

        return $this->redirect(['recycle']);
    }
}