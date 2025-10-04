<?php

use yii\grid\SerialColumn;
use backend\models\Book;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],
            [
                'attribute' => 'file_id',
                'label' => 'Cover',
                'format' => 'html',
                'value' => static function ($model) {
                    return $model->coverUrl ? Html::img($model->coverUrl, ['width' => '80']) : null;
                }
            ],
            'title',
            'year',
            'description:ntext',
            'isbn',
            [
                'label' => 'Authors',
                'value' => static function (Book $model) {
                    return implode(', ', array_map(
                        static fn($author) => $author->getFullName(),
                        $model->authors
                    ));
                },
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => static function ($action, Book $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'visibleButtons' => [
                    'view' => true,
                    'update' => static function ($model, $key, $index) {
                        return !Yii::$app->user->isGuest;
                    },
                    'delete' => static function ($model, $key, $index) {
                        return !Yii::$app->user->isGuest;
                    },
                ],
            ],
        ],
    ]); ?>


</div>
