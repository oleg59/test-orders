<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Редактировать заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Заказ  №' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать заказ';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'statusList' => $statusList,
        'deliveryList' => $deliveryList,
        'paymentList' => $paymentList
    ]) ?>

</div>
