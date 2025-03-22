<?php

use app\models\OrderShop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\shop\models\OrderShopSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-shop-index">

    <h3><?= Html::encode($this->title) ?></h3>

    
    <?php Pjax::begin(); ?>
    <?php # $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => 'main-item'
    ]) ?>

    <?php Pjax::end(); ?>

</div>
