<?php

use app\models\Product;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h3><?= Html::encode($this->title) ?></h3>

    
    <?php Pjax::begin(); ?>

    
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item my-3'],
        'layout' => '<div class="d-flex gap-3">{items}</div>{pager}',
        'itemView' => 'item',
        'pager' => [
            'class' => LinkPager::class
        ],
        
    ]) ?>

    <?php Pjax::end(); ?>

</div>
