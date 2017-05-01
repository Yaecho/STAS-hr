<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use phpDocumentor\Reflection\Types\Null_;
use Yii;
use common\models\ResumeModel;
use common\models\ResumeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResumeController implements the CRUD actions for ResumeModel model.
 */
class ResumeController extends BaseController
{
    public $allResume = false;

    public function beforeAction($action,$other = Null)
    {
        $dangerAction = ['recycle','restore','true-delete'];
        $act = Yii::$app->controller->action->id;
        if(in_array($act,$dangerAction)){
            $res = parent::beforeAction($action,Null);
            if ($res === true){
                $this->allResume = true;
                return true;
            }else{
                throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
            }
        } else {
            $res = parent::beforeAction($action,'[EditAllResume]');
        }

        if ($res === false){
            throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
        }

        if ($res === 'othersuccess') {
            $this->allResume = true;
            return true;
        }

        if ($res === true) {
            return true;
        }
    }

    /**
     * Lists all ResumeModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResumeSearch();
        $queryParams = Yii::$app->request->queryParams;
        if(!$this->allResume){
            $queryParams["ResumeSearch"]['first_wish'] = Yii::$app->user->identity->department;
            $queryParams["ResumeSearch"]['created_time'] = '';
        }
        $queryParams["ResumeSearch"]['not_recycling'] = '1';
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single ResumeModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing ResumeModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ResumeModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->not_recycling = '0';
        $model->save();

        return $this->redirect(['index']);
    }

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

        $model = $this->findModel($id,NULL,'0');
        $model->not_recycling = '1';
        $model->save();

        return $this->redirect(['recycle']);
    }

    public function actionTrueDelete($id)
    {
        $model = $this->findModel($id,NULL,'0');
        $model->delete();

        return $this->redirect(['recycle']);
    }

    /**
     * Finds the ResumeModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $first_wish
     * @return ResumeModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id,$first_wish = NULL,$not_recycling = '1')
    {
        if ($first_wish === NULL and $this->allResume){
            $condition = ['id' => $id, 'not_recycling' => $not_recycling];
        }else{
            $condition = ['id' => $id, 'not_recycling' => $not_recycling, 'first_wish' => Yii::$app->user->identity->department];
        }
        if (($model = ResumeModel::findOne($condition)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
