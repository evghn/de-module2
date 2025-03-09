<?php

use app\models\Service;
use app\models\Status;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\help\models\OrderSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'class' => 'd-flex align-items-end gap-2'
        ],
    ]); ?>

    <?= $form->field($model, 'service_id')->dropDownList(Service::getServices(), ['prompt' => 'Услуга'])->label(false) ?>



    <?= $form->field($model, 'status_id')->dropDownList(Status::getStatuses(), ['prompt' => 'Статус заявки'])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton('Выбрать', ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('Сброс',['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
