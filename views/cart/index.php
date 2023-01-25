<?php

use app\models\Cart;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CartSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <tread>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Товар</th>
                <th scope="col">Цена</th>
                <th scope="col">Количество</th>
                <th scope="col">Управление</th>
                
            </tr>
        </tread>
        <tbody>
            <?php
            $carts = Cart::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
           
            $content = '';
            $i=1;
            foreach ($carts as $cart){
                $product=Product::findOne($cart->product_id);
                $content .= "  <tr>
                <th scope='row'>{$i}</th>
                <td>{$product->name}</td>
                <td>{$product->price}</td>
                <td>{$cart->count}</td>
                <td><button class='btn btn-primary' onclick='update_cart({$product->id}, 1, {$i})'>+</button>
                <button class='btn btn-primary' onclick='update_cart({$product->id}, -1, {$i})'>-</button>
                </td>
                
              </tr>";
                $i++;
            }
            echo $content;
            ?>
        </tbody>
    </table>
                

    <div id="confirm">
        <h1>Оформление заказа</h1>
        <form class="row g-3">
        <span class="border border-3 border-secondary">
            <div>
                <p>Введите пароль:</p>
            </div>
            <div>
                <input class="form-control" type="password" id="password">
            </div>
            <p class="error" id="error">Невереный пароль</p>
        </span>
        </form>
        <p></p>
        <button class="btn btn-primary" onclick="make_order()">Оформить заказ</button>
    </div>


</div>
