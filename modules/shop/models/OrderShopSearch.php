<?php

namespace app\modules\shop\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderShop;
use Yii;
use yii\db\Query;

/**
 * OrderShopSearch represents the model behind the search form of `app\models\OrderShop`.
 */
class OrderShopSearch extends OrderShop
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'amount', 'status_id', 'pay_receipt'], 'integer'],
            [['created_at'], 'safe'],
            [['cost'], 'number'],
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
        $query = OrderShop::find();

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
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'amount' => $this->amount,
            'cost' => $this->cost,
            'status_id' => $this->status_id,
            'pay_receipt' => $this->pay_receipt,
        ]);

        return $dataProvider;
    }


    public function orderCreate($id)
    {
        $query = (new Query())
            ->select([
                'cart.id as cart_id', 
                'cart.amount as cart_amount', 
                'cart.cost as cart_cost',
                'cart_item.id as item_id',
                'cart_item.amount as item_amount',
                'cart_item.cost as item_cost',
                'product.id as product_id',
                'product.title as product_title',
                'product.photo as product_photo',
                'product.cost',


            ])
            ->from('cart')
            ->where(['cart_id' => $id])
            ->innerJoin('cart_item', 'cart.id = cart_item.cart_id')
            ->innerJoin('product', 'product.id = cart_item.product_id')           
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}
