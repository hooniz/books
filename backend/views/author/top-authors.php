<?php

use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $form backend\models\AuthorYearForm */

$this->title = "TOP-10 authors";
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $activeForm = ActiveForm::begin([
    'method' => 'get',
]); ?>

<?= $activeForm->field($form, 'year')
    ->textInput(
            [
                'type' => 'number',
                'style' => 'width:100px',
                'value' => $form->getYear()
            ]
    )->label('Year') ?>

<div class="form-group">
    <?= Html::submitButton('Filtering', ['class' => 'btn btn-primary btn-sm mt-2']) ?>
</div>

<?php ActiveForm::end(); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => SerialColumn::class],
        [
            'label' => 'Full Name',
            'value' => static function($model) {
                return $model->FullName;
            }
        ],
        [
            'label' => 'Book count',
            'value' => static function($model) {
                return $model->book_count;
            }
        ],
    ],
]); ?>
