<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ResumeModel;

/**
 * ResumeSearch represents the model behind the search form about `common\models\ResumeModel`.
 */
class ResumeSearch extends ResumeModel
{
    /**
     * @inheritdoc
     */
    //public $is_sign;
    //public $iname;

    public function rules()
    {
        return [
            [['id', 'created_time', 'is_send', 'res', 'not_recycling'], 'integer'],
            [['name', 'sex', 'birthday', 'place', 'identity', 'college', 'class', 'dorm', 'phone', 'qq', 'first_wish', 'second_wish', 'myself', 'hope', 'hobbies', 'sid', 'code'], 'safe'],
            //[['is_sign', 'iname'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ResumeModel::find();

        //$query->joinWith(['sign','hire']);
        //$query->select("sign_table.*, hire.*, resume.*");
        if (!Yii::$app->user->can('[EditAllResume]')){
            $query = $query->where(['first_wish'=>Yii::$app->user->identity->department]);
        }

            // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_time' => $this->created_time,
            'is_send' => $this->is_send,
            'res' => $this->res,
            'not_recycling' => $this->not_recycling,
            //'sign_table.is_sign' => $this->is_sign,
            //'hire.iname' => $this->iname,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'birthday', $this->birthday])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'identity', $this->identity])
            ->andFilterWhere(['like', 'college', $this->college])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'dorm', $this->dorm])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'qq', $this->qq])
            ->andFilterWhere(['like', 'first_wish', $this->first_wish])
            ->andFilterWhere(['like', 'second_wish', $this->second_wish])
            ->andFilterWhere(['like', 'myself', $this->myself])
            ->andFilterWhere(['like', 'hope', $this->hope])
            ->andFilterWhere(['like', 'hobbies', $this->hobbies])
            ->andFilterWhere(['like', 'sid', $this->sid])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
