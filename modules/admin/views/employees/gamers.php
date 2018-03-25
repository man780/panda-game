<?
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\helpers\Url;

use app\models\Invite;
$this->title = 'Игроки';
?>
<style>
    .avatar {
        vertical-align: middle;
        width: 50px;
        height: 50px;
        border-radius: 5px;
    }
</style>
<div class="well">
    <div class="row">
        <div class="col-md-8">
            <h3>Список игроков</h3>
            <div class="employee-search">

                <?php $form = ActiveForm::begin([
                    'action' => ['search'],
                    'method' => 'get',
                ]); ?>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'team_id')->dropDownList($teams); ?>
                </div>
                <div class="col-md-6">
                    <?php echo $form->field($model, 'branch_id')->dropDownList($branches); ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'name') ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="userList">
                <h2>Список игроков</h2>
                <?foreach ($employees as $employee):?>
                    <div class="row">
                        <div class="col-md-1">
                            <?=Html::img(($employee->avatar == '')?'/images/no-avatar.png':'/'.$employee->avatar, ['class' => 'avatar'])?>
                            <?//=Html::img('/'.$employee->avatar);?>
                        </div>
                        <div class="col-md-9">
                            <p>
                                <?=$employee->fname;?> <?=$employee->name;?><br>
                                (<?=$employee->user->username;?>)
                            </p>
                        </div>
                        <div class="col-md-2">
                            <?= Html::a('<i class="glyphicon glyphicon-certificate"></i>', null, [
                                'class' => 'updateBranchButton',
                                'value' => Url::toRoute(['/admin/employees/achievements', 'id' => $employee->id])
                            ]);
                            ?>

                            <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', null, [
                                'class' => 'updateBranchButton',
                                'value' => Url::toRoute(['/admin/employees/update', 'id' => $employee->id])
                            ]);
                            ?>
                            <?=Html::a('<i class="glyphicon glyphicon-trash"></i>',
                                Url::to(['/admin/employees/delete', 'id' => $employee->id]),
                                ['data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ]]
                            );?>
                        </div>
                    </div>
                    <hr>
                <?endforeach;?>
            </div>
        </div>
        <div class="col-md-4">
            <h3>Пригласить игрока</h3>
            <div class="employee-invite">

                <?php $form = ActiveForm::begin([
                    'action' => ['invite'],
                    'method' => 'get',
                ]); ?>

                <?= $form->field($invite, 'fio') ?>

                <?= $form->field($invite, 'email') ?>

                <?= $form->field($invite, 'date_begin')->widget(DatePicker::className(), [
                    'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                    'class' => 'form-controle'
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Пригласить'), ['class' => 'btn btn-primary btn-lg']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="col-md-4">

            <h3>Для подтверждения</h3>
            <?if(count($toConfirmList)):?>
                <?foreach($toConfirmList as $toConfirm):?>
                    <div>
                        <?=Html::a($toConfirm->fname. ' ' .$toConfirm->name, Url::to(['/admin/employees/confirm-employee', 'employee_id'=>$toConfirm->id]))?>
                    </div>
                <?endforeach;?>
            <?else:?>
                Приглашенных нет
            <?endif;?>
        </div>
    </div>
</div>