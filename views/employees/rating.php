<?
use yii\helpers\Html;
use yii\helpers\Url;
?>
<style>
    .avatar {
        vertical-align: middle;
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }
</style>
<div class="box container">
    <?foreach ($employees as $employee):?>
    <div class="row">
        <div class="col-md-6">
            <?=Html::img(($employee->avatar == '')?'/images/no-avatar.png':'/'.$employee->avatar, ['class' => 'avatar'])?>
            <?=$employee->fname?>
            <?=$employee->name?>
        </div>
        <div class="col-md-2">
            <?= Html::a('Передать баллы', null, [
                'class' => 'openModalForm',
                'value' => Url::toRoute(['/employees/send-rating', 'to_employee' => $employee->id])
            ]);?>
        </div>
    </div>
    <?endforeach;?>
</div>
