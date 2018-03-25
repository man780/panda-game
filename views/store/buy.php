<?
use yii\helpers\Html;
use yii\helpers\Url;
?>
<h2 class="text-center"><?=$model->name?></h2>
<p class="text-center">С вашего счёта будет списано <?=$model->cost?> <img height="20px" src="/images/panda.jpg" /></p>
<?=Html::img('/'.$model->image, ['style' => ['width' => '100%']]);?>
<?=Html::a('Купить',
    Url::to(['/store/buy', 'id' => $model->id]),
    [
        'data' => [
            //'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
        'class' => 'btn btn-primary'
    ]
);?>
