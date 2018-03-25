<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AdsSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ads');
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="ads-index box container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?//= Html::a(Yii::t('app', 'Create Ads'), ['create'], ['class' => 'btn btn-success openModalForm']) ?>
        <?= Html::a(Yii::t('app', 'Create Ads'), null, ['class' => 'btn btn-primary openModalForm',
            'value'=>Url::toRoute(['/admin/ads/create'])]) ?>
    </p>
    <hr>

    <?if(count($ads)>0):?>
        <?foreach($ads as $ad):?>
            <div class="row">
                <div class="col-md-10">
                    <p><?=$ad->full_text?></p>
                </div>
                <div class="col-md-2">
                    <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', null, [
                        'class' => 'updateBranchButton',
                        'value' => Url::toRoute(['/admin/ads/update', 'id' => $ad->id])
                    ]);
                    ?>
                    <?=Html::a('<i class="glyphicon glyphicon-trash"></i>',
                        Url::to(['/admin/ads/delete', 'id' => $ad->id]),
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
        Объявлений пока нет
    <?endif;?>
</div>
