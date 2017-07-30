<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sms".
 *
 * @property string $name
 * @property string $value
 */
class SettingModel extends \common\models\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['value'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    public function yunpian($api = null)
    {
        if (is_null($api)) {
            return self::findOne(['name' => 'yunpian'])->value;
        }
        $setting = self::findOne(['name' => 'yunpian']);
        $setting->value = $api;

        if($setting->save()){
            return true;
        }else{
            $this->_lastError = '云片网api修改失败！';
        }
        return false;
    }
}
