<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OrderShop $model */

$this->title = 'Update Order Shop: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-shop-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
