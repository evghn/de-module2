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
        Пользователь: <?= $model->user->full_name ?>
    </div>
    <div class="my-2">
        Услуга: <?= Service::getServices()[$model->service_id] ?>
    </div>
    <div class="my-2">
        Статус заявки: <?= Status::getStatuses()[$model->status_id] ?>
    </div>    
    <div class='d-flex gap-5 justify-content-end'>
      <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-info']) ?>


      <!-- 
      Новая -> «в работе» -> «выполнено»      
      Новая -> «отмена»

      -->
      <?= $model->status_id == Status::getStatusId('Новая')
        ? Html::a('В работу', ['work', 'id' => $model->id], ['class' => 'btn btn-outline-primary', 'data-method' => 'post', 'data-pjax' => 0])
          . Html::a('Отмена', ['cancel', 'id' => $model->id], ['class' => 'btn btn-outline-danger', 'data-method' => 'post', 'data-pjax' => 0])
        : ''
      ?>

      <?= $model->status_id == Status::getStatusId('В работе')
        ? Html::a('Выполнено', ['apply', 'id' => $model->id], ['class' => 'btn btn-outline-success', 'data-method' => 'post', 'data-pjax' => 0])
        : ''
      ?>
    </div>  

    <!-- Вариант работы с заявками №2 -->
    <div class='d-flex gap-5 justify-content-end mt-5'>
      <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-info']) ?>


      <!-- 
      Новая -> «в работе» -> «выполнено»      
      «B работе» -> «отмена»

      -->
      <?= $model->status_id == Status::getStatusId('Новая')
        ? Html::a('В работу', ['work', 'id' => $model->id], ['class' => 'btn btn-outline-primary', 'data-method' => 'post', 'data-pjax' => 0])
        : ''
      ?>

      <?= $model->status_id == Status::getStatusId('В работе')
        ? Html::a('Отмена', ['cancel', 'id' => $model->id], ['class' => 'btn btn-outline-danger', 'data-method' => 'post', 'data-pjax' => 0])
        . Html::a('Выполнено', ['apply', 'id' => $model->id], ['class' => 'btn btn-outline-success', 'data-method' => 'post', 'data-pjax' => 0])
        : ''
      ?>
    </div>  
    
  </div>
</div>