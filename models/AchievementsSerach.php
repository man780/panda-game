<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Achievements;

/**
 * AchievementsSerach represents the model behind the search form of `app\models\Achievements`.
 */
class AchievementsSerach extends Achievements
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'reward', 'created_user'], 'integer'],
            [['name', 'description', 'status_achievement', 'image', 'created_time'], 'safe'],
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
        $query = Achievements::find();

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
            'reward' => $this->reward,
            'created_user' => $this->created_user,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status_achievement', $this->status_achievement])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
