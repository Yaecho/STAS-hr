<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sign_table".
 *
 * @property integer $id
 * @property integer $rid
 * @property string $department
 * @property integer $is_sign
 * @property string $username
 * @property integer $time
 */
class SignTableModel extends \common\models\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sign_table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rid', 'department', 'username', 'time'], 'required'],
            [['rid', 'is_sign', 'time'], 'integer'],
            [['department'], 'string', 'max' => 25],
            [['username'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rid' => 'Rid',
            'department' => 'Department',
            'is_sign' => 'Is Sign',
            'username' => 'Username',
            'time' => 'Time',
        ];
    }
}
