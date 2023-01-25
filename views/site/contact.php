<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Где нас найти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            --
        </div>

    <?php else: ?>

        <h4>
            Нас можно найти здесь:
        </h4>

        <img src="../../map.PNG" alt="image" width="807" height="407">
    <p></p>

        <div class="row">
            <div class="col-lg-5">

                <h5>Наши контактные данные:</h5>
                <p>Адрес: Приморский р-н, пр. Сизова, 28, Санкт-Петербург<br>
                Номер телефона: +7(911)389-51-12<br>
                Почта: flower-shop@gmail.com<br>
                </p>


            </div>
        </div>

    <?php endif; ?>
</div>
