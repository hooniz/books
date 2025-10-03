<?php

use yii\grid\SerialColumn;
use backend\models\Author;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\AuthorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Author', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            'id',
            'first_name',
            'last_name',
            'middle_name',
            [
                'label' => 'Books',
                'format' => 'html',
                'value' => static function($model) {
                    $books = $model->books;
                    if (empty($books)) {
                        return null;
                    }

                    return implode('<br>', array_map(static function($b){ return Html::encode($b->title); }, $books));
                }
            ],
            [
                'label' => 'Subscribers',
                'value' => static function($model) {
                    return $model->subscribersCount;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => static function ($action, Author $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],

        ],
    ]); ?>


</div>
