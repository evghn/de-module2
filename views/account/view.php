<?php

use app\models\PayType;
use app\models\Service;
use app\models\Status;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = "Заявка №" . $model->id . ' от ' . Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s');
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h3><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-outline-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'created_at',
                'value' => Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s'),
            ],
            'address',
            'contact',
            [
                'attribute' => 'date',
                'value' => Yii::$app->formatter->asDate($model->date, 'php:d.m.Y'),
            ],
            'time',
            [
                'attribute' => 'service_id',
                'value' => Service::getServices()[$model->service_id],
            ],
            [
                'attribute' => 'pay_type_id',
                'value' => PayType::getPayTypes()[$model->pay_type_id],
            ],
            [
                'attribute' => 'status_id',
                'value' => Status::getStatuses()[$model->status_id],
            ],            
            [
                'attribute' => 'reason',
                'visible' => (bool)$model->reason,
            ],
        ],
    ]) ?>

</div>
