<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="order-form">

<?php $form = ActiveForm::begin();
    
$items = [
'Новый' => 'Новый',
'Подтвержден' => 'Подтвержден',
'Отменен' => 'Отменен'
];
?>

    <?= $form->field($model, 'status')->dropDownList($items) ?>


    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'count')->textInput() ?>

    

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
