<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentsSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documents');
//$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="documents-index box container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <hr>
    <? foreach ($docs as $doc):?>
        <div class="row container">
            <div class="col-md-3">
                <?=Html::a($doc->name, Url::to([$doc->file_name]));?>
                <p class="date"><?=$doc->created_time?></p>
            </div>

        </div>
        <hr>
    <?endforeach;?>


</div>
