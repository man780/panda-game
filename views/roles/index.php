<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RolesSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::t('app', 'Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="roles-index box container">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-md-6">
            <h2><?=Yii::t('app', 'Roles');?></h2>
            <p>
                <?= Html::a(Yii::t('app', 'Create Roles'), null, ['class' => 'btn btn-primary openModalForm',
                    'value'=>Url::toRoute(['create'])]) ?>
                <?//= Html::a(Yii::t('app', 'Create Roles'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <hr>
            <?if(count($roles)>0):?>
            <?foreach($roles as $role):?>
            <div class="row">
                <div class="col-md-10">
                    <p><?=$role->name?></p>
                    <p><b><?=$role->getPriorities($role->priority)?></b></p>
                </div>

            </div>
            <hr>
            <?endforeach;?>
            <?else:?>
                Ролей пока нет
            <?endif;?>

        </div>
        <div class="col-md-6">
            <h2><?=Yii::t('app', 'Positions');?></h2>
            <p>
                <?= Html::a(Yii::t('app', 'Create Position'), null, ['class' => 'btn btn-primary openModalForm',
                    'value'=>Url::toRoute(['position/create'])]) ?>
                <?//= Html::a(Yii::t('app', 'Create Roles'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <hr/>
            <?if(count($positions)>0):?>
                <?foreach($positions as $position):?>
                    <div class="row">
                        <div class="col-md-10">
                            <p><?=$position->name?></p>
                            <p><?=$position->branch->name?></p>
                        </div>
                    </div>
                    <hr/>
                <?endforeach;?>
            <?else:?>
                Ролей пока нет
            <?endif;?>
        </div>
    </div>

</div>
