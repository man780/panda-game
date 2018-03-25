<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResetPasswordForm */
/* @var $form ActiveForm */
?>
<div class="main-resetPassword">

    <h2>
        Отпраить пароль на почту
    </h2>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn-submit']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- main-resetPassword -->
