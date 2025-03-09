<?php

use app\models\Service;
use app\models\Status;
use yii\bootstrap5\Html;

?>
<div class="card">
  <div class="card-header">
    <h4><?= $model->title ?></h4>
  </div>
  <div class="card-body">
    
    <div class="my-2">
        Состав: <?= $model->composition ?>
    </div>
      
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
  </div>
</div>