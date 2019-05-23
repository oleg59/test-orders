<?php

namespace app\models;

use Yii;
use app\models\Status;
use app\models\Payment;
use app\models\Delivery;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $status_id
 * @property int $payment_id
 * @property int $delivery_id
 * @property string $cart
 * @property int $summ
 * @property string $name
 * @property string $phone
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
            [['delivery_id', 'status_id', 'payment_id', 'summ'], 'integer'],
            [['cart', 'name', 'status_id', 'delivery_id', 'payment_id', 'phone', 'summ'], 'required'],
            [['cart'], 'string'],
            [['name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер заказа',
            'status.title' => 'Статус заказа',
            'status_id' => 'Статус заказа',
            'payment.title' => 'Система оплаты',
            'payment_id' => 'Система оплаты',
            'delivery.title' => 'Служба доставки',
            'delivery_id' => 'Служба доставки',
            'cart' => 'Корзина',
            'summ' => 'Сумма заказа',
            'name' => 'Имя клиента',
            'phone' => 'Номер телефона'
        ];
    }

    /**
     * Получем статус
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * Получем способ оплаты
     *
     * @return string
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['id' => 'payment_id']);
    }

    /**
     * Получем способ доставки
     *
     * @return string
     */
    public function getDelivery()
    {
        return $this->hasOne(Delivery::className(), ['id' => 'delivery_id']);
    }
}
