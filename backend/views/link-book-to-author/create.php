<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\LinkBookToAuthor $model */

$this->title = 'Create Link Book To Author';
$this->params['breadcrumbs'][] = ['label' => 'Link Book To Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-book-to-author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
