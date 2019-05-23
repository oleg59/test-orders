<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map($statusList, 'id', 'title')) ?>

    <?= $form->field($model, 'payment_id')->dropDownList(ArrayHelper::map($paymentList, 'id', 'title')) ?>
    
    <?= $form->field($model, 'delivery_id')->dropDownList(ArrayHelper::map($deliveryList, 'id', 'title')) ?>

    <?= $form->field($model, 'cart')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'summ')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
