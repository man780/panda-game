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
<div class="product-list ">
    <div class="row">
    <?foreach($productList as $product):?>
        <div class="col-md-3">
            <div class="pull-right">
                <?=$product->cost?> <img height="20px" src="/images/panda.jpg" />
            </div>
            <?=Html::img('/'.$product->image, ['style' => ['width' => '100%']]);?>
            <p><?=$product->name?></p>
            <p>
                <?= Html::a('Купить', null, [
                    'class' => 'openModalForm text-center',
                    'value' => Url::toRoute(['/store/buy', 'id' => $product->id])
                ]);?>
            </p>
        </div>

    <?endforeach;?>
    </div>

</div>