<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 15.01.2018
 * Time: 17:17
 */
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

Pjax::begin(['id' => 'banner-form']) ?>
<?php $form = ActiveForm::begin([
    'id' => 'banner-form',
    'options' => [
        'data-pjax' => true,
    ]
]);
?>
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

<?= Html::submitButton(Yii::t('app', 'Create') , ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>