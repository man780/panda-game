<?php
use yii\helpers\Url;
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.01.2018
 * Time: 15:24
 */
?>
<br>
<div class="box-container">
    <div class="row text-center">
        <h2>Panda</h2>
    </div>
    <div class="row">
        <?foreach ($branches as $branch):?>
            <div class="well col-md-4">
                <h3><?=Yii::t('app', 'Department')?>: <?=$branch->name?></h3>

                <h5><?=Yii::t('app', 'Teams')?></h5>
                <?foreach ($branch->teams as $team):?>
                <div class="badge">
                    <?=$team->name?>
                </div>
                <?endforeach;?>

                <h5><?=Yii::t('app', 'Employees')?></h5>
                <div class="row">
                    <div class="col-md-6">
                        <?=Yii::t('app', 'Player')?>
                    </div>
                    <div class="col-md-3">
                        <?=Yii::t('app', 'Global rate')?>
                    </div>
                    <div class="col-md-3">
                        <?=Yii::t('app', 'Current rate')?>
                    </div>
                </div>
                <?foreach ($branch->employees as $employee):?>
                    <div class="row" data-team_id="<?=$employee->team_id?>">
                        <div class="col-md-6">
                            <a href="<?=Url::to(['site/user', 'user_id' => $employee->user_id]);?>">
                                <?=$employee->fname?>
                                <?=$employee->name?>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <?=$employee->employeeRate->global_rate?>
                        </div>
                        <div class="col-md-3">
                            <?=$employee->employeeRate->current_rate?>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        <?endforeach;?>
    </div>
</div>
