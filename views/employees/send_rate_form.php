<?
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Передать баллы';
?>
<div class="box">
    <h2><?=$this->title?></h2>
    <?php $form = ActiveForm::begin([
        //'action' => ['conf'],
        'method' => 'post',
    ]); ?>


    <div class="row text-center">
        <?=Html::img(($employeeFrom->avatar == '')?'/images/no-avatar.png':'/'.$employeeFrom->avatar, ['class' => 'avatar'])?>
        <?=$employeeFrom->fname?>
        <?=$employeeFrom->name?>
        <?=$employeeFrom->employeeRate->global_rate?> <img height="20px" src="/images/panda.jpg" />
        <?=$employeeFrom->employeeRate->current_rate?> <img height="20px" src="/images/panda.jpg" />
    </div>
    <div class="row text-center">
        <span class=" glyphicon glyphicon-chevron-down"></span>
    </div>

    <?= $form->field($rate, 'rate') ?>
    <?= $form->field($rate, 'to_employee')->hiddenInput()->label(false); ?>
    <?= $form->field($rate, 'from_employee')->hiddenInput()->label(false); ?>

    <div class="row text-center">
        <span class=" glyphicon glyphicon-chevron-down"></span>
    </div>
    <div class="row text-center">
        <?=Html::img(($employeeTo->avatar == '')?'/images/no-avatar.png':'/'.$employeeTo->avatar, ['class' => 'avatar'])?>
        <?=$employeeTo->fname?>
        <?=$employeeTo->name?>
        <b>Глобальный</b> <?=$employeeTo->employeeRate->global_rate?> <img height="20px" src="/images/panda.jpg" />
        <b>Текушмй</b> <?=$employeeTo->employeeRate->current_rate?> <img height="20px" src="/images/panda.jpg" />
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Передать'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>