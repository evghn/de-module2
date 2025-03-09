<?php

use app\models\Service;
use app\models\Status;
use yii\bootstrap5\Html;

?>
<div class="card" style="width: 18rem; height: 33rem;">
  <img src="/img/<?= $model->photo ? $model->photo : 'noPhoto.jpg' ?>" class="card-img-top" alt="photo">

  <div class="card-body">    
    <div class="my-2 mb-3">
      <h4><?= Html::a($model->title, ['view', 'id' => $model->id],  ['class' => 'text-decoration-none']) ?></h4>
    </div>

    <div class="my-2">
        Состав: <?= $model->composition ?>
    </div>
    <div class="d-flex justify-content-between">
        <div class="my-2">
            (<?= $model->amount ?>) 
        </div>    
        <div class="my-2 fs-4 fw-bold">
            <?= $model->cost ?>
        </div>
    </div>
    
    <div>
    <?= Html::a('В корзину', ['cart/add', 'id' => $model->id], ['class' => 'btn btn-outline-success w-100']) ?>
    </div>

  </div>
</div>