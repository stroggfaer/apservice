<?php

namespace app\modules\cms\models;

use app\models\DeviceProblems;
use app\models\DevicesDetails;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prices;

/**
 * PricesSearch represents the model behind the search form of `app\models\Prices`.
 */
class PricesSearch extends Prices
{
    public $device_id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'device_problems_id','device_id', 'status'], 'integer'],
            [['money'], 'number'],
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
        $query = Prices::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
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
            'device_problems_id' => $this->device_problems_id,
            'money' => $this->money,
            'status' => $this->status,
        ]);

        $query->leftJoin(DeviceProblems::tableName(),'device_problems.id=prices.device_problems_id')
        ->leftJoin(DevicesDetails::tableName(),'devices_details.device_problems_id=device_problems.id')->andFilterWhere([
             'devices_id'=>$this->device_id
            ]);

        return $dataProvider;
    }
}
