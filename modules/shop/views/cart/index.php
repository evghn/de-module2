<?php

use app\models\Cart;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\shop\models\CartSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <div class="d-flex justify-content-between my-3">
        <h3><?= Html::encode($this->title) ?></h3>

        <?= $dataProvider->totalCount
            ? Html::a('Оформить заказ', ['order/create', 'cart_id' => $dataProvider->models[0]['cart_id']], ['class' => 'btn btn-outline-primary']) 
            : ''
        ?>
    </div>


    <?php Pjax::begin([
        'id' => 'cart-pjax',
        'enablePushState' => false,
        'timeout' => 5000,
    ]); ?>
    <?php # $this->render('_search', ['model' => $searchModel]); 
    ?>
    <?php if ($dataProvider->totalCount): ?>


        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => 'item',
            'layout' => "{items}"
        ]) ?>

        <div class="d-flex justify-content-between gap-3">
            <div>
                <span>
                    Итого:
                    количество - <span class="fw-bold"><?= $dataProvider->models[0]['cart_amount'] ?></span>
                    сумма - <span class="fw-bold"><?= $dataProvider->models[0]['cart_cost'] ?></span>
                </span>
            </div>
            <?= Html::a('Очистить корзину', ['clear', 'id' => $dataProvider->models[0]['cart_id']], ['class' => 'btn btn-outline-danger btn-cart-clear']) ?> 
        </div>
    <?php else: ?>
        <div class="alert alert-primary" role="alert">
            Корзина пока пустая...
        </div>

    <?php endif ?>

    <?php Pjax::end(); ?>

</div>