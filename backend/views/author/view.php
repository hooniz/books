<?php

use backend\models\Subscription;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Author $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="author-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?php if (!Yii::$app->user->isGuest): ?>
            <?php if (Subscription::getSubscriptionByAuthor($model->id)): ?>
                <?= Html::a('Unsubscribe', ['unsubscribe', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
            <?php else: ?>
                <?= Html::a('Subscribe', ['subscribe', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif; ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['label' => 'Full Name', 'value' => $model->getFullName()],
            'created_at:datetime',
            ['label' => 'Subscribers', 'value' => $model->subscribersCount],
        ],
    ]) ?>

</div>
