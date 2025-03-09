<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_shop".
 *
 * @property int $id
 * @property int $user_id
 * @property string $created_at
 * @property int $amount
 * @property float $cost
 * @property int $status_id
 *
 * @property OrderShopItem[] $orderShopItems
 * @property Status $status
 * @property User $user
 */
class OrderShop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_shop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status_id'], 'required'],
            [['user_id', 'amount', 'status_id'], 'integer'],
            [['created_at'], 'safe'],
            [['cost'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'amount' => 'Amount',
            'cost' => 'Cost',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * Gets query for [[OrderShopItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderShopItems()
    {
        return $this->hasMany(OrderShopItem::class, ['order_shop_id' => 'id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
