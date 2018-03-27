<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text_ru')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'text_en')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'text_th')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'deadline')->widget(\yii\jui\DatePicker::className(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ])  ?>

    <?= $form->field($model, 'reward')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
