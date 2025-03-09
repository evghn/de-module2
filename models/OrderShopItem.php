<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_shop_item".
 *
 * @property int $id
 * @property int $order_shop_id
 * @property int $product_id
 * @property int $amount
 * @property float $cost
 *
 * @property OrderShop $orderShop
 * @property Product $product
 */
class OrderShopItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_shop_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_shop_id', 'product_id', 'cost'], 'required'],
            [['order_shop_id', 'product_id', 'amount'], 'integer'],
            [['cost'], 'number'],
            [['order_shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderShop::class, 'targetAttribute' => ['order_shop_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_shop_id' => 'Order Shop ID',
            'product_id' => 'Product ID',
            'amount' => 'Amount',
            'cost' => 'Cost',
        ];
    }

    /**
     * Gets query for [[OrderShop]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderShop()
    {
        return $this->hasOne(OrderShop::class, ['id' => 'order_shop_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
