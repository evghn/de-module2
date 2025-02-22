<?php

use app\models\PayType;
use app\models\Service;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <div class="d-flex justify-content-between col-4">
        <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>
    
        <?= $form->field($model, 'time')->textInput(['type' => 'time']) ?>

    </div>

    <?= $form->field($model, 'service_id')->dropDownList(Service::getServices(), ['prompt' => 'Укажите услугу']) ?>
    
    <?= $form->field($model, 'pay_type_id')->dropDownList(PayType::getPayTypes(), ['prompt' => 'Укажите тип оплаты']) ?>   

    <div class="form-group">
        <?= Html::submitButton('Создать заявку', ['class' => 'btn btn-outline-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
