<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-2 pull-left">
            <?=Html::img('/'.$model->avatar, ['style' => ['width' => '100%']])?>
        </div>
        <div class="col-md-4 pull-left">
            <p><b><?=$model->fname?> <?=$model->name?></b></p>
            <p><i class="glyphicon glyphicon-email"></i><?=$model->email?></p>
        </div>
        <div class="col-md-6 pull-right">
            Баланс:
            <?=$rate?> + <?=Html::textInput('rate', null, ['style' => ['width' =>'100px']])?>
            <img src="/images/panda.jpg" height="20px"/>
        </div>
    </div>
    <hr>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'avatar')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->widget(DatePicker::className(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'class' => 'form-controle'
    ]) ?>

    <?= $form->field($model, 'team_id')->dropDownList($teams) ?>

    <?= $form->field($model, 'branch_id')->dropDownList($branches); ?>

    <?= $form->field($model, 'position_id')->dropDownList($positions) ?>

    <?= $form->field($model, 'role_id')->dropDownList($roles) ?>

    <?= $form->field($model, 'join_date')->widget(DatePicker::className(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'class' => 'form-controle'
    ]) ?>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
