<?php
namespace frontend\models;

use yii\base\Model;
use common\models\UserModel;
use Yii;

class UserForm extends Model
{
    public $class;
    public $phone;
    public $qq;
    public $birthday;
    public $appearance;
    public $dorm;

    public $oldPassword;
    public $newPassword;
    public $newPasswordVerity;

    public $_lastError = "";

    /**
     * SCENARIOS_CHANGEPWD 修改密码
     * SCENARIOS_UPDATEINFO 更新个人信息
     */
    const SCENARIOS_CHANGEPWD = 'changepwd';
    const SCENARIOS_UPDATEINFO = 'updateinfo';

    /*
     * 规则
     */
    public function rules()
    {
        return [
            [['class', 'phone', 'qq','birthday', 'appearance', 'dorm',
                'oldPassword', 'newPassword', 'newPasswordVerity'],'required'],

            [['qq'], 'integer'],
            ['phone','match','pattern'=>'/^1[0-9]{10}$/','message'=>'请填写正确的手机号码'],

            ['newPassword', 'string', 'length' => [6, 25]],
            ['newPasswordVerity', 'compare', 'compareAttribute' => 'newPassword','message'=>'两次输入的新密码不一致！']
        ];
    }

    /**
     * 场景设置
     */
    public function scenarios()
    {
        $scenarios =[
            self::SCENARIOS_CHANGEPWD=> ['oldPassword', 'newPassword', 'newPasswordVerity'],
            self::SCENARIOS_UPDATEINFO => ['class', 'phone', 'qq','birthday', 'appearance', 'dorm',],
        ];
        return array_merge(parent::scenarios(),$scenarios);
    }

    /*
     * 更新个人信息
     */
    public function updateInfo()
    {
        $model = new UserModel();
        $user = $model::findOne(['id' => Yii::$app->user->identity->getId()]);
        $user->class = $this->class;
        $user->phone = $this->phone;
        $user->qq = $this->qq;
        $user->birthday = $this->birthday;
        $user->appearance = $this->appearance;
        $user->dorm = $this->dorm;

        if($user->save()){
            return true;
        }else{
            $this->_lastError = '个人信息修改失败！';
        }
        return false;
    }

    /*
     * 获取个人信息内容
     */
    public function getInfo($id)
    {
        $user = UserModel::findOne(['id'=>$id]);

        $this->class = $user->class;
        $this->phone = $user->phone;
        $this->qq = $user->qq;
        $this->birthday = $user->birthday;
        $this->appearance = $user->appearance;
        $this->dorm = $user->dorm;

        return $this;
    }

    /*
     * 修改密码
     */
    public function changePassword()
    {
        $model = new UserModel();
        $user = $model::findOne(['id' => \Yii::$app->user->identity->getId()]);
        if($user->validatePassword($this->oldPassword)){
            $user->setPassword($this->newPassword);
            if($user->save()){
                return true;
            }else{
                $this->_lastError = '新密码保存失败！';
            }
        }else{
            $this->_lastError = '旧密码错误！';
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'oldPassword' => '旧密码',
            'newPassword' => '新密码',
            'newPasswordVerity' => '确认新密码',
            'class' => '班级',
            'phone' => '手机号',
            'qq' => 'QQ',
            'birthday' => '生日',
            'appearance' => '政治面貌',
            'dorm' => '宿舍区',
        ];
    }

    /*
     * 权限授予
     */
    public static function assignAuth($id, $role)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($role);

        if ($auth->assign($role, $id)) {
            return true;
        }

        return false;
    }


    /*
     * 移除权限
     */
    public static function removeAuth($id, $role)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($role);

        if($auth->revoke($role,$id)){
            return true;
        }

        return false;
    }

}