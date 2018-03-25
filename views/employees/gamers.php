<?
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\helpers\Url;

use app\models\Invite;
$this->title = 'Игроки';
$invites = Invite::find()->where(['status' => 1])->all();
?>
<div class="well">
    <div class="row">
        <div class="col-md-8">
            <h3>Список игроков</h3>
            <div class="employee-search">

                <?php $form = ActiveForm::begin([
                    'action' => ['search'],
                    'method' => 'get',
                ]); ?>

                <?= $form->field($model, 'name') ?>

                <?php echo $form->field($model, 'team_id') ?>

                <?php echo $form->field($model, 'branch_id') ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="userList">
                <h2>Список отделов</h2>
                <?foreach ($employees as $employee):?>
                    <div class="row">
                        <div class="col-md-1">
                            <?=Html::img('/'.$employee->avatar, ['height' => '50px']);?>
                        </div>
                        <div class="col-md-9">
                            <p><?=$employee->fname;?> <?=$employee->name;?></p>
                        </div>
                        <div class="col-md-2">
                            <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', null, [
                                'class' => 'updateBranchButton',
                                'value' => Url::toRoute(['/employees/update', 'id' => $employee->id])
                            ]);
                            ?>
                            <?=Html::a('<i class="glyphicon glyphicon-trash"></i>',
                                Url::to(['/employees/delete', 'id' => $employee->id]),
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
            <h3>Приглашённые</h3>
            <?if($invites):?>
            <?foreach($invites as $invite):?>
                <div>
                    <?=Html::a($invite->fio, Url::to(['employees/save-user', 'invite_id'=>$invite->id]))?>
                </div>
            <?endforeach;?>
            <?else:?>
                Приглашенных нет
            <?endif;?>

            <h3>Для подтверждения</h3>
            <?if($invites):?>
                <?foreach($toConfirmList as $toConfirm):?>
                    <div>
                        <?=Html::a($toConfirm->fname. ' ' .$toConfirm->name, Url::to(['employees/confirm-employee', 'employee_id'=>$toConfirm->id]))?>
                    </div>
                <?endforeach;?>
            <?else:?>
                Приглашенных нет
            <?endif;?>
        </div>
    </div>
</div>