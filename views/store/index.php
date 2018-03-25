<?
use yii\bootstrap\Tabs;
?>
<div>
    <div class="box container">
<?
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Товары',
            'content' => $this->render('_products', ['productList' => $productList]),
            'active' => true
        ],
        [
            'label' => 'Мои покупки',
            'content' => $this->render('_my_sales', ['myProductList' => $myProductList]),
        ],
    ],
]);
?>
    </div>
</div>