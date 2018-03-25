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

$params = [
    'prompt' => 'Выберите значения...',
];
?>
<div class="well">
    <h2><?=$this->title?></h2>
    <?php $form = ActiveForm::begin([
        //'action' => ['conf'],
        'method' => 'post',
    ]); ?>
    <?= $form->field($employee, 'name') ?>
    <?= $form->field($employee, 'fname') ?>
    <?= $form->field($employee, 'oname') ?>
    <?= $form->field($employee, 'about')->textarea() ?>
    <?= $form->field($employee, 'phone') ?>
    <?= $form->field($employee, 'skype') ?>
    <?= $form->field($employee, 'birthday')->widget(DatePicker::className(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($employee, 'team_id')->dropDownList($teams, $params); ?>

    <?= $form->field($employee, 'branch_id')->dropDownList($branches, $params) ?>

    <?= $form->field($employee, 'position_id')->dropDownList($positions, $params) ?>

    <?= $form->field($employee, 'role_id')->dropDownList($roles, $params) ?>

    <?= $form->field($employee, 'join_date')->widget(DatePicker::className(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'class' => 'form-control'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
