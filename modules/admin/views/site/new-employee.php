<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 31.01.2018
 * Time: 10:22
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Профиль';
?>
<div class="employee-form">

<?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data'
    ],
]); ?>


<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'oname')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'avatar')->fileInput(['maxlength' => true]) ?>

<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'birthday')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>