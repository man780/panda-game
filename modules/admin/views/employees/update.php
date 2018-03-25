<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = Yii::t('app', 'Редатировать : {nameAttribute}', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="employee-update">


    <div class="row">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>


    <?= $this->render('_form', [
        'model' => $model,
        'branches' => $branches,
        'teams' => $teams,
        'positions' => $positions,
        'roles' => $roles,
        'rate' => $rate,
        'achievements' => $achievements,
        'myAchievements' => $myAchievements,
    ]) ?>

</div>
