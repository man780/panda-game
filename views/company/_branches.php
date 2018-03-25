<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.01.2018
 * Time: 15:25
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Branch;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

?>
<h2>
    Игра между отделами возможна только при наличии не менее двух отделов компании!
</h2>
<hr>
<div>
    <h2>Список отделов</h2>
    <?foreach ($branches as $branch):?>
        <div class="row">
            <div class="col-md-1">
                <?=Html::img('/'.$branch->image, ['height' => '50px']);?>
            </div>
            <div class="col-md-10">
                <p><?=$branch->name;?></p>
                <p>
                    Игроков: <?=count($branch->employees);?>
                    Команд: <?=count($branch->teams);?>
                </p>
            </div>
        </div>
        <hr>
    <?endforeach;?>
</div>