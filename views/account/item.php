<?php

use app\models\Service;
use app\models\Status;
use yii\bootstrap5\Html;
?>
<div class="card">
  <div class="card-header">
    <h4>Заявка № <?= $model->id ?> от <?= Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s') ?></h4>
  </div>
  <div class="card-body">
    <h5 class="card-title">
        Дата и время услуги:
        <?= Yii::$app->formatter->asDate($model->date, 'php:d.m.Y') ?>
        <?= $model->time ?>
    </h5>
    <div class="my-2">
        Услуга: <?= Service::getServices()[$model->service_id] ?>
    </div>
    <div class="my-2">
        Статус заявки: <?= Status::getStatuses()[$model->status_id] ?>
    </div>    
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
  </div>
</div>