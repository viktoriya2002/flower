<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cart $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="cart-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'count')->textInput() ?>
    <?= $form->field($model, 'product_id', ['options'=>['hidden'=>true, 'id'=>'product_id']])->textInput() ?>

    <div class="form-group">
        <?= Html::Button('Сохранить', ['class' => 'btn btn-success', 'onClick'=>'cart_update()']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
