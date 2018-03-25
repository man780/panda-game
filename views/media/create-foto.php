<?
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $album->name;
?>

<?php $form = ActiveForm::begin();?>

<h1><?=$this->title?></h1>

<?=$form->field($album,'items[]')->fileInput(['multiple' => true, 'accept' => 'image/*']);?>

<?= Html::submitButton(Yii::t('app', 'Create') , ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>