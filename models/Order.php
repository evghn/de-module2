<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $address
 * @property string $contact
 * @property string $created_at
 * @property string $date
 * @property string $time
 * @property int $service_id
 * @property int $pay_type_id
 * @property int $status_id
 * @property int $user_id
 * @property string|null $reason
 *
 * @property PayType $payType
 * @property Service $service
 * @property Status $status
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'contact', 'date', 'time', 'service_id', 'pay_type_id', 'status_id', 'user_id'], 'required'],
            [['created_at', 'date', 'time'], 'safe'],
            [['service_id', 'pay_type_id', 'status_id', 'user_id'], 'integer'],
            [['address', 'contact', 'reason'], 'string', 'max' => 255],
            [['pay_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PayType::class, 'targetAttribute' => ['pay_type_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ заявки',
            'address' => 'Адрес',
            'contact' => 'Контактные данные',
            'created_at' => 'Дата, время создания заявки',
            'date' => 'Дата получения услуги',
            'time' => 'Время получения услуги',
            'service_id' => 'Вид услуги',
            'pay_type_id' => 'Тип оплаты',
            'status_id' => 'Статус заявки',
            'user_id' => 'Пользователь',
            'reason' => 'Причина отмены',
        ];
    }

    /**
     * Gets query for [[PayType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayType()
    {
        return $this->hasOne(PayType::class, ['id' => 'pay_type_id']);
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
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
