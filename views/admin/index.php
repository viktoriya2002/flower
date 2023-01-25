<?php
/* @var $this yii\web\View */
?>
<h1>Панель администратора</h1>

<div class="product-index">

    <h1><?= \yii\helpers\Html::encode($this->title) ?></h1>

    <form class="row g-3">
        <span class="border border-3 border-secondary">
<p><a href="../product">Управление товарами</a></p>
<p><a href="../order">Управление заказами</a></p>
<p><a href="../category">Управление категориями</a></p>
<p><a href="../cart">Управление корзинами пользователей</a></p>
<p><a href="../user">Управление пользователями</a></p>
        </span>
    </form>
</div>