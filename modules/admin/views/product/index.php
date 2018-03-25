<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<br>

<div class="product-list container box">
    <div class="col-md-3">
        <div class="add-product vcenter">
            <?= Html::a(Yii::t('app', 'Добавить новый товар'), null, ['class' => 'openModalForm',
                'value'=>Url::toRoute(['/admin/product/create'])]) ?>
        </div>
    </div>
    <?foreach($products as $product):?>
        <div class="col-md-3">
            <div class="product-item">
                <div class="pull-left">
                    <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', null, [
                        'class' => 'openModalForm',
                        'value' => Url::toRoute(['/admin/product/update', 'id' => $product->id])
                    ]);
                    ?>
                </div>
                <div class="pull-right">
                    <span><?=$product->cost?></span>
                    <?=Html::a('<i class="glyphicon glyphicon-trash"></i>',
                        Url::to(['/admin/product/delete', 'id' => $product->id]),
                        ['data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ]]
                    );?>
                </div>
                <div>
                    <?=Html::img('/'.$product->image, ['style' => ['width' => '100%']]);?>
                </div>
                <div>
                    <b><?=$product->name?></b>
                    <p>(<?=$product->quantity?>) <?=$product->quantity_max?></p>
                </div>

            </div>
        </div>
    <?endforeach;?>
</div>