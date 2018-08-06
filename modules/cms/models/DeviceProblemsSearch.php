<?php

namespace app\modules\cms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeviceProblems;

/**
 * DeviceProblemsSearch represents the model behind the search form of `app\models\DeviceProblems`.
 */
class DeviceProblemsSearch extends DeviceProblems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'position', 'status'], 'integer'],
            [['title', 'description', 'time'], 'safe'],
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
    public function search($params,$group_id)
    {
        $query = DeviceProblems::find();

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
        $query->Where(['group_id'=>$group_id]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'group_id' => $this->group_id,
            'position' => $this->position,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'time', $this->time]);
        $query->orderBy('id DESC');
        return $dataProvider;
    }
}
