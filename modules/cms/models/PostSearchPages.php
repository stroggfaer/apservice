<?php

namespace app\modules\cms\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pages;

/**
 * PostSearchPages represents the model behind the search form about `app\models\Pages`.
 */
class PostSearchPages extends Pages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'menu', 'position', 'status'], 'integer'],
            [['url', 'title', 'seo_title', 'keywords', 'description', 'text'], 'safe'],
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
        $query = Pages::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['position'=>SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'group_id' => $this->group_id,
            'menu' => $this->menu,
            'position' => $this->position,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
