<?php

namespace frontend\controllers;

use frontend\controllers\base\BaseController;
use frontend\models\ResumeForm;
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
    /**
     * Lists all ResumeModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResumeSearch();
        $queryParams = Yii::$app->request->queryParams;

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
            'model' => ResumeForm::findModelById($id),
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
        $model = ResumeForm::findModelById($id);

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
        $model = ResumeForm::findModelById($id);
        $model->not_recycling = '0';
        if($model->save()){
            $this->success('移至回收站成功');
        }else{
            $this->error('移至回收站失败');
        }

        return $this->redirect(['index']);
    }

}
