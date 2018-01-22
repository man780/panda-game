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
        <?=Html::img([$team->image, ['class' => 'img img-responsive']]);?>
        <?=$team->name;?>
        <?=$team->branch->name;?>
        <?=count($team->employees);?>
        <hr>
    <?endforeach;?>
</div>