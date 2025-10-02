<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\LinkBookToAuthor $model */

$this->title = 'Update Link Book To Author: ' . $model->book_id;
$this->params['breadcrumbs'][] = ['label' => 'Link Book To Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->book_id, 'url' => ['view', 'book_id' => $model->book_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="link-book-to-author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
