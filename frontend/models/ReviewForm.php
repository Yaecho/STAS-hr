<?php
namespace frontend\models;

use common\models\ReviewModel;
use yii\base\Model;
use Yii;

class ReviewForm extends Model
{
    public $id;
    public $rid;
    public $star_1;
    public $star_2;
    public $star_3;
    public $star_4;
    public $star_5;
    public $content;
    public $iid;
    public $iname;
    public $time;


    public function rules()
    {
        return [
            [['rid', 'star_1', 'star_2', 'star_3', 'star_4', 'star_5', 'content'], 'required'],
            [['iid', 'time'], 'integer'],
            [['content'], 'string', 'max' => 500],
            [['iname'], 'string', 'max' => 25],
        ];
    }

    public function create()
    {
        $iid = Yii::$app->user->identity->getId();
        $model = new ReviewModel();
        $model::deleteAll(['rid'=>$this->rid,'iid'=>$iid]);
        $model->setAttributes($this->attributes);
        $model->iid = $iid;
        $model->iname = Yii::$app->user->identity->department.'-'.Yii::$app->user->identity->truename;
        $model->time = time();
        return $model->save();
    }
}

