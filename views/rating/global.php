<?
use yii\helpers\Html;
use yii\helpers\Url;
$i = 1;
?>
<style>
    .avatar {
        vertical-align: middle;
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }
</style>
<div>

    <h2><?=$this->title?></h2>

    <div class="box container">

        <?foreach ($employees as $employee):?>
            <div class="row">
                <div class="col-md-1">
                    <?=$i?>
                </div>
                <div class="col-md-1">
                    <?=Html::img(($employee->avatar == '')?'/images/no-avatar.png':'/'.$employee->avatar, ['class' => 'avatar'])?>
                </div>
                <div class="col-md-4 text-left">
                    <a href="<?=Url::to(['site/user', 'user_id' => $employee->user_id]);?>">
                        <?=$employee->fname?>
                        <?=$employee->name?>
                    </a>
                </div>
                <div class="col-md-4 text-right">
                    <?if(is_null($employee->employeeRate->global_rate)):?>
                        0 <img height="20px" src="/images/panda.jpg" />
                    <?else:?>
                        <?=$employee->employeeRate->global_rate?> <img height="20px" src="/images/panda.jpg" />
                    <?endif;?>
                </div>

            </div>
            <?$i++;?>
        <?endforeach;?>

    </div>
</div>
