<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $composition
 * @property int $amount
 * @property float $cost
 * @property string $photo
 *
 * @property CartItem[] $cartItems
 * @property OrderShopItem[] $orderShopItems
 */
class Product extends \yii\db\ActiveRecord
{

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPADATE = 'create';

    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'composition', 'cost'], 'required'],
            [['composition'], 'string'],
            [['amount'], 'integer'],
            [['cost'], 'number'],
            [['title', 'photo'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'on' => self::SCENARIO_CREATE],
            // [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'on' => self::SCENARIO_UPADATE],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'composition' => 'Composition',
            'amount' => 'Amount',
            'cost' => 'Cost',
            'photo' => 'Photo',
        ];
    }

    /**
     * Gets query for [[CartItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartItems()
    {
        return $this->hasMany(CartItem::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[OrderShopItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderShopItems()
    {
        return $this->hasMany(OrderShopItem::class, ['product_id' => 'id']);
    }


    public function upload()
    {
        if ($this->validate()) {
            $fileName = Yii::$app->user->id 
                . '_'
                . Yii::$app->security->generateRandomString()
                . '.'
                . $this->imageFile->extension
                ;
            $this->imageFile->saveAs('img/' . $fileName );
            $this->photo = $fileName;
            return true;
        } else {
            return false;
        }
    }
}
