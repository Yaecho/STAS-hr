<?php
namespace frontend\models;

use common\models\HireModel;
use common\models\ReviewModel;
use common\models\SignTableModel;
use Yii;
use common\models\ResumeModel;
use yii\base\Model;
use common\models\SettingModel;

class ResumeForm extends Model
{
    public $id;
    public $name;
    public $sex;
    public $birthday;
    public $place;
    public $identity;
    public $college;
    public $class;
    public $dorm;
    public $phone;
    public $qq;
    public $first_wish;
    public $second_wish;
    public $myself;
    public $hope;
    public $hobbies;
    public $sid;
    public $not_recycling = 1;
    public $is_send = 0;
    public $code = '0';
    public $res = 0;

    public $_lastError = "";

    /**
     * SCENARIOS_CREATE 创建场景
     * SCENARIOS_UPDATE 更新场景
     * SCENARIOS_SMSRES 短信更新场景
     */
    const SCENARIOS_CREATE = 'create';
    const SCENARIOS_UPDATE = 'update';
    const SCENARIOS_SMSRES= 'smsres';

    /**
     * 定义事件
     */
    const EVENT_AFTER_CREATE = 'eventAfterCreate';
    const EVENT_AFTER_UPDATE = 'eventAfterUpdate';
    const EVENT_AFTER_DETELE = 'eventAfterDetele';

    public function rules()
    {
        return [
            [['name', 'sex', 'birthday', 'place', 'identity', 'college', 'class', 'dorm', 'phone',
                'first_wish', 'second_wish', 'myself', 'hope', 'hobbies', 'sid'], 'required'],
            [['id', 'sid', 'not_recycling', 'phone','qq', 'res'], 'integer'],
            [['name'], 'string', 'max' => 25],
            [['sex'], 'string', 'max' => 1],
            [['birthday'], 'string', 'max' => 8],
            [['place', 'college', 'class', 'dorm'], 'string', 'max' => 30],
            [['identity', 'first_wish', 'second_wish'], 'string', 'max' => 10],
            [['myself', 'hope', 'hobbies'], 'string', 'max' => 535],

            ['phone','match','pattern'=>'/^1[0-9]{10}$/','message'=>'请填写正确的手机号码'],
            ['sid','match','pattern'=>'/^\d{10}$/','message'=>'请输入十位{attribute}'],

        ];
    }

