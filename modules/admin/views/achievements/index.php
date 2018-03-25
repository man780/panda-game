<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AchievementsSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Achievements');
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="achievements-index box container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Achievements'), null, ['class' => 'btn btn-primary openModalForm',
            'value'=>Url::toRoute(['/admin/achievements/create'])]) ?>
    </p>

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
                <div class="col-md-2">
                    <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', null, [
                        'class' => 'updateBranchButton',
                        'value' => Url::toRoute(['/admin/achievements/update', 'id' => $achievement->id])
                    ]);
                    ?>
                    <?=Html::a('<i class="glyphicon glyphicon-trash"></i>',
                        Url::to(['/admin/achievements/delete', 'id' => $achievement->id]),
                        ['data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ]]
                    );?>
                </div>
            </div>
            <hr>
        <?endforeach;?>
    <?else:?>
        Достижений пока нет
    <?endif;?>


</div>
