<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Каталог книг';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Добро пожаловать в Каталог книг!</h1>
        <p class="lead">Выберите раздел для работы:</p>
    </div>

    <div class="body-content">
        <div class="row text-center">

            <div class="col-lg-3">
                <h2>Книги</h2>
                <p>Просмотр, добавление, редактирование и удаление книг.</p>
                <p><a class="btn btn-primary" href="<?= Url::to(['book/index']) ?>">Перейти &raquo;</a></p>
            </div>

            <div class="col-lg-3">
                <h2>Авторы</h2>
                <p>Просмотр и управление авторами.</p>
                <p><a class="btn btn-primary" href="<?= Url::to(['author/index']) ?>">Перейти &raquo;</a></p>
            </div>

<!--            <div class="col-lg-3">-->
<!--                <h2>Отчёты</h2>-->
<!--                <p>ТОП 10 авторов по количеству книг за выбранный год.</p>-->
<!--                <p><a class="btn btn-primary" href="--><?php //= \yii\helpers\Url::to(['author/top-authors']) ?><!--">Перейти &raquo;</a></p>-->
<!--            </div>-->
<!---->
<!--            <div class="col-lg-3">-->
<!--                <h2>Подписки</h2>-->
<!--                <p>Подписка на новые книги выбранных авторов.</p>-->
<!--                <p><a class="btn btn-primary" href="--><?php //= \yii\helpers\Url::to(['subscription/index']) ?><!--">Перейти &raquo;</a></p>-->
<!--            </div>-->

        </div>
    </div>
</div>
