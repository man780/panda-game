<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
?>
<style>
    .news-img{
        flaot: left;
        width: 200px;
        margin: 3px;
    }
</style>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <div class="news-img">
            <?=Html::img('/'.$model->image)?>
        </div>

        <div>
            <?=$model->full_text;?>
        </div>
    </div>

</div>
