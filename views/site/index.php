<?php
use yii\helpers\Html;
use yii\helpers\Url;
use chintan\fullcalendar\FullCalendar;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Home');
$k = 0;
?>
<style>
    .avatar {
        vertical-align: middle;
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }
    hr.dashed-line{
        border-top:1px dashed #999;
        background-color:#fff;
        height:1px;
    }
    div.image{
        flex 1 1 auto;
    }

    /* Three columns side by side */
    .column {
        float: left;
        width: 25%;
        margin-bottom: 16px;
        padding: 0 8px;
    }

    /* Display the columns below each other instead of side by side on small screens */
    @media screen and (max-width: 650px) {
        .column {
            width: 100%;
            display: block;
        }
    }

    /* Add some shadows to create a card effect */
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    /* Some left and right padding inside the container */
    .container {
        padding: 0 16px;
    }

    /* Clear floats */
    .container::after, .row::after {
        content: "";
        clear: both;
        display: table;
    }

    .button {
        border: none;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
    }

    .button:hover {
        background-color: #555;
    }
</style>


<div class="box container">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-4">
                <img src="/<?=($employee->avatar == '')?'images/no-avatar.png':$employee->avatar;?>" width="100%" class="img-fluid" />
                <br>
                <span style="font-weight: bold; font-size: 12px"><?=Yii::t('app', 'Current')?> : <?=$employee->employeeRate->current_rate?> <img height="20px" src="/images/panda.jpg" /></span>
                <br>
                <span style="font-weight: bold; font-size: 12px"><?=Yii::t('app', 'Global')?> : <?=$employee->employeeRate->global_rate?> <img height="20px" src="/images/panda.jpg" /></span>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7">
                        <h2><?=$employee->fname?> <?=$employee->name?></h2>
                    </div>

                    <div class="col-md-4">
                        <?=Yii::t('app', 'Member since ')?> <br>
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
                    <div class="col-md-12">
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
                </div>
                <hr class="dashed-line">
                <div class="row">
                    <?if(count($employee->achievements) > 0 ):?>
                        <?foreach ($employee->achievements as $achievement):?>
                            <div class="col-md-3"><?=$achievement->name?></div>
                        <?endforeach;?>
                    <?else:?>
                        <div class="col-md-12">
                            <?=Yii::t('app', 'You have no achievements yet')?>
                            <br>
                        </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!--<h4><span class="glyphicon glyphicon-calendar"></span>Календарь</h4>-->
        <?=$this->render('_calendar');?>
    </div>

    <div class="col-md-8">
        <div class="box container">
            <div class="row">
                <h3 class="pull-left"><span class="glyphicon glyphicon-list-alt"></span> <?=Yii::t('app', 'News')?></h3>
                <a href="/news/index" class="pull-right"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
            </div>
            <div class="container">
                <?foreach($newsList as $news):?>
                    <div class="row">
                        <a href="<?=Url::to(['news/view', 'id' => $news->id])?>"><?=$news->title?></a>
                        <small><b><?=$news->created_time?></b></small>

                        <p><?=$news->description?></p>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box container">
            <div class="row">
                <h5 class="pull-left"><span class="glyphicon glyphicon-user"></span> <?=Yii::t('app', 'Company\'s top players')?></h5>
            </div>
            <?$c = 0;?>
            <?foreach ($employees as $employee):?>
                <?
                    $c++;
                    if($c > 3)continue;
                ?>
                <div class="row">
                    <div class="col-md-8">
                        <a href="<?=Url::to(['site/user', 'user_id' => $employee->user_id]);?>">
                            <?=Html::img(($employee->avatar == '')?'/images/no-avatar.png':'/'.$employee->avatar, ['class' => 'avatar'])?>
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
            <?endforeach;?>
        </div>
    </div>

    <div class="col-md-8">
        <div class="box container">
            <div class="row">
                <h3 class="pull-left"><span class="glyphicon glyphicon-shopping-cart"></span> <?=Yii::t('app', 'Store')?></h3>
                <a href="/store/index" class="pull-right"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
            </div>

            <div class="row">
                <?foreach($productList as $product):?>
                    <div class="col-md-3" style="padding: 5px;">
                        <div class="inner-auto-item-index">
                            <div class="card inner-auto-img-index">
                                <?=Html::img('/'.$product->image/*, ['style' => ['width' => '100%']]*/);?>
                            </div>
                            <div class="box container" style="text-align: center;">
                                <p class="title"><?=$product->name?></p>
                                <p>
                                    <?=$product->cost?> <img height="20px" src="/images/panda.jpg" />
                                </p>
                                <p>
                                    <?= Html::a('Купить', null, [
                                        'class' => 'openModalForm item-order-button',
                                        'value' => Url::toRoute(['/store/buy', 'id' => $product->id])
                                    ]);?>
                                </p>
                            </div>
                        </div>

                    </div>
                <?endforeach;?>
                <?/*foreach($productList as $product):*/?><!--
                    <div class="column">
                        <div class="card">
                            <?/*=Html::img('/'.$product->image, ['style' => ['width' => '100%']]);*/?>
                            <div class="box container">
                                <p class="title"><?/*=$product->name*/?></p>
                                <p>
                                    <?/*=$product->cost*/?> <img height="20px" src="/images/panda.jpg" />
                                </p>
                                <p>
                                    <?/*= Html::a(Yii::t('app', 'Buy'), null, [
                                        'class' => 'openModalForm button',
                                        'value' => Url::toRoute(['/store/buy', 'id' => $product->id])
                                    ]);*/?>
                                </p>
                            </div>
                        </div>
                    </div>
                --><?/*endforeach;*/?>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="box container">
            <h4 class="pull-left"><span class="glyphicon glyphicon-globe"></span> <?=Yii::t('app', 'Global rating')?></h4>
            <a href="/rating/global" class="pull-right"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
            <?foreach ($employees as $employee):?>
                <div class="row">
                    <div class="col-md-8">
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
            <?endforeach;?>
        </div>
    </div>
</div>