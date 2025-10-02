<?php

use backend\models\LinkBookToAuthor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\LinkBookToAuthorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Link Book To Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-book-to-author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Link Book To Author', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'book_id',
            'author_id',
            'created_by',
            'created_at',
            'updated_by',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, LinkBookToAuthor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'book_id' => $model->book_id]);
                 }
            ],
        ],
    ]); ?>


</div>
