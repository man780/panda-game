<?php
/**
 * Created by PhpStorm.
 * User: Murod
 * Date: 27.03.2018
 * Time: 1:10
 */
use app\models\Employee;
use yii\helpers\Url;
//vd($tableArr);

?>
<div class="box container table-responsive">
    <div class="jumbotron">
        <a href="<?=Url::toRoute('settings/create')?>" class="btn btn-primary">
            Выставить баллы
        </a>
        <a href="<?=Url::toRoute('settings/chart')?>" class="btn btn-success">
            Диаграма
        </a>
        <h3>
            Таблица Играков
        </h3>
    </div>

<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>
                Игроки
            </th>
            <?foreach ($dates as $date):?>
                <th><?=date('d.m.Y', strtotime($date))?></th>
            <?endforeach;?>
        </tr>
    </thead>
    <tbody>
        <?foreach ($employees as $employee):?>
            <tr>
                <td>
                    <b>
                        <?=Employee::find()->where(['id' => $employee])->one()->fname;?>
                        <?=Employee::find()->where(['id' => $employee])->one()->name;?>
                    </b>
                </td>
                <?foreach ($dates as $date):?>
                    <td class="text-right">
                        <?=$tableArr[$employee][$date]?>
                    </td>
                <?endforeach;?>
            </tr>
        <?endforeach;?>
    </tbody>
</table>

</div>