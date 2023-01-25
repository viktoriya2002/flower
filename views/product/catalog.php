<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var app\models\Product $model */
/** @var yii\bootstrap5\ActiveForm $form */


$this->title = 'Каталог товаров';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <form class="row g-3">
        <span class="border border-3 border-secondary">

        <h3>Сортировка</h3>
            <p></p>
           <span class="border border-dark border-2 p-1"><a href="/product/catalog?sort=price">↑</a> По цене <a href="/product/catalog?sort=-price">↓</a> </span>&#8291;
             <span class="border border-dark border-2 p-1"><a href="/product/catalog?sort=time">↑</a> По новизне <a href="/product/catalog?sort=-time">↓</a> </span>&#8291;
             <span class="border border-dark border-2 p-1"><a href="/product/catalog?sort=country">↑</a> По стране производства <a href="/product/catalog?sort=-country">↓</a> </span>&#8291;
             <span class="border border-dark border-2 p-1"><a href="/product/catalog?sort=name">↑</a> По наименованию <a href="/product/catalog?sort=-name">↓</a> </span>
<p></p>
           <div class="dropdown">
  <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
    Выберите категорию
  </button>
   <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
       <li><a class='dropdown-item' href='/product/catalog'>Все товары</a></li>

 <?php
 $li='';
 $categories=\app\models\Category::find()->all();
 foreach ($categories as $category)
 {
     $li.="<li><a class='dropdown-item' href='/product/catalog?ProductSearch[category_id]={$category->id}'>{$category->name}</a></li>";

 }
 echo $li;
 ?>

 </ul>
</div>
            <p></p>
        </span>
    </form>

</div>
<p></p>
<?php $products=$dataProvider->getModels();
echo "<div class='d-flex flex-row flex-wrap justify-content-start border border-3 border-secondary align-items-end'>";
    foreach ($products as $product){
    if ($product->count>0) {
    echo "<div class='card m-auto' style='width: 30%; min-width: 300px;'>
        <a href='/product/view?id={$product->id}'><img src='{$product->image}' class='card-img' style='max-height: 200px;' alt='image'></a>
        <div class='card-body'>
            <h5 class='card-title'>{$product->name}</h5>
            <p class='text-danger'>{$product->price} руб</p>";
            echo (Yii::$app->user->isGuest ? "<a href='/product/view?id={$product->id}' 
class='btn btn-primary'>Просмотр товара</a>": "<p onclick='add_product({$product->id}, 1)' class='btn btn-primary'>Добавить в корзину</p>");
            echo "</div></div>";}
    }
    echo "</div>";
?>
