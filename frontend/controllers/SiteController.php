<?php
namespace frontend\controllers;


use frontend\controllers\base\BaseController;
use frontend\models\ResumeForm;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
//use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'cv.php';
        $model = new ResumeForm();
        //定义场景
        $model->setScenario(ResumeForm::SCENARIOS_CREATE);
        if($model->load(Yii::$app->request->post())) {
            if (!$model->validate()) {
                return json_encode(['code' => '0','msg' => '表单格式错误']);
            }
            if (!$model->create()) {
                return json_encode(['code' => '0','msg' => '数据保存失败']);
            } else {
                return json_encode(['code' => '1','msg' => '简历提交成功']);
            }
        }
        return $this->render('index');
    }

    public function actionSmsRes()
    {
        $this->layout = 'cv.php';

        $model = new ResumeForm();
        $model->setScenario(ResumeForm::SCENARIOS_SMSRES);
        if($model->load(Yii::$app->request->post())) {
            if (!$model->validate()) {
                return json_encode(['code' => '0','msg' => '短信确认码错误']);
            }
            if ($model->codeCheck()) {
                return json_encode(['code' => '1','msg' => '提交成功']);
            } else {
                return json_encode(['code' => '0','msg' => '短信确认码错误']);
            }
        }
        return $this->render('smsres');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'login.php';

        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['space/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['space/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }





}
