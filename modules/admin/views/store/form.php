<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.01.2018
 * Time: 16:50
 */
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;

Pjax::begin(['id' => 'news-form']) ?>
<?php $form = ActiveForm::begin([
    'id' => 'news-form',
    'options' => [
        'data-pjax' => true,
        'enctype' => 'multipart/form-data'
    ],
]);
?>
    <h2><?=$this->title;?></h2>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'cost')->textInput()?>
    <?= $form->field($model, 'quantity_max')->textInput()?>
    <?= $form->field($model, 'is_team')->checkbox()?>
    <?= $form->field($model, 'image')
        ->fileInput([
            "accept"=>"image/*"
        ])
    ?>

<?= Html::submitButton(Yii::t('app', 'Save') , ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>