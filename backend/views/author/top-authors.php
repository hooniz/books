<?php

use yii\grid\SerialColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $year int */

$this->title = "TOP-10 authors of {$year}";
?>

    <h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => SerialColumn::class],
        [
            'attribute' => 'full_name',
            'label' => 'Full Name',
            'value' => static function ($model) {
                return $model->FullName;
            }
        ],
        [
            'attribute' => 'book_count',
            'label' => 'Book Count',
            'value' => static function ($model) {
                return $model->book_count;
            }
        ],
    ],
]);
