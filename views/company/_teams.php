<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.01.2018
 * Time: 15:25
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<h2>
    Создайте команду и привяжите к отделу
</h2>
<?//=Html::a('Добавить отдел', Url::toRoute('ds'), ['class' => 'btn btn-lg btn-primary'])?>
<?= Html::a(Yii::t('app', 'Добавить команду'), null,
    ['class' => 'btn btn-primary', 'id'=>'createTeamButton',
    'value'=>Url::toRoute(['/company/create-team'])]) ?>
<hr>
<div>
    <h2>Список команд</h2>
    <?foreach ($teams as $team):?>
        <div class="row">
            <div class="col-md-1">
                <?=Html::img('/'.$team->image, ['height' => '50px']);?>
            </div>
            <div class="col-md-10">
                <p><?=$team->name;?></p>
                <p>Отдел: <?=$team->branch->name;?></p>
                <p>Игроков: <?=count($team->employees);?></p>
            </div>
            <div class="col-md-1">
                <?=Html::a('<i class="glyphicon glyphicon-pencil"></i>', null,
                    [
                        'class'=>'updateTeamButton',
                        'value'=>Url::to(['/company/update-team', 'id' => $team->id]),
                    ]
                );?>
                <?=Html::a('<i class="glyphicon glyphicon-trash"></i>',
                                Url::to(['/company/delete-team', 'id' => $team->id]),
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