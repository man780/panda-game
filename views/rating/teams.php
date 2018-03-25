<?
use yii\helpers\Html;
$teamsCArr = [];
$teamsGArr = [];
?>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
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
        <div class="row">
            <div class="col-md-3">Команды</div>
            <div class="col-md-5">Участники</div>
            <div class="col-md-2">Текущий рейтинг</div>
            <div class="col-md-2">Глобальный рейтинг</div>
        </div>
        <hr>
        <?foreach ($teams as $team):?>
            <div class="row">
                <div class="col-md-3">
                    <?=$team->name?>
                </div>
                <?$teamsCArr[$team->name] = 0;?>
                <?$teamsGArr[$team->name] = 0;?>
                <div class="col-md-5">
                <?foreach ($team->employees as $employee):?>

                    <?=Html::img(($employee->avatar == '')?'/images/no-avatar.png':'/'.$employee->avatar,
                        ['class' => 'avatar', "data-toggle"=>"tooltip", "title"=>$employee->fname.' '.$employee->name]
                    )?>
                    <?$teamsCArr[$team->name] = $teamsCArr[$team->name]+($employee->employeeRate->current_rate) ?>
                    <?$teamsGArr[$team->name] = $teamsGArr[$team->name]+($employee->employeeRate->global_rate) ?>
                <?endforeach;?>
                </div>
                <div class="col-md-2 text-right">
                    <?=$teamsCArr[$team->name]?> <img height="20px" src="/images/panda.jpg" />
                </div>
                <div class="col-md-2 text-right">
                    <?=$teamsGArr[$team->name]?> <img height="20px" src="/images/panda.jpg" />
                </div>

                <?//vd($teamsArr, false)?>
            </div>
        <?endforeach;?>
    </div>
</div>

