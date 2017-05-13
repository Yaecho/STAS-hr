<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hire".
 *
 * @property integer $id
 * @property integer $rid
 * @property integer $iid
 * @property string $iname
 * @property integer $time
 */
class HireModel extends \common\models\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hire';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rid', 'iid', 'iname', 'time'], 'required'],
            [['rid'], 'unique'],
            [['time'], 'integer'],
            [['iname'], 'string', 'max' => 25],
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
            'iid' => 'Iid',
            'iname' => 'Iname',
            'time' => 'Time',
        ];
    }
}
