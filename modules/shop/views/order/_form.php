<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OrderShop $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-shop-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'pay_receipt')->checkbox() ?>

    <div class="form-group d-flex justify-content-end">
        <?= Html::submitButton('Создать заказ', ['class' => 'btn btn-outline-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
