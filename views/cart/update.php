<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cart $model */

$this->title = 'Редактировать корзину: ';
$this->params['breadcrumbs'][] = ['label' => 'Carts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cart-update">

   <?= Html::encode($this->title) ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
<p class="error"></p>
</div>
