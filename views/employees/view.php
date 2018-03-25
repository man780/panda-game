<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->fname.' '.$model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="employee-view box">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'avatar',
                'value' => Html::img('/'.$model->avatar, ['style' => ['height' => '50px']]),
                'format' => 'html',
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->username,
            ],
            'name',
            'fname',
            'oname',
            'about:ntext',

            'phone',
            'email:email',
            'skype',
            'birthday',
            [
                'attribute' => 'branch_id',
                'value' => $model->branch->name,
            ],
            [
                'attribute' => 'team_id',
                'value' => $model->team->name,
            ],
            [
                'attribute' => 'position_id',
                'value' => $model->position->name,
            ],
            [
                'attribute' => 'role_id',
                'value' => $model->role->name,
            ],
            'join_date',
        ],
    ]) ?>

</div>
