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
<div class="product-list  ">
    <div class="row">
        <?if(count($myProductList)>0):?>
        <?foreach($myProductList as $product):?>
            <div class="col-md-3">
                <div class="pull-right">
                    <?=$product->cost?> <img height="20px" src="/images/panda.jpg" />
                </div>
                <?=Html::img('/'.$product->image, ['style' => ['width' => '100%']]);?>
                <p><?=$product->name?></p>
            </div>
        <?endforeach;?>
        <?endif;?>
    </div>

</div>