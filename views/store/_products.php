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
<div class="product-list" style="background-color: #f8f8f8;">
    <div class="row">
        <div class="col-md-12">
            <?foreach($productList as $product):?>
                <div class="col-md-3" style="padding: 10px;">
                    <div class="innerauto-item">
                        <div class="pull-right innerauto-img">
                            <?=Html::img('/'.$product->image/*, ['style' => ['width' => '100%']]*/);?>
                        </div>

                        <p class="text-center"><?=$product->name?></p>
                        <p class="text-center"><?=$product->cost?> <img height="20px" src="/images/panda.jpg" /></p>

                        <p style="text-align: center;" >
                            <?= Html::a(Yii::t('app', 'Купить'), null, [
                                'class' => 'openModalForm item-order-button',
                                'value' => Url::toRoute(['/store/buy', 'id' => $product->id])
                            ]);?>
                        </p>
                    </div>
                </div>
            <?endforeach;?>
        </div>
    </div>
</div>