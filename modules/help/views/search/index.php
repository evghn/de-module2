<?php

use app\models\Order;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\help\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('Товары', ['product/index']) ?>
    </p>
    
    <?php Pjax::begin(); ?>

    <div class="d-flex mx-2 justify-content-between align-items-center">
        <div>
            <?= $dataProvider->sort->link('created_at', ['label' => 'Дата']) . ' | ' . $dataProvider->sort->link('address') . ' | '?>
            <?= Html::a('Сброс', ['index'], []) ?>
        </div>

        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item my-3'],
        'itemView' => 'item',
        'pager' => [
            'class' => LinkPager::class
        ]
    ]) ?>

    <?php Pjax::end(); ?>

</div>
