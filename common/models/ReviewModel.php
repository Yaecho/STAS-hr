<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property integer $id
 * @property integer $rid
 * @property integer $star_1
 * @property integer $star_2
 * @property integer $star_3
 * @property integer $star_4
 * @property integer $star_5
 * @property string $content
 * @property integer $iid
 * @property string $iname
 * @property integer $time
 */
class ReviewModel extends \common\models\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rid', 'star_1', 'star_2', 'star_3', 'star_4', 'star_5', 'content', 'iid', 'iname', 'time'], 'required'],
            [['iid', 'time'], 'integer'],
            [['content'], 'string', 'max' => 500],
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
            'star_1' => 'Star 1',
            'star_2' => 'Star 2',
            'star_3' => 'Star 3',
            'star_4' => 'Star 4',
            'star_5' => 'Star 5',
            'content' => 'Content',
            'iid' => 'Iid',
            'iname' => 'Iname',
            'time' => 'Time',
        ];
    }
}
