<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title;
$products=\app\models\Product::find()->orderBy(['time'=>SORT_DESC])->limit(5)->all();
$items=[];
?>

<div class='about'>
    <img src="../../logo.png" alt="image" width="366" height="172">
    <h1><?= Html::encode($this->title) ?></h1>

    <form class="row g-3">
        <span class="border border-3 border-secondary">
            <h4>Наш девиз:</h4>
            <p align="center" class="logo"><big>Создаем не просто букеты - создаем эмоции!</big></p>
        </span>
    </form>
</div>


<?php foreach ($products as $product){
    $items[]="<div class='bg-success m-2 p-2 d-flex flex-column justify-content-center'>
    <h1 class='text-white text-center m-2'>{$product->name}</h1>
    <img class='m-auto' style='max-height: 400px;' src='{$product->image}' alt='image' /></div>";
}
echo yii\bootstrap5\Carousel::widget(['items'=>$items]);
?>


