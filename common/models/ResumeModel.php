<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "resume".
 *
 * @property integer $id
 * @property string $name
 * @property string $sex
 * @property string $birthday
 * @property string $place
 * @property string $identity
 * @property string $college
 * @property string $class
 * @property string $dorm
 * @property string $phone
 * @property string $qq
 * @property string $first_wish
 * @property string $second_wish
 * @property string $myself
 * @property string $hope
 * @property integer $created_time
 * @property string $hobbies
 * @property string $sid
 * @property integer $is_send
 * @property string $code
 * @property integer $res
 * @property integer $not_recycling
 */
class ResumeModel extends \common\models\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resume';
    }

    /**
     * 关联关系
     */
    public function getSign()
    {
        return $this->hasOne(SignTableModel::className(), ['rid'=>'id']); //一对一关系
    }

    public function getHire()
    {
        return $this->hasOne(HireModel::className(), ['rid'=>'id']); //一对一关系
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sex', 'birthday', 'place', 'identity', 'college', 'class', 'dorm', 'phone', 'first_wish', 'second_wish', 'myself', 'hope', 'created_time', 'hobbies', 'sid', 'code'], 'required'],
            [['created_time', 'not_recycling', 'res'], 'integer'],
            [['name'], 'string', 'max' => 25],
            [['sex'], 'string', 'max' => 1],
            [['birthday'], 'string', 'max' => 8],
            [['place', 'college', 'class', 'dorm'], 'string', 'max' => 30],
            [['identity', 'first_wish', 'second_wish', 'sid'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 11],
            [['qq'], 'string', 'max' => 15],
            [['myself', 'hope', 'hobbies'], 'string', 'max' => 535],
            [['code'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
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
            'not_recycling' => '回收站标志',
            'is_send' => '短信发送状态',
            'code' => '短信确认码',
            'res' => '短信确认',
        ];
    }
}
