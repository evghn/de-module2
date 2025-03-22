<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\OrderShop $model */

$this->title = 'Создание заказа';
$this->params['breadcrumbs'][] = ['label' => 'Order Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-shop-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="d-flex justify-content-end gap-3 fs-4 my-3">
        <div>
            <span>
                Итого:
                количество - <span class="fw-bold"><?= $dataProvider->models[0]['cart_amount'] ?></span>
                сумма - <span class="fw-bold"><?= $dataProvider->models[0]['cart_cost'] ?></span>
            </span>
        </div>

    </div>
    
    <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => 'item',
            'layout' => "{items}"
        ]) ?>
    <div class="d-flex justify-content-end gap-3 fs-4 my-3">
        <div>
            <span>
                Итого:
                количество - <span class="fw-bold"><?= $dataProvider->models[0]['cart_amount'] ?></span>
                сумма - <span class="fw-bold"><?= $dataProvider->models[0]['cart_cost'] ?></span>
            </span>
        </div>

    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
