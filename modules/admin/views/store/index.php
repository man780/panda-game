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
	.add-product{
		width: 100%;
		height: 100px;
	}
</style>
<div class="product-list container box">
    <div class="col-md-3">
        <?= Html::a(Yii::t('app', 'Добавить новый товар'), null, ['class' => 'add-product openModalForm',
            'value'=>Url::toRoute(['/admin/product/create'])]) ?>
    </div>
	<?foreach($products as $product):?>
    <div class="col-md-3">
        <div class="product-item">
			<?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', null, [
                        'class' => 'openModalForm',
                        'value' => Url::toRoute(['/admin/product/update', 'id' => $product->id])
                    ]);
					?>
		</div>
    </div>
	<?endforeach;?>
</div>