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
<?//vd($modal)?>
    <h2><?=$this->title;?></h2>
    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title_th')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description_en')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description_th')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'full_text_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ])?>

    <?= $form->field($model, 'full_text_en')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ])?>

    <?= $form->field($model, 'full_text_th')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ])?>
    <?= $form->field($model, 'file')
        ->fileInput([
            "accept"=>"image/*"
        ])
    ?>

<?= Html::submitButton(Yii::t('app', 'Save') , ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>