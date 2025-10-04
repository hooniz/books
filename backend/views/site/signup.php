<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var backend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
?>
<div class="site-signup">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to signup:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'phone') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group d-flex gap-2">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary flex-fill', 'name' => 'signup-button']) ?>
            <?= Html::a('Login', ['/site/login'], ['class' => 'btn btn-secondary flex-fill']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
