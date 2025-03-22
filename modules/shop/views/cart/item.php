<?php

use yii\bootstrap5\Html;

?>
<div class="card mb-3">
    <h5 class="card-header fw-bold"><?= $model['product_title'] ?></h5>
    <div class="card-body">
        <h5 class="card-title">Особое обращение с заголовком</h5>
        <div class="d-flex gap-2">
            <div>
                <img src="/img/<?= $model['product_photo'] ? $model['product_photo'] : 'noPhoto.jpg' ?>" class="w-25" alt="photo"> 
            </div>
            <div class="d-flex gap-2">
                <p class="card-text">
                    <?= Html::a($model['product_title'], ['/shop/catalog/view', 'id' => $model['product_id']],  ['class' => 'text-decoration-none']) ?>
                </p>                    
                <div class="my-2 fs-4 fw-bold">
                    <?= $model['cost'] ?>
                </div>
            </div>

        </div>
       

        <div class="d-flex justify-content-between gap-3 mt-3">
         <div>
            <span>
                Итого: 
                количество - <span class="fw-bold"><?= $model['item_amount']?></span>
                сумма - <span class="fw-bold"><?= $model['item_cost']?></span>
        
        </span>
        </div>  
        <div class="d-flex justify-content-end gap-3">
            <?= Html::a('-', ['item-del', 'id' => $model['product_id']], ['class' => 'btn btn-danger btn-item-del']) ?> 
            <span class='fs-4'><?= $model['item_amount']?></span> 
            <?= Html::a('+', ['add', 'id' => $model['product_id']], ['class' => 'btn btn-success btn-item-add']) ?> 
            <?= Html::a('Удалить', ['item-remove', 'id' => $model['item_id']], ['class' => 'btn btn-outline-danger btn-item-remove']) ?> 

        </div>             


        </div>
    </div>
</div>