<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Products;

/**
 * ProductsSearch represents the model behind the search form of `backend\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'stock', 'status'], 'integer'],
            [['useremail', 'name', 'description', 'ikey', 'amount', 'availability', 'prodcondition', 'brand', 'image', 'createdat'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Products::find();

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
            'quantity' => $this->quantity,
            'stock' => $this->stock,
            'status' => $this->status,
            'createdat' => $this->createdat,
        ]);

        $query->andFilterWhere(['like', 'useremail', $this->useremail])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'ikey', $this->ikey])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'availability', $this->availability])
            ->andFilterWhere(['like', 'prodcondition', $this->prodcondition])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
