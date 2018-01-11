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
<?=Html::a('Добавить команду', Url::toRoute('ds'), ['class' => 'btn btn-lg btn-primary'])?>
<hr>
<div>
    <h2>Список команд</h2>
    <?foreach ($teams as $team):?>
        <?=$team->image;?>
        <?=$team->name;?>
        <?=$team->employees;?>
        <hr>
    <?endforeach;?>
</div>
