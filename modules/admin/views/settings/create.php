<?php
/**
 * Created by PhpStorm.
 * User: Murod
 * Date: 27.03.2018
 * Time: 2:09
 */
use yii\helpers\Html;
?>
<style>
    .avatar {
        vertical-align: middle;
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }
</style>
<h2>
    Выставления баллов
</h2>

<div class="box container table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>
                    Игроки
                </th>
                <th>
                    Баллы
                </th>
                <th>
                    Текуший рейтинг
                </th>
                <th>
                    Глобальный рейтинг
                </th>
            </tr>
        </thead>
        <tbody>
        <?foreach ($employees as $employee):?>
            <tr>
                <td>
                    <?=Html::img(($employee->avatar == '')?'/images/no-avatar.png':'/'.$employee->avatar, ['class' => 'avatar'])?>
                    <?=$employee->fname?>
                    <?=$employee->name?>
                </td>
                <td>
                    <?=Html::input('name', 'rate[]', 0, ['class' => 'form-control text-right']);?>
                </td>
                <td class="text-right">
                    <?=$employee->employeeRate->global_rate?>
                </td>
                <td class="text-right">
                    <?=$employee->employeeRate->current_rate?>
                </td>
            </tr>
        <?endforeach;?>
        </tbody>
    </table>

</div>