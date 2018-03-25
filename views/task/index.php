<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="task-index box container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?//= Html::a(Yii::t('app', 'Create Task'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Create Task'), null, ['class' => 'btn btn-primary openModalForm',
            'value'=>Url::toRoute(['create'])]) ?>
    </p>

    <hr>
    <?if(count($taskList)>0):?>
        <?foreach ($taskList as $task):?>
            <div class="row">
                <div class="col-md-10">
                    <p><?=$task->text;?></p>
                    <p class=""><b><?=Yii::t('app', 'Deadline')?></b> <?=$task->deadline;?></p>
                    <p><?=$task->reward;?></p>
                    <p class="date"><?=$task->created_time;?></p>
                </div>
            </div>
            <hr>
        <?endforeach;?>
    <?else:?>
        Новостей нет
    <?endif;?>
</div>

</div>
