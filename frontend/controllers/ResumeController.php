<?php

namespace frontend\controllers;

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
class ResumeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $permissionName = $controller.'/'.$action;
        if(!\Yii::$app->user->can($permissionName) && Yii::$app->getErrorHandler()->exception === null){
            throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
        }
        return true;
    }

    /**
     * Lists all ResumeModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResumeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all ResumeModel models.
     * @return mixed
     */
    public function actionOnlyMyResume()
    {
        $searchModel = new ResumeSearch();
        $queryParams = Yii::$app->request->queryParams;
        $queryParams["ResumeSearch"]['first_wish'] = Yii::$app->user->identity->department;
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

    public function actionOnlyMyView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id,Yii::$app->user->identity->department),
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ResumeModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $first_wish
     * @return ResumeModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id,$first_wish = NULL)
    {
        if ($first_wish === NULL){
            $condition = ['id' => $id];
        }else{
            $condition = ['id' => $id, 'first_wish' => $first_wish];
        }
        if (($model = ResumeModel::findOne($condition)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
