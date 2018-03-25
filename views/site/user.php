<?
//vd($user->attributes);
//vd($employee->attributes);
$this->title = 'Пользователь';
?>
<div class="box container">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <img src="/<?=($employee->avatar == '')?'images/no-avatar.png':$employee->avatar;?>" width="100%" class="img-fluid" />
                <br>
                <span style="font-weight: bold; font-size: 12px">Текуший рейтинг: <?=$employee->employeeRate->current_rate?> <img height="20px" src="/images/panda.jpg" /></span>
                <br>
                <span style="font-weight: bold; font-size: 12px">Глобальный рейтинг: <?=$employee->employeeRate->global_rate?> <img height="20px" src="/images/panda.jpg" /></span>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7">
                        <h2><?=$employee->fname?> <?=$employee->name?></h2>
                    </div>

                    <div class="col-md-4">
                        В комапании с <br>
                        <?=$employee->join_date?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?=$employee->about?>
                    </div>
                </div>
                <hr class="dashed-line">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <span class="glyphicon glyphicon-phone"></span>
                            <span><?=$employee->phone?></span>
                        </p>
                        <p>
                            <span class="glyphicon glyphicon-envelope"></span>
                            <span><?=$employee->email?></span>
                        </p>
                        <p>
                            <i class="fa fa-skype"></i>
                            <span><?=$employee->skype?></span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <b>Отдел: </b>
                            <span><?=$employee->branch->name?></span>
                        </p>
                        <p>
                            <b>Команда: </b>
                            <span><?=$employee->team->name?></span>
                        </p>
                        <p>
                            <b>Должность: </b>
                            <span><?=$employee->position->name?></span>
                        </p>
                    </div>
                </div>
                <hr class="dashed-line">
                <div class="row">
                    <?if(count($employee->achievements) > 0):?>
                        <?foreach ($employee->achievements as $achievement):?>
                            <div class="col-md-3"><?=$achievement->name?></div>
                        <?endforeach;?>
                    <?else:?>
                        <div class="col-md-12">
                            У этого пользователя пока нет достижений
                            <br>
                        </div>
                    <?endif;;?>
                </div>
            </div>

        </div>
    </div>
</div>
