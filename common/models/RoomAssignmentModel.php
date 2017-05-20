<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room_assignment".
 *
 * @property integer $id
 * @property string $department
 * @property string $classroom
 */
class RoomAssignmentModel extends \common\models\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department', 'classroom'], 'required'],
            [['department'], 'string', 'max' => 25],
            [['classroom'], 'string', 'max' => 50],
            [['department'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department' => '部门名称',
            'classroom' => '安排教室',
        ];
    }
}
