<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserModel;

/**
 * UserSearch represents the model behind the search form about `common\models\UserModel`.
 */
class UserSearch extends UserModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'role', 'status', 'vip_lv', 'created_at', 'updated_at'], 'integer'],
            [['username', 'truename', 'department', 'class', 'phone', 'qq', 'duty', 'birthday', 'appearance', 'dorm', 'auth_key', 'password_hash', 'password_reset_token', 'email_validate_token', 'email', 'avatar'], 'safe'],
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
        $query = UserModel::find();

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
            'role' => $this->role,
            'status' => $this->status,
            'vip_lv' => $this->vip_lv,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'truename', $this->truename])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'qq', $this->qq])
            ->andFilterWhere(['like', 'duty', $this->duty])
            ->andFilterWhere(['like', 'birthday', $this->birthday])
            ->andFilterWhere(['like', 'appearance', $this->appearance])
            ->andFilterWhere(['like', 'dorm', $this->dorm])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email_validate_token', $this->email_validate_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'avatar', $this->avatar]);

        return $dataProvider;
    }
}
