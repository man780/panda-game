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
        </div>
        <hr>

    <?endforeach;?>
</div>