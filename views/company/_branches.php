<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.01.2018
 * Time: 15:25
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Branch;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

?>
<h2>
    Игра между отделами возможна только при наличии не менее двух отделов компании!
</h2>
<?//=Html::a('Добавить отдел', Url::toRoute('ds'), ['class' => 'btn btn-lg btn-primary'])?>
<?= Html::a(Yii::t('app', 'Добавить отдел'), null, ['class' => 'btn btn-primary', 'id'=>'createBannerButton',
    'value'=>Url::toRoute(['/company/create-branch'])]) ?>
<hr>
<div>
    <h2>Список отделов</h2>
    <?foreach ($branches as $branch):?>
        <?=Html::img([$branch->image, ['class' => 'img img-responsive']]);?>
        <?=$branch->name;?>
        <?=count($branch->employees);?>
        <hr>
    <?endforeach;?>
</div>

