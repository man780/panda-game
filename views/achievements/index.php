<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AchievementsSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Achievements');
//$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="achievements-index box container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <hr>

    <?if(count($achievements)>0):?>
        <?foreach($achievements as $achievement):?>
            <div class="row">
                <div class="col-md-1">
                    <?=Html::img('/'.$achievement->image, ['height' => '50px']);?>
                </div>
                <div class="col-md-9">
                    <p>
                        <span><?=$achievement->name?></span>
                        <span><?=$achievement->reward?></span>
                        <span><?=$achievement->status_achievement?></span>
                    </p>
                    <p><?=$achievement->description?></p>

                    <p class="date"><?=$achievement->dcreated?></p>
                </div>

            </div>
            <hr>
        <?endforeach;?>
    <?else:?>
        Достижений пока нет
    <?endif;?>


</div>
