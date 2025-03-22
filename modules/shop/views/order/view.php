<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\OrderShop $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-shop-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'created_at',
            'amount',
            'cost',
            'status_id',
            'pay_receipt',
        ],
    ]) ?>

    <div>
        Состав заказа:
    </div>

    <?php foreach($model->orderShopItems as $item): ?>
        <?= $this->render('item-view', ['model' => $item]) ?>
    <?php endforeach ?>


</div>