    /**
     * 场景设置
     */
    public function scenarios()
    {
        $scenarios =[
            self::SCENARIOS_CREATE => ['name', 'sex', 'birthday', 'place', 'identity', 'college', 'class', 'dorm', 'phone',
                'qq', 'first_wish', 'second_wish', 'myself', 'hope', 'hobbies', 'sid'],
            self::SCENARIOS_UPDATE => [ 'phone', 'qq', 'first_wish', 'second_wish', 'sid'],
            self::SCENARIOS_SMSRES => ['code'],
        ];
        return array_merge(parent::scenarios(),$scenarios);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'sex' => '性别',
            'birthday' => '出生年月',
            'place' => '籍贯',
            'identity' => '政治面貌',
            'college' => '学院',
            'class' => '班级',
            'dorm' => '宿舍',
            'phone' => '手机',
            'qq' => 'QQ',
            'first_wish' => '第一志愿',
            'second_wish' => '第二志愿',
            'myself' => '自我介绍',
            'hope' => '学习工作设想',
            'created_time' => '创建时间',
            'hobbies' => '兴趣爱好',
            'sid' => '学号',
            'is_send' => '短信发送状态',
            'code' => '短信确认码',
            'res' => '短信确认',
            'not_recycling' => '回收站标志',
        ];
    }

    public function create()
    {
        //事务
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $model = new ResumeModel();
            $model->setAttributes($this->attributes);
            $model->created_time = time();
            if(!$model->save()){
                throw new \Exception('简历提交失败！');
            }
            $this->id = $model->id;

            $data = array_merge($this->getAttributes(),$model->getAttributes());
            $this->_eventAfterCreate($data);

            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            $this->_lastError =$e->getMessage();
            return false;
        }
    }

    public function _eventAfterCreate($data)
    {
        $this->on(self::EVENT_AFTER_CREATE,[$this,'_eventAddCode'],$data);//添加事件
        //off取消
        $this->trigger(self::EVENT_AFTER_CREATE);//触发事件
    }

    public function _eventAddCode($event)
    {
        $model = new ResumeModel();
        $id = $event->data['id'];
        $code =  $event->data['created_time'].$id;
        $code = substr($code,-6);


        $result = $model->updateAll(['code'=>$code],['id'=>$id]);

        if (!$result)
            throw new \Exception('添加短信确认码失败!');

    }

    /*
     * 短信确认码检查
     */
    public function codeCheck()
    {
        $code = $this->code;
        $model = ResumeModel::find()->where(['code'=>$code])->one();

        if(!$model)
            return false;
        $model->res = 1;

        if (!$model->save())
            return false;

        return true;
    }

    /*
     * 将签到数据写入sign_table
     */
    public function signSave($id)
    {
        $model = new ResumeModel();
        $data = $model::find()->where(['not_recycling'=>'1','id'=>$id])->select('first_wish')->one()->toArray();
        if($data) {
            $signModel = new SignTableModel();
            $signModel->rid = $id;
            $signModel->department = $data['first_wish'];
            $signModel->is_sign = 1;
            $signModel->username = Yii::$app->user->identity->username;
            $signModel->time = time();
            return $signModel->save() ? $signModel->time : false;
        }else{
            return false;
        }
    }

    /*
     * 移至回收站
     */
    public function recycling($id)
    {
        $model = self::findModelById($id);
        $model->not_recycling = '0';
        if($model->save()){
            return true;
        }else{
            $this->_lastError = '移至回收站失败';
            return false;
        }
    }

    /*
     * 删除简历及关联表
     */
    public function trueDetele($id)
    {
        //事务
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $model = self::findModelById($id,'0');

            if(!$model->delete()){
                throw new \Exception('简历删除失败！');
            }

            $this->_eventAfterTrueDetele($id);

            $transaction->commit();
            return true;
        }catch (\Exception $e){
            $transaction->rollBack();
            $this->_lastError =$e->getMessage();
            return false;
        }
    }

    public function _eventAfterTrueDetele($id)
    {
        $this->on(self::EVENT_AFTER_DETELE,[$this,'_eventRemoveRelation'],$id);//添加事件
        //off取消
        $this->trigger(self::EVENT_AFTER_DETELE);//触发事件
    }

    /*
     * 移除关联表
     */
    public function _eventRemoveRelation($event)
    {
        $id = $event->data;

        if(SignTableModel::findAll(['rid'=>$id])){
            $signs = SignTableModel::deleteAll(['rid'=>$id]);
        }else{
            $signs = true;
        }

        if(ReviewModel::findAll(['rid'=>$id])){
            $reviews = ReviewModel::deleteAll(['rid'=>$id]);
        }else{
            $reviews = true;
        }

        if(HireModel::findAll(['rid'=>$id])){
            $hires = HireModel::deleteAll(['rid'=>$id]);
        }else{
            $hires = true;
        }

        $result = ($signs and $reviews and $hires);
        if (!$result)
            throw new \Exception('移除关联表失败!');

    }


    /*
     * 获得简历列表
     */
    public static function getList($cond, $curPage = 1,$pageSize = 5, $orderBy = ['resume.id' => SORT_DESC], $isGuide = false )
    {
        $model = new ResumeModel();
        //查询语句
        if (Yii::$app->user->can('[EditAllResume]') or $isGuide){
            $cond = ['and', ['not_recycling'=>'1'], $cond];
        }else{
            $cond = ['and', ['not_recycling'=>'1', 'first_wish' => Yii::$app->user->identity->department], $cond];
        }
        $select = 'resume.id,resume.name,resume.sex,resume.phone,resume.first_wish,resume.second_wish,resume.sid';

        $query = $model->find()
            ->joinWith(['sign', 'hire'])
            //->select("sign_table.*, hire.*, resume.*");
            ->select($select)
            ->where($cond)
            //->with('sign')
            ->orderBy($orderBy);
        //获取分页数据
        $res = $model->getPages($query, $curPage, $pageSize);

        return $res;

    }

    /*
     * 通过id查找单个简历
     * id
     * not_recycling
     */
    public static function findModelById($id,$not_recycling = '1')
    {

        if (Yii::$app->user->can('[EditAllResume]')){
            $condition = ['id' => $id, 'not_recycling' => $not_recycling];
        }else{
            $condition = ['id' => $id, 'not_recycling' => $not_recycling, 'first_wish' => Yii::$app->user->identity->department];
        }

        $model = ResumeModel::findOne($condition);

        return $model;
    }

    /*
     * 导出简历
     */
    public static function exportData($cond = [])
    {
        $model = new ResumeModel();
        $data = $model::find()->with(['sign', 'hire'])->where($cond)->asArray()->all();

        foreach ($data as $k=>$v){
            $data[$k]['created_time'] = date('m-d H:i', $v['created_time']);
            $data[$k]['sign'] = empty($v['sign'])?'0':'1';
            $data[$k]['hire'] = empty($v['hire'])?'0':'1';
        }

        return $data;
    }

    /*
    * 短信
    */
    public static function smsData($curPage)
    {
        $model = new SettingModel();
        $smsData = $model::findOne(['name' => 'smscontect']);
        $smsTemplate = explode('$code$',$smsData->value);
        
        $model = new ResumeModel();
        $count = $model::find()->where(['not_recycling' => '1', 'res' => '0'])->count();
        if($count == 0){
            return false;
        }
        $pageSize = ceil($count/3);
        $resumes = $model::find()->select(['phone', 'code'])->where(['not_recycling' => '1', 'res' => '0'])
        ->offset($curPage*$pageSize)->limit($pageSize)->asArray()->all();
        
        $data['mobile'] = '';$data['text'] = '';
        foreach($resumes as $v){
            $data['mobile'] .= $v['phone'].',';
            $data['text'] .= $smsTemplate[0].$v['code'].$smsTemplate[1].',';
        }
        return $data;
    }

}