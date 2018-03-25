<?
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $album->name;
//vd($album->name);
?>

<?php $form = ActiveForm::begin();?>

    <h1><?=$this->title?></h1>

    <?=$form->field($album,'items[]')->textInput();?>

<?= Html::submitButton(Yii::t('app', 'Create') , ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>