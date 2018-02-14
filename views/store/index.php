<?
use yii\helpers\Html;
use yii\helpers\Url;
?>
<style>
    .product-item{
        width: 24%;
        float: left;
        text-align: center;
    }
</style>
<div class="product-list">
    <div class="product-item">
        <?= Html::a(Yii::t('app', 'Добавить новый товар'), null, ['class' => 'openModalForm',
            'value'=>Url::toRoute(['/store/create'])]) ?>
    </div>
    <div class="product-item">
        1
    </div>
</div>