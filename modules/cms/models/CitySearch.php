<?php

namespace app\modules\cms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\City;

/**
 * CitySearch represents the model behind the search form of `app\models\City`.
 */
class CitySearch extends City
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'status'], 'integer'],
            [['domen', 'name', 'seo_name', 'seo_description', 'time', 'phone', 'map_lat', 'map_lon', 'zoom'], 'safe'],
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
        $query = City::find();

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
            'country_id' => $this->country_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'domen', $this->domen])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'seo_name', $this->seo_name])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'map_lat', $this->map_lat])
            ->andFilterWhere(['like', 'map_lon', $this->map_lon])
            ->andFilterWhere(['like', 'zoom', $this->zoom]);

        return $dataProvider;
    }
}
