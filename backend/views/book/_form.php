<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use backend\models\Author;

/* @var $model backend\models\Book */
?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
    'method' => 'post',
]); ?>

<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'year')->textInput() ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= $form->field($model, 'isbn')->textInput() ?>

<?= $form->field($model, 'coverFile')->fileInput() ?>

<?= $form->field($model, 'authorIds')->dropDownList(
    ArrayHelper::map(Author::find()->all(), 'id', 'fullName'),
    ['multiple' => true]
) ?>

<div class="form-group mt-1">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
