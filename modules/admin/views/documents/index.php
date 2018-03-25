<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentsSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documents');
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="documents-index box container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Documents'), null, ['class' => 'btn btn-primary openModalForm',
            'value'=>Url::toRoute(['/admin/documents/create'])]) ?>
        <?//= Html::a(Yii::t('app', 'Create Documents'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <hr>
    <? foreach ($docs as $doc):?>
        <div class="row container">
            <div class="col-md-10">
                <?=Html::a($doc->file_name, Url::to(['/'.$doc->file_name]));?>
                <p class="date"><?=$doc->created_time?></p>
            </div>
            <div class="col-md-2">
                <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', null, [
                    'class' => 'openModalForm',
                    'value' => Url::toRoute(['/admin/documents/update', 'id' => $doc->id])
                ]);
                ?>
                <?=Html::a('<i class="glyphicon glyphicon-trash"></i>',
                    Url::to(['/admin/documents/delete', 'id' => $doc->id]),
                    ['data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ]]
                );?>
            </div>
        </div>
        <hr>
    <?endforeach;?>


</div>
