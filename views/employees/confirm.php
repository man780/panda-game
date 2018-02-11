<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10.01.2018
 * Time: 23:44
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;

$this->title = $message;
?>
<div class="well">
    <h2><?=$message?></h2>
    <?php $form = ActiveForm::begin([
        'action' => ['add-user-employee'],
        'method' => 'post',
    ]); ?>

    <?= $form->field($addUserEmployeeForm, 'username') ?>

    <?= $form->field($addUserEmployeeForm, 'email') ?>

    <?= $form->field($addUserEmployeeForm, 'password') ?>

    <hr>

    <?= $form->field($addUserEmployeeForm, 'name') ?>
    <?= $form->field($addUserEmployeeForm, 'fname') ?>
    <?= $form->field($addUserEmployeeForm, 'oname') ?>
    <?= $form->field($addUserEmployeeForm, 'about') ?>
    <?= $form->field($addUserEmployeeForm, 'phone') ?>
    <?= $form->field($addUserEmployeeForm, 'skype') ?>
    <?= $form->field($addUserEmployeeForm, 'birthday')->widget(DatePicker::className(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'class' => 'form-controle'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
