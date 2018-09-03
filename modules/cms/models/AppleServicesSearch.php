<?php

namespace app\modules\cms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AppleServices;

/**
 * AppleServicesSearch represents the model behind the search form of `app\models\AppleServices`.
 */
class AppleServicesSearch extends AppleServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'status'], 'integer'],
            [['title', 'title_seo', 'address', 'metro', 'time', 'description', 'map_lat', 'map_lon', 'text', 'value'], 'safe'],
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
        $query = AppleServices::find();

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
            'city_id' => $this->city_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_seo', $this->title_seo])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'metro', $this->metro])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'map_lat', $this->map_lat])
            ->andFilterWhere(['like', 'map_lon', $this->map_lon])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
