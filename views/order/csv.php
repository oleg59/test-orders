<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Импорт CSV';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>               
        
        <?= $form->field($model, 'file')->fileInput(['accept' => 'text/csv']) ?>
        <p>
            <small>Размер фото не долже привышать 2МБ</small>
        </p>

        <div class="form-group">
            <?= Html::submitButton('Загрузить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>                

    <?php ActiveForm::end(); ?>

</div>
