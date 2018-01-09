<?
use yii\widgets\ActiveForm;
use yii\helpers\Html;
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

                <?= $form->field($invite, 'date_begin') ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Пригласить'), ['class' => 'btn btn-primary btn-lg']) ?>

                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>