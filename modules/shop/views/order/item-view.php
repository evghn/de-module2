<?php

use yii\bootstrap5\Html;
?>
<div class="card mb-3">
    <h5 class="card-header fw-bold"><?= $model->product->title ?></h5>
    <div class="card-body">
        <h5 class="card-title">Особое обращение с заголовком</h5>
        <div class="d-flex gap-2">
            <div>
                <img src="/img/<?= $model->product->photo ? $model->product->photo : 'noPhoto.jpg' ?>" class="w-25" alt="photo">
            </div>
            <div class="d-flex gap-2">
                <p class="card-text">
                    <?= Html::a($model->product->title, ['catalog/view', 'id' => $model['product_id']],  ['class' => 'text-decoration-none']) ?>
                </p>
                <div class="my-2 fs-4 fw-bold">
                    <?= $model->cost ?>
                </div>
            </div>

        </div>


        <div class="d-flex justify-content-between gap-3 mt-3">
            <div>
                <span>
                    Итого:
                    количество - <span class="fw-bold"><?= $model->amount ?></span>
                    сумма - <span class="fw-bold"><?= $model->cost ?></span>
                </span>
            </div>
        </div>
    </div>
</div>