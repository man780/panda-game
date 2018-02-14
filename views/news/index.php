<?
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h2><?=$this->title?></h2>
<div class="box">
    <div class="container">
        <Br>
        <?= Html::a(Yii::t('app', 'Добавить новость'), null, ['class' => 'btn btn-primary openModalForm',
            'value'=>Url::toRoute(['/news/create'])]) ?>
        <hr>
        <?if(count($newsList)>0):?>
        <?foreach ($newsList as $news):?>
            <div class="row">
                <div class="col-md-1">
                    <?=Html::img('/'.$news->image, ['height' => '50px']);?>
                </div>
                <div class="col-md-10">
                    <p><?=$news->name;?></p>
                    <p>
                        <?=$news->description;?>
                        <?=$news->dcreated;?>
                    </p>
                </div>
                <div class="col-md-1">
                    <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', null, [
                        'class' => 'openModalForm',
                        'value' => Url::toRoute(['/news/update', 'id' => $news->id])
                    ]);
                    ?>
                    <?=Html::a('<i class="glyphicon glyphicon-trash"></i>',
                        Url::to(['/news/delete', 'id' => $news->id]),
                        ['data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ]]
                    );?>
                </div>
            </div>
            <hr>
        <?endforeach;?>
        <?else:?>
            Новостей нет
        <?endif;?>
    </div>

</div>